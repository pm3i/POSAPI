<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosMedia
 *
 * @ORM\Table(name="pos_media")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosMediaRepository")
 */
class PosMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="media_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $media_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;

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
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=2000)
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
     * Set media_id
     *
     * @param integer $mediaId
     * @return PosMedia
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
     * Set name
     *
     * @param string $name
     * @return PosMedia
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
     * Set size
     *
     * @param integer $size
     * @return PosMedia
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return PosMedia
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set create_time
     *
     * @param string $createTime
     * @return PosMedia
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
     * @return PosMedia
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
     * @return PosMedia
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
     * Set userid
     *
     * @param integer $userid
     * @return PosMedia
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
     * Set action
     *
     * @param string $action
     * @return PosMedia
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
     * @return PosMedia
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
     * @return PosMedia
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
