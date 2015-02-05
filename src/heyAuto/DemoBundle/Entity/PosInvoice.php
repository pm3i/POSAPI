<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosInvoice
 *
 * @ORM\Table(name ="pos_invoice")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosInvoiceRepository")
 */
class PosInvoice
{
    /**
     * @var integer
     *
     * @ORM\Column(name="inv_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $inv_id;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_code", type="string", length=2000, nullable=true)
     */
    private $inv_code;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", length=53, nullable=true)
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", length=53, nullable=true)
     */
    private $cost;

    /**
     * @var float
     *
     * @ORM\Column(name="vat", type="float", length=53, nullable=true)
     */
    private $vat;

    /**
     * @var float
     *
     * @ORM\Column(name="commision", type="float", length=53, nullable=true)
     */
    private $commision;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_endtime", type="string", length=500, nullable=true)
     */
    private $inv_endtime;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_starttime", type="string", length=500, nullable=true)
     */
    private $inv_starttime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="inv_type", type="integer", nullable=true)
     */
    private $inv_type;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_code_parent", type="string", length=2000, nullable=true)
     */
    private $inv_code_parent;

    /**
     * @var integer
     *
     * @ORM\Column(name="printStatus", type="integer", nullable=true)
     */
    private $printStatus;

    /**
     * @var float
     *
     * @ORM\Column(name="inv_salesoff", type="float", length=53, nullable=true)
     */
    private $inv_salesoff;

    /**
     * @var float
     *
     * @ORM\Column(name="inv_arise", type="float", length=53, nullable=true)
     */
    private $inv_arise;

    /**
     * @var string
     *
     * @ORM\Column(name="arise_comment", type="string", length=100, nullable=true)
     */
    private $arise_comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $client_id;

    /**
     * @var float
     *
     * @ORM\Column(name="pay_cost", type="float", length=53, nullable=true)
     */
    private $pay_cost;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255, nullable=true)
     */
    private $company_code;

     /**
     * @var string
     *
     * @ORM\Column(name="repayment_date", type="string", length=500, nullable=true)
     */
    private $repayment_date;


    /**
     * Set inv_id
     *
     * @param integer $invId
     * @return PosInvoice
     */
    public function setInvId($invId)
    {
        $this->inv_id = $invId;

        return $this;
    }

    /**
     * Get inv_id
     *
     * @return integer 
     */
    public function getInvId()
    {
        return $this->inv_id;
    }

    /**
     * Set inv_code
     *
     * @param string $invCode
     * @return PosInvoice
     */
    public function setInvCode($invCode)
    {
        $this->inv_code = $invCode;

        return $this;
    }

    /**
     * Get inv_code
     *
     * @return string 
     */
    public function getInvCode()
    {
        return $this->inv_code;
    }

    /**
     * Set repayment_date
     *
     * @param string $repayment_date
     * @return PosInvoice
     */
    public function setRepaymentDate($repayment_date)
    {
        $this->repayment_date = $repayment_date;

        return $this;
    }

    /**
     * Get repayment_date
     *
     * @return string 
     */
    public function getRepaymentDate()
    {
        return $this->repayment_date;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return PosInvoice
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set cost
     *
     * @param float $cost
     * @return PosInvoice
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set vat
     *
     * @param float $vat
     * @return PosInvoice
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return float 
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set commision
     *
     * @param float $commision
     * @return PosInvoice
     */
    public function setCommision($commision)
    {
        $this->commision = $commision;

        return $this;
    }

    /**
     * Get commision
     *
     * @return float 
     */
    public function getCommision()
    {
        return $this->commision;
    }

    /**
     * Set inv_endtime
     *
     * @param string $invEndtime
     * @return PosInvoice
     */
    public function setInvEndtime($invEndtime)
    {
        $this->inv_endtime = $invEndtime;

        return $this;
    }

    /**
     * Get inv_endtime
     *
     * @return string 
     */
    public function getInvEndtime()
    {
        return $this->inv_endtime;
    }

    /**
     * Set inv_starttime
     *
     * @param string $invStarttime
     * @return PosInvoice
     */
    public function setInvStarttime($invStarttime)
    {
        $this->inv_starttime = $invStarttime;

        return $this;
    }

    /**
     * Get inv_starttime
     *
     * @return string 
     */
    public function getInvStarttime()
    {
        return $this->inv_starttime;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return PosInvoice
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return PosInvoice
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set inv_type
     *
     * @param integer $invType
     * @return PosInvoice
     */
    public function setInvType($invType)
    {
        $this->inv_type = $invType;

        return $this;
    }

    /**
     * Get inv_type
     *
     * @return integer 
     */
    public function getInvType()
    {
        return $this->inv_type;
    }

    /**
     * Set inv_code_parent
     *
     * @param string $invCodeParent
     * @return PosInvoice
     */
    public function setInvCodeParent($invCodeParent)
    {
        $this->inv_code_parent = $invCodeParent;

        return $this;
    }

    /**
     * Get inv_code_parent
     *
     * @return string 
     */
    public function getInvCodeParent()
    {
        return $this->inv_code_parent;
    }

    /**
     * Set printStatus
     *
     * @param integer $printStatus
     * @return PosInvoice
     */
    public function setPrintStatus($printStatus)
    {
        $this->printStatus = $printStatus;

        return $this;
    }

    /**
     * Get printStatus
     *
     * @return integer 
     */
    public function getPrintStatus()
    {
        return $this->printStatus;
    }

    /**
     * Set inv_salesoff
     *
     * @param float $invSalesoff
     * @return PosInvoice
     */
    public function setInvSalesoff($invSalesoff)
    {
        $this->inv_salesoff = $invSalesoff;

        return $this;
    }

    /**
     * Get inv_salesoff
     *
     * @return float 
     */
    public function getInvSalesoff()
    {
        return $this->inv_salesoff;
    }

    /**
     * Set inv_arise
     *
     * @param float $invArise
     * @return PosInvoice
     */
    public function setInvArise($invArise)
    {
        $this->inv_arise = $invArise;

        return $this;
    }

    /**
     * Get inv_arise
     *
     * @return float 
     */
    public function getInvArise()
    {
        return $this->inv_arise;
    }

    /**
     * Set arise_comment
     *
     * @param string $ariseComment
     * @return PosInvoice
     */
    public function setAriseComment($ariseComment)
    {
        $this->arise_comment = $ariseComment;

        return $this;
    }

    /**
     * Get arise_comment
     *
     * @return string 
     */
    public function getAriseComment()
    {
        return $this->arise_comment;
    }

    /**
     * Set client_id
     *
     * @param integer $clientId
     * @return PosInvoice
     */
    public function setClientId($clientId)
    {
        $this->client_id = $clientId;

        return $this;
    }

    /**
     * Get client_id
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Set pay_cost
     *
     * @param float $payCost
     * @return PosInvoice
     */
    public function setPayCost($payCost)
    {
        $this->pay_cost = $payCost;

        return $this;
    }

    /**
     * Get pay_cost
     *
     * @return float 
     */
    public function getPayCost()
    {
        return $this->pay_cost;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosClient
     */
    public function setCompanyCode($companyCode)
    {
        $this->company_code = $companyCode;

        return $this;
    }

    /**
     * Get company_code
     *
     * @return string 
     */
    public function getCompanyCode()
    {
        return $this->company_code;
    }
}
