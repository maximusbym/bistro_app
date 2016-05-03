<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\BonusCard;
use AppBundle\Entity\BonusCardHistory;
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



            $historyItems = rand(1,8);
            for( $k=0; $k<$historyItems; $k++ ){

                $bonusCardHistory = new BonusCardHistory();
                $maxDate = ($expDate > $currDate) ? 'now' : $expDate ;
                $bonusCardHistory->setDate($faker->dateTimeBetween($issueDate, $maxDate));
                $bonusCardHistory->setProductName($faker->company());
                $bonusCardHistory->setProductPrice($faker->randomFloat(2,1,10000));
                $bonusCardHistory->setBonusCard($bonusCard);

                $manager->persist($bonusCardHistory);
            }


        }

        $manager->flush();

    }




    



}