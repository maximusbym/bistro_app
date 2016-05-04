<?php

namespace AppBundle\Tests\Utils;

use AppBundle\Utils\StatusUpdater;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;

class StatusUpdaterTest extends \PHPUnit_Framework_TestCase
{
    use \Xpmock\TestCaseTrait;

    private $entityManagerMock;
    private $bonusCardRepository;

    public function setUp()
    {
        // Prepare the Mock
        $pastDate = new \DateTime();
        $pastDate->add(\DateInterval::createFromDateString('yesterday'));

        $bonusCardMock = array(
            $this->mock('AppBundle\Entity\BonusCard')
            ->getStatus('active')
            ->getExpDate($pastDate)
            ->new(),
            $this->mock('AppBundle\Entity\BonusCard')
            ->getStatus('expired')
            ->getExpDate($pastDate)
            ->new(),
        );

        $this->bonusCardRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->bonusCardRepository->expects($this->any())
            ->method('findAll')
            ->will($this->returnValue($bonusCardMock));

        $this->entityManagerMock = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($this->bonusCardRepository));
    }

    public function tearDown()
    {

    }

    public function testUpdate()
    {
        $util = new StatusUpdater($this->entityManagerMock);
        $res = $util->update();

        $this->assertEquals('Updated: 1', $res);
    }


}
