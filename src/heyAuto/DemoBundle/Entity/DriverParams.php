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
 * DriverParams
 *
 * @ORM\Entity
 * @ORM\Table(name="driver_params")
 */
class DriverParams
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
     * @ORM\OneToOne(targetEntity="User", inversedBy="driverParams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @var float
     *
     * @ORM\Column(name="cost_per_km", type="float", nullable=true)
 	 * @XmlElement(cdata=false)
     */
    private $costPerKm;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="available_seats_count", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $availableSeatsCount;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_distance_to_passenger", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $maxDistanceToPassengerAllowedInOnCallMode;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="max_extra_distance_to_passenger", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $maxExtraDistanceAllowedInPassThroughMode;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="luggage_allowed", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $luggageAllowed;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="pet_allowed", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $petAllowed;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="smoking_allowed", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $smokingAllowed;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="current_vehicle_no", type="smallint")
     * @XmlElement(cdata=false)
     */
    private $currentVehicleNo = 0;
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="drivingMode", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     *
     */
    private $drivingMode;
    
    public static $DRIVING_MODE_ON_CALL	     = 0;
    public static $DRIVING_MODE_PASS_THROUGH	 = 1;
    
    /////////////////////////////////////////////////////////////////////////////
    
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
     * Set costPerKM
     *
     * @param float $costPerKM
     * @return DriverParams
     */
    public function setCostPerKM($costPerKM)
    {
    	$this->costPerKm = $costPerKM;
    
    	return $this;
    }
    
    /**
     * Get costPerKM
     *
     * @return float
     */
    public function getCostPerKm()
    {
    	return $this->costPerKm;
    }
    
    /**
     * Set availableSeatsCount
     *
     * @param integer $availableSeatsCount
     * @return DriverParams
     */
    public function setAvailableSeatsCount($availableSeatsCount)
    {
    	$this->availableSeatsCount = $availableSeatsCount;
    
    	return $this;
    }
    
    /**
     * Get availableSeatsCount
     *
     * @return integer
     */
    public function getAvailableSeatsCount()
    {
    	return $this->availableSeatsCount;
    }
    
    /**
     * Set maxDistanceToPassengerAllowedInOnCallMode
     *
     * @param integer $maxDistanceToPassengerAllowedInOnCallMode
     * @return DriverParams
     */
    public function setMaxDistanceToPassengerAllowedInOnCallMode($maxDistanceToPassengerAllowedInOnCallMode)
    {
    	$this->maxDistanceToPassengerAllowedInOnCallMode = $maxDistanceToPassengerAllowedInOnCallMode;
    
    	return $this;
    }
    
    /**
     * Get maxDistanceToPassengerAllowedInOnCallMode
     *
     * @return integer
     */
    public function getMaxDistanceToPassengerAllowedInOnCallMode()
    {
    	return $this->maxDistanceToPassengerAllowedInOnCallMode;
    }
    
    /**
     * Set maxExtraDistanceAllowedInPassThroughMode
     *
     * @param integer $maxExtraDistanceAllowedInPassThroughMode
     * @return DriverParams
     */
    public function setMaxExtraDistanceAllowedInPassThroughMode($maxExtraDistanceAllowedInPassThroughMode)
    {
    	$this->maxExtraDistanceAllowedInPassThroughMode = $maxExtraDistanceAllowedInPassThroughMode;
    
    	return $this;
    }
    
    /**
     * Get maxExtraDistanceAllowedInPassThroughMode
     *
     * @return integer
     */
    public function getMaxExtraDistanceAllowedInPassThroughMode()
    {
    	return $this->maxExtraDistanceAllowedInPassThroughMode;
    }
    
    /**
     * Set luggageAllowed
     *
     * @param boolean $luggageAllowed
     * @return DriverParams
     */
    public function setLuggageAllowed($luggageAllowed)
    {
    	$this->luggageAllowed = $luggageAllowed;
    
    	return $this;
    }
    
    /**
     * Set petAllowed
     *
     * @param boolean $petAllowed
     * @return DriverParams
     */
    public function setPetAllowed($petAllowed)
    {
    	$this->petAllowed = $petAllowed;
    
    	return $this;
    }
    
    /**
     * Set smokingAllowed
     *
     * @param boolean $smokingAllowed
     * @return DriverParams
     */
    public function setSmokingAllowed($smokingAllowed)
    {
    	$this->smokingAllowed = $smokingAllowed;
    
    	return $this;
    }
    
    /**
     * Set currentVehicleNo
     *
     * @param integer $currentVehicleNo
     * @return DriverParams
     */
    public function setCurrentVehicleNo($currentVehicleNo)
    {
    	$this->currentVehicleNo = $currentVehicleNo;
    
    	return $this;
    }
    
    /**
     * Get currentVehicleNo
     *
     * @return integer
     */
    public function getCurrentVehicleNo()
    {
    	return $this->currentVehicleNo;
    }
    
    /**
     * Set drivingMode
     *
     * @param integer $drivingMode
     * @return DriverParams
     */
    public function setDrivingMode($drivingMode)
    {
    	$this->drivingMode = $drivingMode;
    
    	return $this;
    }
    
    /**
     * Get drivingMode
     *
     * @return integer
     */
    public function getDrivingMode()
    {
    	return $this->drivingMode;
    }
    
    /**
     * Set user
     *
     * @param \heyAuto\DemoBundle\Entity\User $user
     * @return DriverParams
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
    
	/**
     * Is luggageAllowed
     *
     * @return boolean 
     */
    public function isLuggageAllowed()
    {
        return $this->luggageAllowed;
    }

    /**
     * Is petAllowed
     *
     * @return boolean 
     */
    public function isPetAllowed()
    {
        return $this->petAllowed;
    }

    /**
     * Is smokingAllowed
     *
     * @return boolean 
     */
    public function isSmokingAllowed()
    {
        return $this->smokingAllowed;
    }
    

    
/////////////////////////////////////////////////////////////////////////////
    
    
	public function toArray() {

		$driverParamsData = null;
		$driverParamsData = array(
				'mDrivingMode'								=> $this->getDrivingMode(),
				'mCurrentVehicleNo'							=> $this->getCurrentVehicleNo(),
				'mAvailableSeatsCount' 						=> $this->getAvailableSeatsCount(),
				'mCostPerKm' 								=> $this->getCostPerKm(),
				'mMaxDistanceToPassengerAllowedInOnCallMode'=> $this->getMaxDistanceToPassengerAllowedInOnCallMode(),
				'mMaxExtraDistanceAllowedInPassThroughMode'	=> $this->getMaxExtraDistanceAllowedInPassThroughMode(),
				'mPetAllowed'								=> $this->isPetAllowed(),
				'mLuggageAllowed'							=> $this->isLuggageAllowed(),
				'mSmokingAllowed'							=> $this->isSmokingAllowed()
		);	
		return $driverParamsData;
	}	
        
/////////////////////////////////////////////////////////////////////////////
	

}
