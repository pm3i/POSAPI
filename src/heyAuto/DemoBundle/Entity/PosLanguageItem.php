<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosLanguageItem
 *
 * @ORM\Table(name="pos_language_item")
 * @ORM\Entity
 */
class PosLanguageItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lng_item_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $lng_item_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     */
    private $item_id;

    /**
     * @var string
     *
     * @ORM\Column(name="lng_value", type="string", length=500)
     */
    private $lng_value;

    /**
     * @var integer
     *
     * @ORM\Column(name="lng_code", type="integer")
     */
    private $lng_code;


    /**
     * Set lng_item_id
     *
     * @param integer $lngItemId
     * @return PosLanguageItem
     */
    public function setLngItemId($lngItemId)
    {
        $this->lng_item_id = $lngItemId;

        return $this;
    }

    /**
     * Get lng_item_id
     *
     * @return integer 
     */
    public function getLngItemId()
    {
        return $this->lng_item_id;
    }

    /**
     * Set item_id
     *
     * @param integer $itemId
     * @return PosLanguageItem
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
     * Set lng_value
     *
     * @param string $lngValue
     * @return PosLanguageItem
     */
    public function setLngValue($lngValue)
    {
        $this->lng_value = $lngValue;

        return $this;
    }

    /**
     * Get lng_value
     *
     * @return string 
     */
    public function getLngValue()
    {
        return $this->lng_value;
    }

    /**
     * Set lng_code
     *
     * @param integer $lngCode
     * @return PosLanguageItem
     */
    public function setLngCode($lngCode)
    {
        $this->lng_code = $lngCode;

        return $this;
    }

    /**
     * Get lng_code
     *
     * @return integer 
     */
    public function getLngCode()
    {
        return $this->lng_code;
    }
}
