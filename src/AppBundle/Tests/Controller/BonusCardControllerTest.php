<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\BonusCard;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BonusCardControllerTest extends WebTestCase
{
    use \Xpmock\TestCaseTrait;
    private $entityManager;

    public function __construct()
    {
        parent::__construct();


    }
    
    public function setUp()
    {
        
    }

    public function tearDown()
    {

    }


    public function testEdit()
    {
        // First, mock the object to be used in the test
//        $bonusCard = $this->getMockBuilder('\AppBundle\Entity\BonusCard')
//            ->setMethods(['getNumber'])
//            ->disableOriginalConstructor()
//            ->getMock();
//        $bonusCard->expects($this->any())
//            ->method('getNumber')
//            ->will($this->returnValue(111111));

        $bonusCard = $this->mock('\AppBundle\Entity\BonusCard')
            ->getId(0)
            ->getSeries(111)
            ->getNumber(111111)
            ->getIssueDate(strtotime('Mar 31, 2015, 2:01:30 PM'))
            ->getExpDate(strtotime('Mar 31, 2016, 2:01:30 PM'))
            ->getStatus('expired')
            ->new();

        // Now, mock the repository so it returns the mock of the employee
        $bonusCardRepository = $this
            ->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $bonusCardRepository->expects($this->once())
            ->method('find')
            ->will($this->returnValue($bonusCard));

        // Last, mock the EntityManager to return the mock of the repository
        $this->entityManager = $this
            ->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();
        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($bonusCardRepository));

        $bonusCard = new BonusCard($this->entityManager);
        $bonusCard->setNumber(222222);
        $this->assertEquals(222222, $bonusCard->getNumber());
    }

//    public function testDelete()
//    {
//
//    }
//
//    public function testToggle()
//    {
//
//    }

}
