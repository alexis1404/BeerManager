<?php

namespace BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produser
 *
 * @ORM\Table(name="produser")
 * @ORM\Entity(repositoryClass="BeerBundle\Repository\ProduserRepository")
 */
class Produser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="BeerBundle\Entity\Beer", mappedBy="producer", cascade={"persist", "remove"})
     */
    private $beerMarks;

    public function __construct($name)
    {
        $this->name = (string)$name;
        $this->beerMarks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Produser
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add beerMark
     *
     * @param \BeerBundle\Entity\Beer $beerMark
     *
     * @return Produser
     */
    public function addBeerMark(\BeerBundle\Entity\Beer $beerMark)
    {
        $this->beerMarks[] = $beerMark;

        return $this;
    }

    /**
     * Remove beerMark
     *
     * @param \BeerBundle\Entity\Beer $beerMark
     */
    public function removeBeerMark(\BeerBundle\Entity\Beer $beerMark)
    {
        $this->beerMarks->removeElement($beerMark);
    }

    /**
     * Get beerMarks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBeerMarks()
    {
        return $this->beerMarks;
    }

    public function createNewBeer($name, $style, $og, $abv, $ibu, $volume, $cost, $status)
    {
        $beer = new Beer($name, $style, $og, $abv, $ibu, $volume, $cost, $status);

        $beer->setProducer($this);

        $this->addBeerMark($beer);

        return $beer;
    }
}
