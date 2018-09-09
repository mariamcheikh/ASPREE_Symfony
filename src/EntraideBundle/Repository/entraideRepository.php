<?php

namespace EntraideBundle\Repository;
use EntraideBundle\Entity\entraide;
use Illuminate\Support\Facades\DB;

/**
 * entraideRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class entraideRepository extends \Doctrine\ORM\EntityRepository
{


    function sumQB($id){
        $em=$this->getEntityManager();

        $query = $em->createQuery('SELECT  SUM(d.montant) FROM EntraideBundle:entraide e JOIN e.dons d WHERE d.entraide=?1');

        $users = $query->setParameter(1,$id)->getResult();

        return $users;
    }
    function viewQB($id){
        $em=$this->getEntityManager();

        $query = $em->createQuery('SELECT d.id, d.montant,d.description FROM EntraideBundle:entraide e JOIN e.dons d WHERE d.entraide=?1');

        $users = $query->setParameter(1,$id)->getResult();

        return $users;
    }
    function creationDQL($id){
        $em=$this->getEntityManager();
        $query=$em->createQuery("
        select u.username from EntraideBundle:entraide e JOIN e.dons d JOIN d.user u where d.entraide='$id'
        ");
        return $query->getResult();
    }


}