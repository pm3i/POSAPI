<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosITable
 *
 * @ORM\Table(name="pos_itable")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosItableRepository")
 */
class PosITable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="itable_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $itable_id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_table", type="string", length=50, nullable=true)
     */
    private $code_table;

    /**
     * @var string
     *
     * @ORM\Column(name="description_table", type="string", length=250, nullable=true)
     */
    private $description_table;

    /**
     * @var string
     *
     * @ORM\Column(name="create_time", type="string", length=250, nullable=true)
     */
    private $create_time;

    /**
     * @var string
     *
     * @ORM\Column(name="update_time", type="string", length=250, nullable=true)
     */
    private $update_time;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer", nullable=true)
     */
    private $flag;

    /**
     * @var float
     *
     * @ORM\Column(name="pos_x", type="float", nullable=true)
     */
    private $pos_x;

    /**
     * @var float
     *
     * @ORM\Column(name="pos_y", type="float", nullable=true)
     */
    private $pos_y;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=1000, nullable=true)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=1000, nullable=true)
     */
    private $priority;

    /**
     * @var float
     *
     * @ORM\Column(name="location_x", type="float", nullable=true)
     */
    private $location_x;

    /**
     * @var float
     *
     * @ORM\Column(name="location_y", type="float", nullable=true)
     */
    private $location_y;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255, nullable=true)
     */
    private $company_code;
    

    /**
     * Set itable_id
     *
     * @param integer $itableId
     * @return PosITable
     */
    public function setItableId($itableId)
    {
        $this->itable_id = $itableId;

        return $this;
    }

    /**
     * Get itable_id
     *
     * @return integer 
     */
    public function getItableId()
    {
        return $this->itable_id;
    }

    /**
     * Set code_table
     *
     * @param string $codeTable
     * @return PosITable
     */
    public function setCodeTable($codeTable)
    {
        $this->code_table = $codeTable;

        return $this;
    }

    /**
     * Get code_table
     *
     * @return string 
     */
    public function getCodeTable()
    {
        return $this->code_table;
    }

    /**
     * Set description_table
     *
     * @param string $descriptionTable
     * @return PosITable
     */
    public function setDescriptionTable($descriptionTable)
    {
        $this->description_table = $descriptionTable;

        return $this;
    }

    /**
     * Get description_table
     *
     * @return string 
     */
    public function getDescriptionTable()
    {
        return $this->description_table;
    }

    /**
     * Set create_time
     *
     * @param string $createTime
     * @return PosITable
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
     * @return PosITable
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
     * Set status
     *
     * @param integer $status
     * @return PosITable
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
     * Set flag
     *
     * @param integer $flag
     * @return PosITable
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
     * Set pos_x
     *
     * @param float $posX
     * @return PosITable
     */
    public function setPosX($posX)
    {
        $this->pos_x = $posX;

        return $this;
    }

    /**
     * Get pos_x
     *
     * @return float 
     */
    public function getPosX()
    {
        return $this->pos_x;
    }

    /**
     * Set pos_y
     *
     * @param float $posY
     * @return PosITable
     */
    public function setPosY($posY)
    {
        $this->pos_y = $posY;

        return $this;
    }

    /**
     * Get pos_y
     *
     * @return float 
     */
    public function getPosY()
    {
        return $this->pos_y;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return PosITable
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
     * @return PosITable
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
     * @return PosITable
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
     * Set location_x
     *
     * @param float $locationX
     * @return PosITable
     */
    public function setLocationX($locationX)
    {
        $this->location_x = $locationX;

        return $this;
    }

    /**
     * Get location_x
     *
     * @return float 
     */
    public function getLocationX()
    {
        return $this->location_x;
    }

    /**
     * Set location_y
     *
     * @param float $locationY
     * @return PosITable
     */
    public function setLocationY($locationY)
    {
        $this->location_y = $locationY;

        return $this;
    }

    /**
     * Get location_y
     *
     * @return float 
     */
    public function getLocationY()
    {
        return $this->location_y;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosITable
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
    public static $ITABLE_DATA_ARRAY_FULL      = 0;
    public static $ITABLE_DATA_ARRAY_SHORT     = 1;
    
    public function toArray($arrayType = 0) {
        $posItableData = null;
        switch ($arrayType) {
            case (PosITable::$ITABLE_DATA_ARRAY_FULL):
                $posItableData = array(
                'itable_id'                 => $this->getItableId(),
                'code_table'                => $this->getCodeTable(),
                'description_table'         => $this->getDescriptionTable(),
                'create_time'               => $this->getCreateTime(),
                'update_time'               => $this->getUpdateTime(),
                'status'                    => $this->getStatus(),
                'flag'                      => $this->getFlag(),
                'pos_x'                     => $this->getPosX(),
                'pos_y'                     => $this->getPosY()
            );
            break;

            case (PosITable::$ITABLE_DATA_ARRAY_SHORT):
                $posItableData = array(
                "result"                    => "true"
            );
            break;
        }
            
            
        return $posItableData;
    }
/////////////////////////////////////////////////////////////////////////////////////////
}
