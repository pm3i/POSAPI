<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosStageITable
 *
 * @ORM\Table(name = "pos_stage_itable")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosStageITableRepository")
 */
class PosStageITable
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
     * @ORM\Column(name="id_itable", type="integer")
     */
    private $id_itable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_stage", type="integer")
     */
    private $id_stage;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;


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
     * Set id_itable
     *
     * @param integer $idItable
     * @return PosStageITable
     */
    public function setIdItable($idItable)
    {
        $this->id_itable = $idItable;

        return $this;
    }

    /**
     * Get id_itable
     *
     * @return integer 
     */
    public function getIdItable()
    {
        return $this->id_itable;
    }

    /**
     * Set id_stage
     *
     * @param integer $idStage
     * @return PosStageITable
     */
    public function setIdStage($idStage)
    {
        $this->id_stage = $idStage;

        return $this;
    }

    /**
     * Get id_stage
     *
     * @return integer 
     */
    public function getIdStage()
    {
        return $this->id_stage;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PosStageITable
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
     * Set status
     *
     * @param integer $status
     * @return PosStageITable
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

	

	public function toArray() {

    
        $tablesonastageData = null;
            $tablesonastageData = array(
            'mId'               	=> $this->getId(),
            'mId_itable'             	=> $this->getIdItable(),
            'mId_stage'         	=> $this->getIdStage(),
            'mDescription'            	=> $this->getDescription(),
            'mStatus'     		=> $this->getStatus(),
            'mResult'           	=> "success"
            );
            
        return $tablesonastageData;
    }
}
