<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosInvoiceDetail
 *
 * @ORM\Table(name="pos_invoice_detail")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosInvoiceDetailRepository")
 */
class PosInvoiceDetail
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
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=true)
     */
    private $item_id;

    /**
     * @var string
     *
     * @ORM\Column(name="inv_code", type="string", length=2000, nullable=true)
     */
    private $inv_code;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer", nullable=true)
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=250, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="invd_createtime", type="string", length=500, nullable=true)
     */
    private $invd_createtime;

    /**
     * @var string
     *
     * @ORM\Column(name="invd_updatetime", type="string", length=500, nullable=true)
     */
    private $invd_updatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="checked", type="integer", nullable=true)
     */
    private $checked;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="creattime", type="string", length=500, nullable=true)
     */
    private $creattime;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=2000, nullable=true)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=2000, nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255, nullable=true)
     */
    private $company_code;

    /**
     * @var float
     */
    private $price;

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
     * Set item_id
     *
     * @param integer $itemId
     * @return PosInvoiceDetail
     */
    public function setItemId($itemId)
    {
        $this->item_id = $itemId;

        return $this;
    }

    /**
     * Get item_id
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return PosInvoiceDetail
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set inv_code
     *
     * @param string $invCode
     * @return PosInvoiceDetail
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
     * Set flag
     *
     * @param integer $flag
     * @return PosInvoiceDetail
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return integer 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return PosInvoiceDetail
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return PosInvoiceDetail
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set invd_createtime
     *
     * @param string $invdCreatetime
     * @return PosInvoiceDetail
     */
    public function setInvdCreatetime($invdCreatetime)
    {
        $this->invd_createtime = $invdCreatetime;

        return $this;
    }

    /**
     * Get invd_createtime
     *
     * @return string 
     */
    public function getInvdCreatetime()
    {
        return $this->invd_createtime;
    }

    /**
     * Set invd_updatetime
     *
     * @param string $invdUpdatetime
     * @return PosInvoiceDetail
     */
    public function setInvdUpdatetime($invdUpdatetime)
    {
        $this->invd_updatetime = $invdUpdatetime;

        return $this;
    }

    /**
     * Get invd_updatetime
     *
     * @return string 
     */
    public function getInvdUpdatetime()
    {
        return $this->invd_updatetime;
    }

    /**
     * Set checked
     *
     * @param integer $checked
     * @return PosInvoiceDetail
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return integer 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return PosInvoiceDetail
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set creattime
     *
     * @param string $creattime
     * @return PosInvoiceDetail
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
     * @return PosInvoiceDetail
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
     * @return PosInvoiceDetail
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
     * @return PosInvoiceDetail
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
        $posinvDetailData = null;
            $posinvDetailData = array(
            'id'                      => $this->getId(),
            'item_id'                 => $this->getItemId(),
            'inv_code'                => $this->getInvCode(),
            'flag'                    => $this->getFlag(),
            'quantity'                => $this->getQuantity(),
            'comment'                 => $this->getComment(),
            'invd_createtime'         => $this->getInvdCreatetime(),
            'invd_updatetime'         => $this->getInvdUpdatetime(),
            'checked'                 => $this->getChecked(),
            'userid'                  => $this->getUserid(),
            'creattime'               => $this->getCreattime(),
            'action'                  => $this->getAction(),
            'priority'                => $this->getPriority(),
            'company_code'            => $this->getCompanyCode(),
            'price'                   => $this->getPrice(),

            );
            
        return $posinvDetailData;
    }

    public function toString() {
        return print_r($this->toArray(),1);
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
