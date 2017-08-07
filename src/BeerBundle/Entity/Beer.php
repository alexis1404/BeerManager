<?php

namespace BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Beer
 *
 * @ORM\Table(name="beer")
 * @ORM\Entity(repositoryClass="BeerBundle\Repository\BeerRepository")
 */
class Beer
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
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255)
     * @Assert\Type("string")
     */
    private $style;

    /**
     * @var float
     *
     * @ORM\Column(name="og", type="float", nullable=true)
     * @Assert\Type("float")
     */
    private $og;

    /**
     * @var float
     *
     * @ORM\Column(name="abv", type="float", nullable=true)
     * @Assert\Type("float")
     */
    private $abv;

    /**
     * @var float
     *
     * @ORM\Column(name="ibu", type="float", nullable=true)
     * @Assert\Type("float")
     */
    private $ibu;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float", nullable=true)
     * @Assert\Type("float")
     */
    private $volume;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", nullable=true)
     * @Assert\Type("float")
     */
    private $cost;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     * @Assert\Type("boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="BeerBundle\Entity\Produser", inversedBy="beerMarks", cascade={"persist"})
     * @ORM\JoinColumn(name="producer", referencedColumnName="id")
     */
    private $producer;

    public function __construct($name, $style, $og, $abv, $ibu, $volume, $cost, $status)
    {
        $this->name = (string)$name;
        $this->style = (string)$style;
        $this->og = (float)$og;
        $this->abv = (float)$abv;
        $this->ibu = (float)$ibu;
        $this->volume = (float)$volume;
        $this->cost = (float)$cost;
        $this->status = (boolean)$status;
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
     * @return Beer
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
     * Set style
     *
     * @param string $style
     *
     * @return Beer
     */
    public function setStyle($style)
    {
        $this->style = (string)$style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set og
     *
     * @param float $og
     *
     * @return Beer
     */
    public function setOg($og)
    {
        $this->og = (float)$og;

        return $this;
    }

    /**
     * Get og
     *
     * @return float
     */
    public function getOg()
    {
        return $this->og;
    }

    /**
     * Set abv
     *
     * @param float $abv
     *
     * @return Beer
     */
    public function setAbv($abv)
    {
        $this->abv = (float)$abv;

        return $this;
    }

    /**
     * Get abv
     *
     * @return float
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * Set ibu
     *
     * @param float $ibu
     *
     * @return Beer
     */
    public function setIbu($ibu)
    {
        $this->ibu = (float)$ibu;

        return $this;
    }

    /**
     * Get ibu
     *
     * @return float
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * Set volume
     *
     * @param float $volume
     *
     * @return Beer
     */
    public function setVolume($volume)
    {
        $this->volume = (float)$volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Beer
     */
    public function setCost($cost)
    {
        $this->cost = (float)$cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Beer
     */
    public function setStatus($status)
    {
        $this->status = (boolean)$status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set producer
     *
     * @param \BeerBundle\Entity\Produser $producer
     *
     * @return Beer
     */
    public function setProducer(\BeerBundle\Entity\Produser $producer = null)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer
     *
     * @return \BeerBundle\Entity\Produser
     */
    public function getProducer()
    {
        return $this->producer;
    }
}
