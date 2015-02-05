<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosItems
 *
 * @ORM\Table(name="pos_items")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosItemsRepository")
 */
class PosItems
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $item_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $category_id;

    /**
     * @var string
     *
     * @ORM\Column(name="create_time", type="string", length=500)
     */
    private $create_time;

    /**
     * @var string
     *
     * @ORM\Column(name="update_time", type="string", length=500)
     */
    private $update_time;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;

    /**
     * @var float
     *
     */
    private $price;

    /**
     * Set item_id
     *
     * @param integer $itemId
     * @return PosItems
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
     * Set name
     *
     * @param string $name
     * @return PosItems
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PosItems
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category_id
     *
     * @param integer $categoryId
     * @return PosItems
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set create_time
     *
     * @param string $createTime
     * @return PosItems
     */
    public function setCreateTime($createTime)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get create_time
     *
     * @return string 
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Set update_time
     *
     * @param string $updateTime
     * @return PosItems
     */
    public function setUpdateTime($updateTime)
    {
        $this->update_time = $updateTime;

        return $this;
    }

    /**
     * Get update_time
     *
     * @return string 
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     * @return PosItems
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosItems
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
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return float
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this->price;
    }

////////////////////////////////////////////////////////////////////////////////////////
    
    public function toArray() {
        $positemcostData = null;
            $positemcostData = array(
            'item_id'                 => $this->getItemId(),
            'name'                    => $this->getName(),
            'description'             => $this->getDescription(),
            'category_id'             => $this->getCategoryId(),
            'flag'                    => $this->getFlag(),
            'create_time'             => $this->getCreateTime(),
            'update_time'             => $this->getUpdateTime(),
            'company_code'            => $this->getCompanyCode(),
            );
            
        return $positemcostData;
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
