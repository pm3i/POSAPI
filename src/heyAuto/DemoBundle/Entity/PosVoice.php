<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosVoice
 *
 * @ORM\Table(name ="pos_voice")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosVoiceRepository")
 */
class PosVoice
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
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=150)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=500)
     */
    private $user_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     */
    private $item_id;

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
     * Set name
     *
     * @param string $name
     * @return PosVoice
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
     * Set path
     *
     * @param string $path
     * @return PosVoice
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return PosVoice
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
     * Set date
     *
     * @param string $date
     * @return PosVoice
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user_id
     *
     * @param string $userId
     * @return PosVoice
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     * @return PosVoice
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
     * Set item_id
     *
     * @param integer $itemId
     * @return PosVoice
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosVoice
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
        $posvoiceData = null;
            $posvoiceData = array(
            'id'                 => $this->getId(),
            'name'               => $this->getName(),
            'path'               => $this->getPath(),
            'type'               => $this->getType(),
            'date'               => $this->getDate(),
            'user_id'            => $this->getUserId(),
            'flag'               => $this->getFlag(),
            'item_id'            => $this->getItemId(),
            'company_code'       => $this->getCompanyCode(),
            );
            
        return $posvoiceData;
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
