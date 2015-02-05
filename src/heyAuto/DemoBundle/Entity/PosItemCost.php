<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosItemCost
 *
 * @ORM\Table(name = "pos_item_cost")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosItemCostRepository")
 */
class PosItemCost
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
     * @ORM\Column(name="cost_name", type="string", length=255)
     */
    private $cost_name;

    /**
     * @var string
     *
     * @ORM\Column(name="start_date", type="string", length=500)
     */
    private $start_date;

    /**
     * @var string
     *
     * @ORM\Column(name="end_date", type="string", length=500)
     */
    private $end_date;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

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
     * Set cost_name
     *
     * @param string $costName
     * @return PosItemCost
     */
    public function setCostName($costName)
    {
        $this->cost_name = $costName;

        return $this;
    }

    /**
     * Get cost_name
     *
     * @return string 
     */
    public function getCostName()
    {
        return $this->cost_name;
    }

    /**
     * Set start_date
     *
     * @param string $startDate
     * @return PosItemCost
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get start_date
     *
     * @return string 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param string $endDate
     * @return PosItemCost
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return string 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return PosItemCost
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
     * Set create_time
     *
     * @param string $createTime
     * @return PosItemCost
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
     * @return PosItemCost
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosItemCost
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
        $positemcostData = null;
            $positemcostData = array(
            'id'                 => $this->getId(),
            'cost_name'               => $this->getCostName(),
            'start_date'               => $this->getStartDate(),
            'end_date'               => $this->getEndDate(),
            'user_id'               => $this->getUserId(),
            'create_time'               => $this->getCreateTime(),
            'update_time'               => $this->getUpdateTime(),
            'company_code'       => $this->getCompanyCode(),
            );
            
        return $positemcostData;
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
