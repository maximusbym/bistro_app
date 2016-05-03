<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\BonusCard;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;

class BonusCardControllerTest extends WebTestCase
{
    use \Xpmock\TestCaseTrait;

    private $entityManagerMock;

    public function setUp()
    {
        // Prepare the Mock
        $bonusCardMock = $this->mock('AppBundle:BonusCard')
            ->getId(1)
            ->getSeries(111)
            ->getNumber(111111)
            ->getIssueDate(strtotime('Mar 31, 2015, 2:01:30 PM'))
            ->getExpDate(strtotime('Mar 31, 2016, 2:01:30 PM'))
            ->getStatus('expired')
            ->new();

        $bonusCardRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $bonusCardRepository->expects($this->any())
            ->method('find')
            ->with($this->equalTo('AppBundle:BonusCard'), $this->equalTo('1'), $this->equalTo(null))
            ->will($this->returnValue($bonusCardMock));

        $this->entityManagerMock = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($bonusCardRepository));
    }

    public function tearDown()
    {

    }

//    public function testEdit()
//    {
//
//            ToDo: use $this->bonusCardMock;
//    }

    // Values of Mock properties are not important in this test case
    public function testDelete()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $container->set('doctrine.orm.default_entity_manager', $this->entityManagerMock);

        // deleting
        $crawler = $client->request('GET', '/bonus-card/delete/1');
        dump($crawler->html());
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
