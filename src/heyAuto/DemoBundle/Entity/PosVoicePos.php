<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosVoicePos
 *
 * @ORM\Table(name = "pos_voice_pos")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosVoicePosRepository")
 */
class PosVoicePos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voice_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voice_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="invdetail_id", type="integer", nullable=true)
     */
    private $invdetail_id;

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
     * @var integer
     *
     * @ORM\Column(name="checked", type="integer", nullable=true)
     */
    private $checked;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user_id;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255, nullable=true)
     */
    private $company_code;


    /**
     * @var string
     *
     */
    private $code_table;

    /**
     * Set voice_id
     *
     * @param integer $voiceId
     * @return PosVoicePos
     */
    public function setVoiceId($voiceId)
    {
        $this->voice_id = $voiceId;

        return $this;
    }

    /**
     * Get voice_id
     *
     * @return integer 
     */
    public function getVoiceId()
    {
        return $this->voice_id;
    }

    /**
     * Set invdetail_id
     *
     * @param integer $invdetailId
     * @return PosVoicePos
     */
    public function setInvdetailId($invdetailId)
    {
        $this->invdetail_id = $invdetailId;

        return $this;
    }

    /**
     * Get invdetail_id
     *
     * @return integer 
     */
    public function getInvdetailId()
    {
        return $this->invdetail_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return PosVoicePos
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
     * @return PosVoicePos
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
     * Set checked
     *
     * @param integer $checked
     * @return PosVoicePos
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return integer 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return PosVoicePos
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return PosVoicePos
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
     * @return PosVoicePos
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

     /**
     * Set code_table
     *
     * @param string $code_table
     * @return PosVoicePos
     */
    public function setCodeTable($code_table)
    {
        $this->code_table = $code_table;

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
////////////////////////////////////////////////////////////////////////////////////////
    
    public function toArray() {
        $posvoiceData = null;
            $posvoiceData = array(
            'voice_id'           => $this->getVoiceId(),
            'invdetail_id'       => $this->getInvdetailId(),
            'status'             => $this->getStatus(),
            'flag'               => $this->getFlag(),
            'checked'            => $this->getChecked(),
            'type'               => $this->getType(),
            'user_id'            => $this->getUserId(),
            'company_code'       => $this->getCompanyCode(),
            'code_table'         => $this->getCodeTable()
            );
            
        return $posvoiceData;
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
