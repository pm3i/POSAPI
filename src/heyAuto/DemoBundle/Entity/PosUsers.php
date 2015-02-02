<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlElement;
use Symfony\Component\Translation\Tests\String;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\Column;
use Symfony\Bridge\Doctrine\Tests\Fixtures\DoubleNameEntity;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use JMS\Serializer\Annotation\Accessor;
use Symfony\Component\Config\Definition\IntegerNode;


/**
 * PosUsers
 *
 * @ORM\Table(name="pos_users")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosUserRepository")
 */
class PosUsers
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=150)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="usertype", type="string", length=25)
     */
    private $usertype;

    /**
     * @var integer
     *
     * @ORM\Column(name="block", type="integer")
     */
    private $block;

    /**
     * @var integer
     *
     * @ORM\Column(name="sendEmail", type="integer")
     */
    private $sendEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="registerDate", type="string", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $registerDate;

    /**
     * @var string
     *
     * @ORM\Column(name="lastvisitDate", type="string", nullable=true) 
     */
    private $lastvisitDate;

    /**
     * @var string
     *
     * @ORM\Column(name="activation", type="string", length=100)
     */
    private $activation;

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="string", length=500)
     */
    private $params;

    /**
     * @var string
     *
     * @ORM\Column(name="lastResetTime", type="string")
     */
    private $lastResetTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="resetCount", type="integer")
     */
    private $resetCount;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;

    /**
     * @var string
     *
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
     * Set name
     *
     * @param string $name
     * @return PosUsers
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
     * Set username
     *
     * @param string $username
     * @return PosUsers
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PosUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return PosUsers
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set usertype
     *
     * @param string $usertype
     * @return PosUsers
     */
    public function setUsertype($usertype)
    {
        $this->usertype = $usertype;

        return $this;
    }

    /**
     * Get usertype
     *
     * @return string 
     */
    public function getUsertype()
    {
        return $this->usertype;
    }

    /**
     * Set block
     *
     * @param integer $block
     * @return PosUsers
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return integer 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set sendEmail
     *
     * @param integer $sendEmail
     * @return PosUsers
     */
    public function setSendEmail($sendEmail)
    {
        $this->sendEmail = $sendEmail;

        return $this;
    }

    /**
     * Get sendEmail
     *
     * @return integer 
     */
    public function getSendEmail()
    {
        return $this->sendEmail;
    }

    /**
     * Set registerDate
     *
     * @param string $registerDate
     * @return PosUsers
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return string 
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set lastvisitDate
     *
     * @param string $lastvisitDate
     * @return PosUsers
     */
    public function setLastvisitDate($lastvisitDate)
    {
        $this->lastvisitDate = $lastvisitDate;

        return $this;
    }

    /**
     * Get lastvisitDate
     *
     * @return string 
     */
    public function getLastvisitDate()
    {
        return $this->lastvisitDate;
    }

    /**
     * Set activation
     *
     * @param string $activation
     * @return PosUsers
     */
    public function setActivation($activation)
    {
        $this->activation = $activation;

        return $this;
    }

    /**
     * Get activation
     *
     * @return string 
     */
    public function getActivation()
    {
        return $this->activation;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return PosUsers
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string 
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set lastResetTime
     *
     * @param string $lastResetTime
     * @return PosUsers
     */
    public function setLastResetTime($lastResetTime)
    {
        $this->lastResetTime = $lastResetTime;

        return $this;
    }

    /**
     * Get lastResetTime
     *
     * @return string 
     */
    public function getLastResetTime()
    {
        return $this->lastResetTime;
    }

    /**
     * Set resetCount
     *
     * @param integer $resetCount
     * @return PosUsers
     */
    public function setResetCount($resetCount)
    {
        $this->resetCount = $resetCount;

        return $this;
    }

    /**
     * Get resetCount
     *
     * @return integer 
     */
    public function getResetCount()
    {
        return $this->resetCount;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosUsers
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
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this->title;
    }


////////////////////////////////////////////////////////////////////////////////////////
    
    public function toArray() {
        // $posUserGroupMap = $this->getPosUserGroupMap();
        // if( !$posUserGroupMap->isEmpty() ) {
        //     $currentPosUserGroupMap = $posUserGroupMap->get(0)->toArray();
        // }

        // truy van lay du lieu tu bang PosGroupMobile

        // loc ra  va cho vao mot bie
    
        $posusersData = null;
            $posusersData = array(
            'mId'               => $this->getId(),
            'mName'             => $this->getName(),
            'mUsername'         => $this->getUsername(),
            'mEmail'            => $this->getEmail(),
            //'mPassword'         => $this->getPassword(),
            'mUsertype'         => $this->getUsertype(),
            'mBlock'            => $this->getBlock(),
            'mSendEmail'        => $this->getSendEmail(),
            'mRegisterDate'     => $this->getUsername(),
            'mLastvisitDate'    => $this->getLastvisitDate(),
            'mActivation'       => $this->getActivation(),
            'mParams'           => $this->getParams(),
            'mLastResetTime'    => $this->getLastResetTime(),
            'mResetCount'       => $this->getResetCount(),
            'mCompany_code'     => $this->getCompanyCode(),
            'mTitle'            => $this->getTitle(),
            'mResult'           => "success"
            );
            
        return $posusersData;
    }

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
