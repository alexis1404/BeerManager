<?php

namespace BeerBundle\Services;

use Doctrine\ORM\EntityManager;
use BeerBundle\Entity\Produser;

class ProducerManager
{
    private $repoProducer;
    private $otherServices;

    public function __construct(EntityManager $em, OtherServices $otherServices)
    {
        $this->repoProducer = $em->getRepository('BeerBundle:Produser');
        $this->otherServices = $otherServices;
    }

    public function getAllProducers()
    {
        return $this->repoProducer->findAll();
    }

    public function createNewProducer($name)
    {
        $producer = new Produser($name);

        $errorsLog = $this->otherServices->validator($producer);

        if($errorsLog){
            return ['success' => false, 'errorsLog' => $errorsLog];
        }else{
            $this->repoProducer->saverObject($producer);
            return['success' => true, 'errorsLog' => false];
        }
    }

    public function editProducer($idProducer, $nameProducer)
    {
        $actualProducer = $this->repoProducer->find($idProducer);

        if($actualProducer) {
            $actualProducer->setName($nameProducer);
            $errorsLog = $this->otherServices->validator($actualProducer);
            if ($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->repoProducer->saverObject($actualProducer);
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return false;
        }
    }

    public function deleteProducer($idProducer)
    {
        $actualProducer = $this->repoProducer->find($idProducer);

        if($actualProducer){
            $this->repoProducer->removeObject($actualProducer);
            return true;
        }else{
            return false;
        }
    }

    public function getAllProducersBeers($idProducer)
    {
        $actualProducer = $this->repoProducer->find($idProducer);

        if($actualProducer){
            return $actualProducer->getBeerMarks();
        }else{
            return false;
        }
    }
}