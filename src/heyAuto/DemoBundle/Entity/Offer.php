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
 * Offer
 *
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\OfferRepository")
 * @ORM\Table(name="offer")
 */
class Offer
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

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="offersSent", cascade={"persist"})
	 * @ORM\JoinColumn(name="offerer_id", referencedColumnName="id")
	 * @XmlElement(cdata=false)
	 */
	protected $offerer;

	 
	/**
	 * @var string
	 *
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="offersReceived")
	 * @ORM\JoinColumn(name="offeree_id", referencedColumnName="id")
	 * @XmlElement(cdata=false)
	 */
	protected $offeree;
	
	/**
	 * @var DataTime
	 *
	 * @ORM\Column(name="expiration_date", type="datetime", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $expirationDate;
	
	/**
	 * @var DataTime
	 *
	 * @ORM\Column(name="created_at_date", type="datetime", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $createdAtDate;
	
	/**
	 * @var DataTime
	 *
	 * @ORM\Column(name="closed_at_date", type="datetime", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $closedAtDate;
	
	
	/**
	* @var integer
	*
	* @ORM\Column(name="expiration_counter", type="integer", nullable=true)
	* @XmlElement(cdata=false)
	*/
	protected $expirationCounter;
	
	/**
	 * @var float
	 *
	 * @ORM\Column(name="pickup_loc_lat", type="float", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $pickupLocLat;
	
	/**
	 * @var float
	 *
	 * @ORM\Column(name="pickup_loc_lng", type="float", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $pickupLocLng;
	
	/**
	 * @var float
	 *
	 * @ORM\Column(name="dest_loc_lat", type="float", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $destLocLat;
	
	/**
	 * @var float
	 *
	 * @ORM\Column(name="dest_loc_lng", type="float", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $destLocLng;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="closed_with_status", type="integer", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $closedWithStatus;
	
	/**
	 * @var float
	 *
	 * @ORM\Column(name="dist_covered", type="float", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $distCovered;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="passengerRating", type="integer", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $passengerRating;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="driverRating", type="integer", nullable=true)
	 * @XmlElement(cdata=false)
	 */
	protected $driverRating;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="status", type="integer")
	 * @XmlElement(cdata=false)
	 */
	protected $status;
	
	public static $STATUS_NONE_OR_ANY	    								= 0;
	public static $STATUS_LIFT_REQUEST_WAITING_FOR_DRIVER_ACCEPTANCE		= 1;
	public static $STATUS_LIFT_REQUEST_REJECTED_BY_DRIVER    				= 2;
	public static $STATUS_LIFT_REQUEST_ACCEPTED_BY_DRIVER    				= 3;
	public static $STATUS_LIFT_REQUEST_CANCELLED_BY_PASSENGER			    = 4;
	public static $STATUS_LIFT_REQUEST_EXPIRED			    				= 5;
	public static $STATUS_LIFT_REQUEST_CONFIRMED_BY_PASSENGER			    = 6;
	public static $STATUS_LIFT_REQUEST_CONFIRMATION_CANCELLED_BY_DRIVER	   	= 7;
	public static $STATUS_LIFT_REQUEST_CONFIRMATION_CANCELLED_BY_PASSENGER 	= 8;
	public static $STATUS_WAITING_FOR_PICKUP			 				   	= 9;
	public static $STATUS_PICKUP_CANCELLED_BY_PASSENGER			 		   	= 10;
	public static $STATUS_PICKUP_CANCELLED_BY_DRIVER			 			= 11;
	public static $STATUS_DRIVER_ARRIVED_AT_PICKUP_LOCATION			 		= 12;
	public static $STATUS_LIFT_IN_PROGRESS			 						= 13;
	public static $STATUS_LIFT_FINISHED				 						= 14;
	
	public static $STATUS_CLOSED			    							= 100;

	
	/////////////////////////////////////////////////////
	
	public static function getAvailableStatuses() {
		return array (
				Offer::$STATUS_LIFT_REQUEST_WAITING_FOR_DRIVER_ACCEPTANCE,
				Offer::$STATUS_LIFT_REQUEST_REJECTED_BY_DRIVER,
				Offer::$STATUS_LIFT_REQUEST_ACCEPTED_BY_DRIVER,
				Offer::$STATUS_LIFT_REQUEST_CANCELLED_BY_PASSENGER,
				Offer::$STATUS_LIFT_REQUEST_EXPIRED,
				Offer::$STATUS_LIFT_REQUEST_CONFIRMED_BY_PASSENGER,
				Offer::$STATUS_WAITING_FOR_PICKUP,
				Offer::$STATUS_LIFT_REQUEST_CONFIRMATION_CANCELLED_BY_DRIVER,
				Offer::$STATUS_LIFT_REQUEST_CONFIRMATION_CANCELLED_BY_PASSENGER,
				Offer::$STATUS_PICKUP_CANCELLED_BY_PASSENGER,
				Offer::$STATUS_PICKUP_CANCELLED_BY_DRIVER,
				Offer::$STATUS_DRIVER_ARRIVED_AT_PICKUP_LOCATION,
				Offer::$STATUS_LIFT_IN_PROGRESS,
				Offer::$STATUS_LIFT_FINISHED,
				Offer::$STATUS_CLOSED,	
		);
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
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
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     * @return Offer
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime 
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set offerer
     *
     * @param \heyAuto\DemoBundle\Entity\User $offerer
     * @return Offer
     */
    public function setOfferer(\heyAuto\DemoBundle\Entity\User $offerer = null)
    {
        $this->offerer = $offerer;

        return $this;
    }

    /**
     * Get offerer
     *
     * @return \heyAuto\DemoBundle\Entity\User 
     */
    public function getOfferer()
    {
        return $this->offerer;
    }
    
    /**
     * Set offeree
     *
     * @param \heyAuto\DemoBundle\Entity\User $offeree
     * @return Offer
     */
    public function setOfferee(\heyAuto\DemoBundle\Entity\User $offeree = null)
    {
    	$this->offeree = $offeree;
    
    	return $this;
    }
    
    /**
     * Get offeree
     *
     * @return \heyAuto\DemoBundle\Entity\User
     */
    public function getOfferee()
    {
    	return $this->offeree;
    }
    
    /**
     * Set pickupLocLat
     *
     * @param float $pickupLocLat
     * @return Offer
     */
    public function setPickupLocLat($pickupLocLat)
    {
    	$this->pickupLocLat = $pickupLocLat;
    
    	return $this;
    }
    
    /**
     * Get pickupLocLat
     *
     * @return float
     */
    public function getPickupLocLat()
    {
    	return $this->pickupLocLat;
    }
    
    /**
     * Set pickupLocLng
     *
     * @param float $pickupLocLng
     * @return Offer
     */
    public function setPickupLocLng($pickupLocLng)
    {
    	$this->pickupLocLng = $pickupLocLng;
    
    	return $this;
    }
    
    /**
     * Get pickupLocLng
     *
     * @return float
     */
    public function getPickupLocLng()
    {
    	return $this->pickupLocLng;
    }
    
    /**
     * Set destLocLat
     *
     * @param float $destLocLat
     * @return Offer
     */
    public function setDestLocLat($destLocLat)
    {
    	$this->destLocLat = $destLocLat;
    
    	return $this;
    }
    
    /**
     * Get destLocLat
     *
     * @return float
     */
    public function getDestLocLat()
    {
    	return $this->destLocLat;
    }
    
    /**
     * Set destLocLng
     *
     * @param float $destLocLng
     * @return Offer
     */
    public function setDestLocLng($destLocLng)
    {
    	$this->destLocLng = $destLocLng;
    
    	return $this;
    }
    
    /**
     * Get destLocLng
     *
     * @return float
     */
    public function getDestLocLng()
    {
    	return $this->destLocLng;
    }
	
    /**
     * Set destDistCovered
     *
     * @param float $distance
     * @return Offer
     */
    public function setDistCovered($distance)
    {
    	$this->distCovered = $distance;
    
    	return $this;
    }
    
    /**
     * Get distCovered
     *
     * @return float
     */
    public function getDistCovered()
    {
    	return $this->distCovered;
    }
    
    
	/**
     * Get closedWithStatus
     *
     * @return integer
     */
     public function getClosedWithStatus() {
		
		return $this->closedWithStatus;
	
	}
	
	/**
     * Set closedWithStatus
     *
     * @param integer $closedWithStatus
     * @return Offer
     */
    public function setClosedWithStatus($closedWithStatus) {

		$this->closedWithStatus = $closedWithStatus;
		
		return $this;
	}
	    
    /**
     * Set status
     *
     * @param integer $status
     * @return Offer
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
     * Set expirationCounter
     *
     * @param integer $expirationCounter
     * @return Offer
     */
    public function setExpirationCounter($expirationCounter)
    {
    	$this->expirationCounter = $expirationCounter;
    
    	return $this;
    }
    
    /**
     * Get expirationCounter
     *
     * @return integer
     */
    public function getExpirationCounter()
    {
    	return $this->expirationCounter;
    }
    
    /**
     * Set createdAtDate
     *
     * @param \DateTime $createdAtDate
     * @return Offer
     */
    public function setCreatedAtDate($createdAtDate)
    {
    	$this->createdAtDate = $createdAtDate;
    
    	return $this;
    }
    
    /**
     * Get createdAtDate
     *
     * @return \DateTime
     */
    public function getCreatedAtDate()
    {
    	return $this->createdAtDate;
    }
    
    /**
     * Set closedAtDate
     *
     * @param \DateTime $closedAtDate
     * @return Offer
     */
    public function setClosedAtDate($closedAtDate)
    {
    	$this->closedAtDate = $closedAtDate;
    
    	return $this;
    }
    
    /**
     * Get closedAtDate
     *
     * @return \DateTime
     */
    public function getClosedAtDate()
    {
    	return $this->closedAtDate;
    }
    
    
    /**
     * Set passengerRating
     *
     * @param integer $rating
     * @return Offer
     */
    public function setPassengerRating($rating)
    {
    	$this->passengerRating = $rating;
    
    	return $this;
    }
    
    /**
     * Get passengerRating
     *
     * @return integer
     */
    public function getPassengerRating()
    {
    	return $this->passengerRating;
    }
    
    
    /**
     * Set driverRating
     *
     * @param integer $rating
     * @return Offer
     */
    public function setDriverRating($rating)
    {
    	$this->driverRating = $rating;
    
    	return $this;
    }
    
    /**
     * Get driverRating
     *
     * @return integer
     */
    public function getDriverRating()
    {
    	return $this->driverRating;
    }
    
    /////////////////////////////////////////////
    
    
    public function toArray() {
    
    	//offerer
    	if( $this->getOfferer() != null ) {
    		$offererId = $this->getOfferer()->getId();
    	} else {
    		$offererId = null;
    	}

    	//offeree
    	if( $this->getOfferee() != null ) {
    		$offereeId = $this->getOfferee()->getId();
    	} else {
    		$offereeId = null;
    	}
    	
    	//expirationDate
    	if( $this->getExpirationDate() != null ) {
    		$expirationDate = $this->getExpirationDate()->format("Y-m-d H:i:s");
    	} else {
    		$expirationDate = null;
    	}
    	
    	//createdAtDate
    	if( $this->getCreatedAtDate() != null ) {
    		$createdAtDate = $this->getCreatedAtDate()->format("Y-m-d H:i:s");
    	} else {
    		$createdAtDate = null;
    	}
    	
    	//closedAtDate
    	if( $this->getClosedAtDate() != null ) {
    		$closedAtDate = $this->getClosedAtDate()->format("Y-m-d H:i:s");
    	} else {
    		$closedAtDate = null;
    	}
    	
    	$data = null;
    	$data = array(
    			'mId'				=> $this->getId(),
    			'mOffererId' 		=> $offererId,
    			'mOffereeId' 		=> $offereeId,
    			'mPickupLocLat'		=> $this->getPickupLocLat(),
    			'mPickupLocLng'		=> $this->getPickupLocLng(),
    			'mDestLocLat'		=> $this->getDestLocLat(),
    			'mDestLocLng'		=> $this->getDestLocLng(),
    			'mStatus'			=> $this->getStatus(),
    			'mExpirationDate' 	=> $expirationDate,
    			'mExpirationCounter'=> $this->getExpirationCounter(),
    			'mCreatedAtDate'	=> $createdAtDate,
    			'mClosedAtDate'		=> $closedAtDate,
    			'mDistCovered'		=> $this->getDistCovered(),
    			'mPassengerRating'	=> $this->getPassengerRating(),
    			'mDriverRating'		=> $this->getDriverRating(),
    	);
    		
    	return $data;
    }


    public function toString() {
    	return print_r($this->toArray(),1);
    }
      
}
