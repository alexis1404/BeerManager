<?php

namespace BeerBundle\Services;

use Doctrine\ORM\EntityManager;

class BeerManager
{
    private $repoBeer;
    private $otherServices;
    private $em;

    public function __construct(EntityManager $em, OtherServices $otherServices)
    {
        $this->repoBeer = $em->getRepository('BeerBundle:Beer');
        $this->repoProducer = $em->getRepository('BeerBundle:Produser');
        $this->otherServices = $otherServices;
        $this->em = $em;
    }

    public function getAllBeers()
    {
        return $this->repoBeer->findAll();

    }

    public function createNewBeer($name, $style, $og, $abv, $ibu, $volume, $cost, $status, $idProducer)
    {
        $beerProducer = $this->repoProducer->find($idProducer);

        if($beerProducer) {
            $newBeer = $beerProducer->createNewBeer($name, $style, $og, $abv, $ibu, $volume, $cost, $status);
            $errorsLog = $this->otherServices->validator($newBeer);
            if($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->em->flush();
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return 'Producer not found!';
        }

    }

    public function editBeer($name, $style, $og, $abv, $ibu, $volume, $cost, $status, $idBeer)
    {
        $actualBeer = $this->repoBeer->find($idBeer);

        if($actualBeer){
            if($name){
                $actualBeer->setName($name);
            }
            if($style){
                $actualBeer->setStyle($style);
            }
            if($og){
                $actualBeer->setOg($og);
            }
            if($abv){
                $actualBeer->setAbv($abv);
            }
            if($ibu){
                $actualBeer->setIbu($ibu);
            }
            if($volume){
                $actualBeer->setVolume($volume);
            }
            if($cost){
                $actualBeer->setCost($cost);
            }
            if($status){
                $actualBeer->setStatus(true);
            }else{
                $actualBeer->setStatus(false);
            }

            $errorsLog = $this->otherServices->validator($actualBeer);
            if($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->repoBeer->saverObject($actualBeer);
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return 'Beer not found!';
        }
    }

    public function deleteBeer($beerId)
    {
        $actualBeer = $this->repoBeer->find($beerId);

        if($actualBeer){
            $this->repoBeer->removeObject($actualBeer);
            return true;
        }else{
            return 'Beer not found!';
        }
    }
}