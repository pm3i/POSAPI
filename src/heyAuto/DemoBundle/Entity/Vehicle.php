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
use Doctrine\ORM\EntityRepository;

/**
 * Vehicle
 *
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\VehicleRepository")
 * @ORM\Table(name="vehicle")
 */
class Vehicle
{
    	    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
 	 * @XmlElement(cdata=false)
     */
    private $id;

//     /**
//      * @var integer
//      *
//      * @ORM\Column(name="user_id", type="integer")
//      * @XmlElement(cdata=false)
//      */
//     private $userId;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="vehicles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=255, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $make;
    
    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $model;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $color;
    
    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=4, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $year;
    
    /**
     * @var string
     *
     * @ORM\Column(name="registration_no", type="string", length=15, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $registrationNo;
	
////////////////////////////////////////////////////////////////////////////////////////

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
     * Set make
     *
     * @param string $make
     * @return Vehicle
     */
    public function setMake($make)
    {
    	$this->make = $make;
    
    	return $this;
    }
    
    /**
     * Get make
     *
     * @return string
     */
    public function getMake()
    {
    	return $this->make;
    }
    
    /**
     * Set model
     *
     * @param string $model
     * @return Vehicle
     */
    public function setModel($model)
    {
    	$this->model = $model;
    
    	return $this;
    }
    
    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
    	return $this->model;
    }
    
    /**
     * Set color
     *
     * @param string $color
     * @return Vehicle
     */
    public function setColor($color)
    {
    	$this->color = $color;
    
    	return $this;
    }
    
    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
    	return $this->color;
    }
    
    /**
     * Set year
     *
     * @param string $year
     * @return Vehicle
     */
    public function setYear($year)
    {
    	$this->year = $year;
    
    	return $this;
    }
    
    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
    	return $this->year;
    }
    
    public function getRegistrationNo() {
    	return $this->registrationNo;
    }
    public function setRegistrationNo( $registrationNo) {
    	$this->registrationNo = $registrationNo;
    	return $this;
    }
    
    /**
     * Set user
     *
     * @param \heyAuto\DemoBundle\Entity\User $user
     * @return Vehicle
     */
    public function setUser(\heyAuto\DemoBundle\Entity\User $user = null)
    {
    	$this->user = $user;
    
    	return $this;
    }
    
    /**
     * Get user
     *
     * @return \heyAuto\DemoBundle\Entity\User
     */
    public function getUser()
    {
    	return $this->user;
    }    
    
////////////////////////////////////////////////////////////////////////////////////////
	
	public function toArray() {
	
		$vehicleData = null;
			$vehicleData = array(
			'mId'				=> $this->getId(),
			'mMake' 			=> $this->getMake(),
			'mModel' 			=> $this->getModel(),
			'mYear' 			=> $this->getYear(),
			'mColor' 			=> $this->getColor(),
			'mRegistrationNo'	=> $this->getRegistrationNo(),
			);
			
		return $vehicleData;
	}
	
	
	
////////////////////////////////////////////////////////////////////////////////////////
	
  
}
