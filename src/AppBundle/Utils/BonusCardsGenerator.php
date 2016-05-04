<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use Faker\Factory as Faker;
use AppBundle\Entity\BonusCard;

class BonusCardsGenerator
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function generate($data)
    {
        $series = $data['series'];
        $expInterval = $data['expInterval'];
        $amount = $data['amount'];

        $faker = Faker::create();
        $em = $this->em;

        $currDate = new \DateTime();
        $interval = 'P1M';
        if($expInterval == '6m') $interval = 'P6M';
        if($expInterval == '1y') $interval = 'P1Y';

        $expDate = clone $currDate;
        $expDate = $expDate->add(new \DateInterval($interval));

        for($i=0; $i<$amount; $i++) {

            $bonusCard = new BonusCard();

            $bonusCard->setSeries($series);
            $bonusCard->setNumber($faker->numberBetween(100000, 999999));
            $bonusCard->setIssueDate($currDate);
            $bonusCard->setExpDate($expDate);
            $bonusCard->setStatus('active');

            $em->persist($bonusCard);
        }

        $em->flush();

        return ;
    }
}