<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\BonusCard;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BonusCardControllerTest extends WebTestCase
{
    use \Xpmock\TestCaseTrait;

    private $bonusCardRepository;
    
    public function setUp()
    {
        // Prepare the Mock
        $bonusCard = $this->mock('\AppBundle\Entity\BonusCard')
            ->id(1)
            ->getSeries(111)
            ->getNumber(111111)
            ->getIssueDate(strtotime('Mar 31, 2015, 2:01:30 PM'))
            ->getExpDate(strtotime('Mar 31, 2016, 2:01:30 PM'))
            ->getStatus('expired')
            ->new();

        $this->bonusCardRepository = $this
            ->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $this->bonusCardRepository->expects($this->any())
            ->method('find')
            ->will($this->returnValue($bonusCard));
    }

    public function tearDown()
    {

    }


//    public function testEdit()
//    {
//
//    }

    public function testDelete()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $container->set('doctrine.orm.default_entity_manager', $this->bonusCardRepository);

        // deleting
        $crawler = $client->request('GET', '/bonus-card/delete/1');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        // check if deleted
        $crawler = $client->request('GET', '/bonus-card/delete/1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
//
//    public function testToggle()
//    {
//
//    }

}
