<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosMediaItems
 *
 * @ORM\Table(name="pos_media_items")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosMediaItemRepository")
 */
class PosMediaItems
{
    /**
     * @var integer
     *
     * @ORM\Column(name="media_items_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $media_items_id;


    /**
     * @var integer
     *
     * @ORM\Column(name="media_id", type="integer")
     */
    private $media_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="items_id", type="integer")
     */
    private $items_id;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=2000)
     */
    private $priority;



    /**
     * Set media_items_id
     *
     * @param integer $mediaItemsId
     * @return PosMediaItems
     */
    public function setMediaItemsId($mediaItemsId)
    {
        $this->media_items_id = $mediaItemsId;

        return $this;
    }

    /**
     * Get media_items_id
     *
     * @return integer 
     */
    public function getMediaItemsId()
    {
        return $this->media_items_id;
    }

    /**
     * Set media_id
     *
     * @param integer $mediaId
     * @return PosMediaItems
     */
    public function setMediaId($mediaId)
    {
        $this->media_id = $mediaId;

        return $this;
    }

    /**
     * Get media_id
     *
     * @return integer 
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Set items_id
     *
     * @param integer $itemsId
     * @return PosMediaItems
     */
    public function setItemsId($itemsId)
    {
        $this->items_id = $itemsId;

        return $this;
    }

    /**
     * Get items_id
     *
     * @return integer 
     */
    public function getItemsId()
    {
        return $this->items_id;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return PosMediaItems
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
}
