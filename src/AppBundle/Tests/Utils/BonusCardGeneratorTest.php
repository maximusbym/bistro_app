<?php

namespace AppBundle\Tests\Utils;

use AppBundle\Utils\BonusCardsGenerator;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;

class BonusCardGeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $entityManagerMock;
    private $bonusCardRepository;

    public function setUp()
    {
        // Prepare the Mock
        $this->bonusCardRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {

    }

    public function testGenerate()
    {
        $data = array('series'=>123, 'expInterval' => '1y', 'amount' => 5);

        $util = new BonusCardsGenerator($this->entityManagerMock);
        $res = $util->generate($data);

        $this->assertCount(5, $res);
        $this->assertEquals('AppBundle\Entity\BonusCard', get_class($res[0]));
    }


}
