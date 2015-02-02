<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosUserGroupMap
 *
 * @ORM\Table(name="pos_user_usergroup_map")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosUserGroupMapRepository")
 */
class PosUserGroupMap
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_id", type="integer")
     */
    private $group_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_mobile_id", type="integer")
     */
    private $group_mobile_id;


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
     * Set user_id
     *
     * @param integer $userId
     * @return PosUserGroupMap
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
     * Set group_id
     *
     * @param integer $groupId
     * @return PosUserGroupMap
     */
    public function setGroupId($groupId)
    {
        $this->group_id = $groupId;

        return $this;
    }

    /**
     * Get group_id
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Set group_mobile_id
     *
     * @param integer $groupMobileId
     * @return PosUserGroupMap
     */
    public function setGroupMobileId($groupMobileId)
    {
        $this->group_mobile_id = $groupMobileId;

        return $this;
    }

    /**
     * Get group_mobile_id
     *
     * @return integer 
     */
    public function getGroupMobileId()
    {
        return $this->group_mobile_id;
    }
}
