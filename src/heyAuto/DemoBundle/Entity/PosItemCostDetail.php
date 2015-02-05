<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosItemCostDetail
 *
 * @ORM\Table(name="pos_items_cost_detail")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosItemCostDetailRepository")
 */
class PosItemCostDetail
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
     * @ORM\Column(name="items_cost_id", type="integer")
     */
    private $items_cost_id;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", length=53)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer")
     */
    private $currency_id;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=500)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     */
    private $item_id;


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
     * Set items_cost_id
     *
     * @param integer $itemsCostId
     * @return PosItemCostDetail
     */
    public function setItemsCostId($itemsCostId)
    {
        $this->items_cost_id = $itemsCostId;

        return $this;
    }

    /**
     * Get items_cost_id
     *
     * @return integer 
     */
    public function getItemsCostId()
    {
        return $this->items_cost_id;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return PosItemCostDetail
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
     * Set flag
     *
     * @param integer $flag
     * @return PosItemCostDetail
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
     * Set currency_id
     *
     * @param integer $currencyId
     * @return PosItemCostDetail
     */
    public function setCurrencyId($currencyId)
    {
        $this->currency_id = $currencyId;

        return $this;
    }

    /**
     * Get currency_id
     *
     * @return integer 
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return PosItemCostDetail
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
     * Set item_id
     *
     * @param integer $itemId
     * @return PosItemCostDetail
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
////////////////////////////////////////////////////////////////////////////////////////
    
    public function toArray() {
        $positemCostDetailData = null;
            $positemCostDetailData = array(
            'price'                      => $this->getPrice()

            );
            
        return $positemCostDetailData;
    }

    public function toString() {
        return print_r($this->toArray(),0);
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
