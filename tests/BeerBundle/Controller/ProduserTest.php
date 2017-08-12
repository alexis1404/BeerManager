<?php

namespace BeerBundle\Tests\Controller;


use BeerBundle\Entity\Produser;
use BeerBundle\Entity\Beer;


class ProduserTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorAndGetters()
    {
        $producer = new Produser('name');

        $this->assertEquals(null, $producer->getId());
        $this->assertEquals('name', $producer->getName());
    }

    public function testAddAndRemoveBeermarks()
    {
        $producer = new Produser('name');
        $beer = new Beer('name', 'style', 'og', 'abv', 'ibu', 'volume', 'cost', 'status');

        $this->assertEmpty($producer->getBeerMarks());
        $producer->addBeerMark($beer);
        $this->assertNotEmpty($producer->getBeerMarks());
        $producer->removeBeerMark($beer);
        $this->assertEmpty($producer->getBeerMarks());

    }
}
