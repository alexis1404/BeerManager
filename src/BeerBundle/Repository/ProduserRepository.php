<?php

namespace BeerBundle\Repository;

/**
 * ProduserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduserRepository extends \Doctrine\ORM\EntityRepository
{
    public function saverObject($object)
    {
        $em = $this->getEntityManager();
        $em->persist($object);
        $em->flush();
    }

    public function removeObject($object)
    {
        $em = $this->getEntityManager();
        $em->remove($object);
        $em->flush();
    }
}
