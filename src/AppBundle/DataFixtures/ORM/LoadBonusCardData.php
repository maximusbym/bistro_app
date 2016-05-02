<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\BonusCard;
use Faker\Factory as Faker;

class LoadBonusCardData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        $currDate = new \DateTime();

        for($i=0; $i<5000; $i++) {

            $bonusCard = new BonusCard();

            $issueDate = $faker->dateTimeBetween('-2 year', 'now');
            $expDate = clone $issueDate;
            $expDate = $expDate->add(new \DateInterval('P1Y'));
            
            if ($expDate < $currDate) {
                $status = 'expired';
            } else {
                
                if (rand(0, 1) == 1) {
                    $status = 'inactive';
                }
                else {
                    $status = 'active';
                }
            }
            
            $bonusCard->setSeries($faker->numberBetween(100, 999));
            $bonusCard->setNumber($faker->numberBetween(100000, 999999));
            $bonusCard->setIssueDate($issueDate);
            $bonusCard->setExpDate($expDate);
            $bonusCard->setStatus($status);

            $manager->persist($bonusCard);
        }

        $manager->flush();
    }
}