<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BonusCardRepository extends EntityRepository
{
    public function findOneByIdJoinedToBonusCardHistory($bonusCardId)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p, c FROM AppBundle:BonusCard p
            JOIN p.history c
            WHERE p.id = :id
            ORDER BY c.date DESC'
            )->setParameter('id', $bonusCardId);

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}