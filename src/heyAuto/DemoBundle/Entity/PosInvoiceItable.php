<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosInvoiceItable
 *
 * @ORM\Table(name ="pos_invoice_itable")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosInvoiceItableRepository")
 */
class PosInvoiceItable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_code", type="string", length=2000)
     */
    private $inv_code;

    /**
     * @var string
     *
     * @ORM\Column(name="code_table", type="string", length=250)
     */
    private $code_table;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="creattime", type="string", length=255)
     */
    private $creattime;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=1000)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=2000)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;


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
     * Set inv_code
     *
     * @param string $invCode
     * @return PosInvoiceItable
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
     * Set code_table
     *
     * @param string $codeTable
     * @return PosInvoiceItable
     */
    public function setCodeTable($codeTable)
    {
        $this->code_table = $codeTable;

        return $this;
    }

    /**
     * Get code_table
     *
     * @return string 
     */
    public function getCodeTable()
    {
        return $this->code_table;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return PosInvoiceItable
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
     * @return PosInvoiceItable
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
     * Set creattime
     *
     * @param string $creattime
     * @return PosInvoiceItable
     */
    public function setCreattime($creattime)
    {
        $this->creattime = $creattime;

        return $this;
    }

    /**
     * Get creattime
     *
     * @return string 
     */
    public function getCreattime()
    {
        return $this->creattime;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return PosInvoiceItable
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return PosInvoiceItable
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosInvoiceItable
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

////////////////////////////////////////////////////////////////////////////////////////
    
    public function toArray() {
    
        $posinvoiceItableData = null;
            $posinvoiceItableData = array(
            'mId'               => $this->getId(),
            'inv_code'          => $this->getInvCode(),
            'code_table'        => $this->getCodeTable(),
            'user_id'           => $this->getUserId(),
            'status'            => $this->getStatus(),
            'creattime'         => $this->getCreattime(),
            'action'            => $this->getAction(),
            'priority'          => $this->getPriority(),
            'company_code'      => $this->getCompanyCode(),
            );
            
        return $posinvoiceItableData;
    }
    
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
