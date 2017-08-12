<?php

namespace BeerBundle\Tests\Controller;


use BeerBundle\Services\ProducerManager;
use BeerBundle\Entity\Produser;


class ProducerManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGetAllProducers()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));

        $mockers['repo']->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue([$producer = new Produser('name')]));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals([$producer], $producerManager->getAllProducers());
    }

    public function testCreateNewProducerSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repo']->expects($this->once())
            ->method('saverObject');

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $producerManager->createNewProducer('name'));
    }

    public function testCreateNewProducerInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')->will($this->returnValue(true));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $producerManager->createNewProducer('name'));
    }

    public function testEditProducerSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repo']->expects($this->once())
            ->method('saverObject');

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $producerManager->editProducer('idProducer', 'nameProducer'));
    }

    public function testEditProducerInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')->will($this->returnValue(true));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $producerManager->editProducer('idProducer', 'nameProducer'));
    }

    public function testEditProducerObjectNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $producerManager->editProducer('idProducer', 'nameProducer'));
    }

    public function testDeleteProducerSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));
        $mockers['repo']->expects($this->once())
            ->method('removeObject');

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(true, $producerManager->deleteProducer('idProducer'));
    }

    public function testDeleteProducerObjectNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $producerManager->deleteProducer('idProducer'));
    }

    public function testGetAllProducersBeersSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));

        $beermarks = $producer->getBeerMarks();

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals($beermarks, $producerManager->getAllProducersBeers('idProducer'));
    }

    public function testGetAllProducersBeersObjectNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $producerManager = new ProducerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $producerManager->getAllProducersBeers('idProducer'));
    }

    //service method. returned mokers
    public function getMockers()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()->getMock();
        $otherServices = $this->getMockBuilder('BeerBundle\Services\OtherServices')
            ->disableOriginalConstructor()->getMock();
        $repo = $this->getMockBuilder('BeerBundle\Repository\ProduserRepository')
            ->disableOriginalConstructor()->getMock();

        return $mockers = [
            'otherServices' => $otherServices,
            'em' => $em,
            'repo' => $repo
        ];
    }
}
