<?php

namespace GPublicationBundle\Repository;
use GPublicationBundle\Entity\Publication;
use GPublicationBundle\Entity\Reaction;

/**
 * ReactionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReactionRepository extends \Doctrine\ORM\EntityRepository
{

    public function updateReaction($userId,Reaction $reaction)
    {
        //$qB = $this->createQueryBuilder('p');
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('GPublicationBundle:Reaction', 'r')
            ->set('r.contenu', '?1')
            ->set('r.avis','?2')
            ->where('r.id = ?3')
            ->setParameter(1, $reaction->getContenu())
            ->setParameter(2, $reaction->getAvis())
            ->setParameter(3,$userId);
        $q = $qB->getQuery();
        $p=$q->execute() ;
        return $p;
    }

}