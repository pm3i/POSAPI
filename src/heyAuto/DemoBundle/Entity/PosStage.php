<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosStage
 *
 * @ORM\Table(name="pos_stage")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosStageRepository")
 */
class PosStage
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
     * @ORM\Column(name="code", type="string", length=250)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    private $create_time;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime")
     */
    private $update_time;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=500)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

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
     * Set code
     *
     * @param string $code
     * @return PosStage
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return PosStage
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
     * Set create_time
     *
     * @param \DateTime $createTime
     * @return PosStage
     */
    public function setCreateTime($createTime)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get create_time
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Set update_time
     *
     * @param \DateTime $updateTime
     * @return PosStage
     */
    public function setUpdateTime($updateTime)
    {
        $this->update_time = $updateTime;

        return $this;
    }

    /**
     * Get update_time
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PosStage
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
     * Set image
     *
     * @param string $image
     * @return PosStage
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return PosStage
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosStage
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


//////////////////////////////////////////
    public static $STAGE_DATA_ARRAY_FULL     = 0;
    public static $STAGE_DATA_ARRAY_SHORT     = 1;

    public function toArray($arrayType = 0) {
        
    
        $posstagesData = null;


        switch ($arrayType) {

            case (PosStage::$STAGE_DATA_ARRAY_FULL):
                 $posstagesData = array(
                'mId'               => $this->getId(),
                'mCode'             => $this->getCode(),
                'mStatus'           => $this->getStatus(),
                'mCreate_time'      => $this->getCreateTime(),
                'mUpdate_time'      => $this->getUpdateTime(),
                'mDescription'      => $this->getDescription(),
                'mImage'            => $this->getImage(),
                'mUser_id'          => $this->getUserId(),
                'mCompany_code'     => $this->getCompanyCode(),
            );
                break;
            case (PosStage::$STAGE_DATA_ARRAY_SHORT):
                 $posstagesData = array(
                'mId'               => $this->getId(),
                'mCode'             => $this->getCode(),
                'mStatus'           => $this->getStatus(),
                //'mCreate_time'      => $this->getCreateTime(),
                //'mUpdate_time'      => $this->getUpdateTime(),
                'mDescription'      => $this->getDescription(),
                //'mImage'            => $this->getImage(),
                //'mUser_id'          => $this->getUserId(),
                //'mCompany_code'     => $this->getCompanyCode(),
                );
                break;

            default:
                # code...
                break;
        }
            
        return $posstagesData;
    }
    
}
