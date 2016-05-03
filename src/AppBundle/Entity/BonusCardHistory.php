<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonusCardHistory
 *
 * @ORM\Table(name="bonus_card_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BonusCardHistoryRepository")
 */
class BonusCardHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="product_price", type="decimal", scale=2)
     */
    private $productPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="BonusCard", inversedBy="history")
     * @ORM\JoinColumn(name="bonus_card_id", referencedColumnName="id")
     */
    private $bonusCard;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return BonusCardHistory
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productPrice
     *
     * @param string $productPrice
     *
     * @return BonusCardHistory
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get productPrice
     *
     * @return string
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return BonusCardHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set bonusCard
     *
     * @param \AppBundle\Entity\BonusCard $bonusCard
     *
     * @return BonusCardHistory
     */
    public function setBonusCard(\AppBundle\Entity\BonusCard $bonusCard = null)
    {
        $this->bonusCard = $bonusCard;

        return $this;
    }

    /**
     * Get bonusCard
     *
     * @return \AppBundle\Entity\BonusCard
     */
    public function getBonusCard()
    {
        return $this->bonusCard;
    }
}
