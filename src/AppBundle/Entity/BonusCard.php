<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\BonusCardRepository;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BonusCardRepository")
 * @ORM\Table(name="bonus_card")
 * @GRID\Source(columns="id, number, issueDate, expDate, status")
 */
class BonusCard
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_EXPIRED = 'expired';

    /**
     * @ORM\OneToMany(targetEntity="BonusCardHistory", mappedBy="bonusCard", cascade={"persist", "remove"})
     */
    private $history;

    public function __construct()
    {
        $this->history = new ArrayCollection();
    }
    
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(title="ID", type="number", size="40", operatorsVisible=false, primary=true, align="center")
     */
    private $id;

    /**
     * @ORM\Column(name="series", type="smallint", length=3)
     * @GRID\Column(title="Series", type="number", operatorsVisible=false, align="center")
     */
    private $series;

    /**
     * @ORM\Column(name="number", type="integer", length=6)
     * @GRID\Column(title="Number", type="number", operatorsVisible=false, align="center")
     */
    private $number;

    /**
     * @ORM\Column(name="issue_date", type="datetime")
     * @GRID\Column(title="issueDate", type="datetime", defaultOperator="btwe", operatorsVisible=false, align="center")
     */
    private $issueDate;

    /**
     * @ORM\Column(name="exp_date", type="datetime")
     * @GRID\Column(title="expDate", type="datetime", defaultOperator="btwe", operatorsVisible=false, align="center")
     */
    private $expDate;


    /**
     * @ORM\Column(type="string")
     * @GRID\Column(title="Status", defaultOperator="eq", operatorsVisible=false, filter="select", selectFrom="values",
     *     values={"active"="active","inactive"="inactive","expired"="expired"}, align="center")
     */
    private $status;

    public function setStatus($status)
    {
        if (!in_array($status, array(self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_EXPIRED))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
    }




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set series
     *
     * @param integer $series
     * @return BonusCard
     */
    public function setSeries($series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return integer 
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return BonusCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set issueDate
     *
     * @param \DateTime $issueDate
     * @return BonusCard
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    /**
     * Get issueDate
     *
     * @return \DateTime 
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Set expDate
     *
     * @param \DateTime $expDate
     * @return BonusCard
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;

        return $this;
    }

    /**
     * Get expDate
     *
     * @return \DateTime 
     */
    public function getExpDate()
    {
        return $this->expDate;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add history
     *
     * @param \AppBundle\Entity\BonusCardHistory $history
     *
     * @return BonusCard
     */
    public function addHistory(\AppBundle\Entity\BonusCardHistory $history)
    {
        $this->history[] = $history;

        return $this;
    }

    /**
     * Remove history
     *
     * @param \AppBundle\Entity\BonusCardHistory $history
     */
    public function removeHistory(\AppBundle\Entity\BonusCardHistory $history)
    {
        $this->history->removeElement($history);
    }

    /**
     * Get history
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistory()
    {
        return $this->history;
    }
}
