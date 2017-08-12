<?php

namespace BeerBundle\Tests\Controller;


use BeerBundle\Services\BeerManager;
use BeerBundle\Entity\Beer;
use BeerBundle\Entity\Produser;


class BeerManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllBeers()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue([$beers = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status')]));
        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals([$beers], $beerManager->getAllBeers());
    }

    public function testCreateNewBeerSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoProducer']));
        $mockers['repoProducer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['em']->expects($this->any())
            ->method('flush');

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $beerManager->createNewBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idProducer'));
    }

    public function testCreateNewBeerInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoProducer']));
        $mockers['repoProducer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($producer = new Produser('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')
            ->will($this->returnValue(true));

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $beerManager->createNewBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idProducer'));
    }

    public function testCreateNewBeerProducerNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoProducer']));
        $mockers['repoProducer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $beerManager->createNewBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idProducer'));
    }

    public function testEditBeerFullSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($beer = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repoBeer']->expects($this->once())
        ->method('saverObject');

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $beerManager->editBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idBeer'));
    }

    public function testEditBeerSuccessFalseStatus()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($beer = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repoBeer']->expects($this->once())
            ->method('saverObject');

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $beerManager->editBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', false, 'idBeer'));
    }

    public function testEditBeerInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($beer = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')
            ->will($this->returnValue(true));

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $beerManager->editBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idBeer'));
    }

    public function testEditBeerObjectNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $beerManager->editBeer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status', 'idBeer'));
    }

    public function testDeleteBeerSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($beer = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status')));
        $mockers['repoBeer']->expects($this->once())
            ->method('removeObject');

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(true, $beerManager->deleteBeer('beerId'));
    }

    public function testDeleteBeerObjectNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoBeer']));
        $mockers['repoBeer']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $beerManager = new BeerManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(false, $beerManager->deleteBeer('beerId'));
    }

    //service method. returned mokers
    public function getMockers()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()->getMock();
        $otherServices = $this->getMockBuilder('BeerBundle\Services\OtherServices')
            ->disableOriginalConstructor()->getMock();
        $repoProducer = $this->getMockBuilder('BeerBundle\Repository\ProduserRepository')
            ->disableOriginalConstructor()->getMock();
        $repoBeer = $this->getMockBuilder('BeerBundle\Repository\BeerRepository')
            ->disableOriginalConstructor()->getMock();

        return $mockers = [
            'otherServices' => $otherServices,
            'em' => $em,
            'repoProducer' => $repoProducer,
            'repoBeer' => $repoBeer
        ];
    }
}
