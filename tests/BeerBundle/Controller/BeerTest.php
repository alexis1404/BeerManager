<?php

namespace BeerBundle\Tests\Controller;


use BeerBundle\Entity\Beer;
use BeerBundle\Entity\Produser;


class BeerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorAndGetters()
    {
        $beer = new Beer('name', 'style', 11, 11, 11, 11, 11, 1);

        $this->assertEquals(null, $beer->getId());
        $this->assertEquals('name', $beer->getName());
        $this->assertEquals('style', $beer->getStyle());
        $this->assertEquals(11, $beer->getOg());
        $this->assertEquals(11, $beer->getAbv());
        $this->assertEquals(11, $beer->getIbu());
        $this->assertEquals(11, $beer->getVolume());
        $this->assertEquals(11, $beer->getCost());
        $this->assertEquals(1, $beer->getStatus());
    }

    public function testAddAndRemoveProducer()
    {
        $beer = new Beer('name', 'style', 11, 11, 11, 11, 11, 1);
        $producer = new Produser('name');

        $this->assertEmpty($beer->getProducer());
        $beer->setProducer($producer);
        $this->assertNotEmpty($beer->getProducer());
    }
}
