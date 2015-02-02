<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosGroupMobile
 *
 * @ORM\Table(name="pos_group_mobile")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosGroupMobileRepository")
 */
class PosGroupMobile
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * Set title
     *
     * @param string $title
     * @return PosGroupMobile
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @see \Serializable::serialize()
     */
     public function getTitleUser() {

        return array(
                $this->getTitle()
        );
    }
////////////////////////////////////////////////////////////////////////////////////////
}
