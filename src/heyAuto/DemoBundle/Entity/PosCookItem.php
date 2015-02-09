<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosCookItem
 *
 * @ORM\Table(name="pos_cookitem")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosCookItemRepository")
 */
class PosCookItem
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
     * @ORM\Column(name="item_id", type="integer")
     */
    private $item_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float", length=53)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="cook_createtime", type="string", length=1000)
     */
    private $cook_createtime;

    /**
     * @var string
     *
     * @ORM\Column(name="cook_updatetime", type="string", length=1000)
     */
    private $cook_updatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=500)
     */
    private $notes;

    /**
     * @var integer
     *
     * @ORM\Column(name="checked", type="integer")
     */
    private $checked;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;

    /**
     * @var string
     *
     */
    private $imagename;


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
     * @return PosCookItem
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
     * Set user_id
     *
     * @param integer $userId
     * @return PosCookItem
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
     * Set quantity
     *
     * @param float $quantity
     * @return PosCookItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set cook_createtime
     *
     * @param string $cookCreatetime
     * @return PosCookItem
     */
    public function setCookCreatetime($cookCreatetime)
    {
        $this->cook_createtime = $cookCreatetime;

        return $this;
    }

    /**
     * Get cook_createtime
     *
     * @return string 
     */
    public function getCookCreatetime()
    {
        return $this->cook_createtime;
    }

    /**
     * Set cook_updatetime
     *
     * @param string $cookUpdatetime
     * @return PosCookItem
     */
    public function setCookUpdatetime($cookUpdatetime)
    {
        $this->cook_updatetime = $cookUpdatetime;

        return $this;
    }

    /**
     * Get cook_updatetime
     *
     * @return string 
     */
    public function getCookUpdatetime()
    {
        return $this->cook_updatetime;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return PosCookItem
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set checked
     *
     * @param integer $checked
     * @return PosCookItem
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosCookItem
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

    /**
     * Set imagename
     *
     * @param string $imagename
     * @return PosInvoiceItable
     */
    public function setImageName($imagename)
    {
        $this->imagename = $imagename;

        return $this;
    }

    /**
     * Get imagename
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imagename;
    }

 public function toArray() {
    
        $poscookItem = null;
            $poscookItem = array(
            'id'                => $this->getId(),
            'item_id'           => $this->getItemId(),
            'user_id'             => $this->getUserId(),
            'quantity'          => $this->getQuantity(),
            'cook_createtime'            => $this->getCookCreatetime(),
            'cook_updatetime'            => $this->getCookUpdatetime(),
            'notes'               => $this->getNotes(),
            'checked'            => $this->getChecked(),
            'company_code'     => $this->getCompanyCode(),
            'imagename'         => $this-> getImageName(),
            );
            
        return $poscookItem;
    }
}
