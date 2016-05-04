<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\BonusCard;

class StatusUpdater
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function update()
    {
        $countUpdated = 0;

        $bonusCards = $this->em->getRepository('AppBundle:BonusCard')->findAll();
        $currDate = new \DateTime();

        foreach( $bonusCards as $bonusCard ) {

            if( $bonusCard->getExpDate() < $currDate && $bonusCard->getStatus() != 'expired' ) {
                $bonusCard->setStatus('expired');
                $this->em->persist($bonusCard);
                $countUpdated++;
            }

        }

        $this->em->flush();

        return "Updated: ".$countUpdated;
    }
}