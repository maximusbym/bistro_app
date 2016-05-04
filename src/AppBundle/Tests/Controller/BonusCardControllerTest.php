<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\BonusCard;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;

class BonusCardControllerTest extends WebTestCase
{
    use \Xpmock\TestCaseTrait;

    private $bonusCardRepository;

    public function setUp()
    {
        // Prepare the Mock
        $bonusCardMock = $this->mock('AppBundle\Entity\BonusCard')
            ->getStatus('active')
            ->new();

        $this->bonusCardRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->bonusCardRepository->expects($this->any())
            ->method('find')
            ->with($this->equalTo('AppBundle:BonusCard'), $this->equalTo('1'), $this->equalTo(null))
            ->will($this->returnValue($bonusCardMock));
    }

    public function tearDown()
    {

    }

    public function testDelete()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $container->set('doctrine.orm.default_entity_manager', $this->bonusCardRepository);

        $client->request('GET', '/bonus-card/delete/1');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testToggle()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $container->set('doctrine.orm.default_entity_manager', $this->bonusCardRepository);

        $client->request('GET', '/bonus-card/toggle/1.json');
        $response = $client->getResponse();

        $data = json_decode($response->getContent(), true);
        $this->assertSame(array('id' => 1, 'status' => 'inactive'), $data);
    }

}
