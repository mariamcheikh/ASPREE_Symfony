<?php
namespace GPublicationBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 06/12/2016
 * Time: 05:30
 */
class PublicationRepository extends EntityRepository
{
    public function findAllD()
    {
        $All=$this->findBy(array(), array('dateCreation' => 'DESC'));

        return $All;
    }
    public function findAllF()
{
    return $this->findBy(array(), array('publication' => 'DESC'));
}
}