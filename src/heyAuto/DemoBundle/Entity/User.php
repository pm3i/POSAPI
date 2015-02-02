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
 * User
 *
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser implements \Serializable
{

	public function __construct() {
		parent::__construct();
		$this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
		$this->driverParams = new DriverParams();
		$this->passengerParams = new PassengerParams();
		$this->offersSent = new \Doctrine\Common\Collections\ArrayCollection();
		$this->offersReceived = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
 	 * @XmlElement(cdata=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_no", type="string", length=255, nullable=true, unique=true)
 	 * @XmlElement(cdata=false)
     */
    private $phoneNo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="online", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $online;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $active;
    
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     * @XmlElement(cdata=false)
     */
    private $token;
    
    /**
     * @var float
     *
     * @ORM\Column(name="current_loc_lat", type="float", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $currentLocLat;
    
    /**
     * @var float
     *
     * @ORM\Column(name="current_loc_lng", type="float", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $currentLocLng;
	
    /**
     * @var DataTime
     *
     * @ORM\Column(name="last_seen_online", type="datetime", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $lastSeenOnline;
    
    
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="gender", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     *
     * values:
     * $GENDER_MALE 	   = 1;
     * $GENDER_FEMALE 	   = 2;
     */
    private $gender;
    
    public static $GENDER_MALE	 	= 1;
    public static $GENDER_FEMALE 	= 2;
    
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="birthYear", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     *
     */
    private $birthYear;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     * @XmlElement(cdata=false)
     *
     * 'fullName' is a user's name displayed shown to other users
     *  preferably (first name) + (last name)
     *  'username' inherited from base class is used for login purposes and treated as such
     *
     */
    private $fullName;
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="role", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     * 
     */
    private $role;
    
    public static $HEYAUTO_ROLE_ANY	 	     = 0;
    public static $HEYAUTO_ROLE_PASSENGER 	     = 1;
    public static $HEYAUTO_ROLE_DRIVER  		 = 2;
//     public static $HEYAUTO_ROLE_PASS_BY_DRIVER = 3;
//     public static $HEYAUTO_ROLE_TAXI_DRIVER 	 = 4;
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="user_ratings_count", type="smallint", nullable=true)
     * @XmlElement(cdata=false)
     * 
     */
    private $userRatingsCount;
    
    /**
     * @var float
     *
     * @ORM\Column(name="user_ratings_avg", type="float", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $userRatingsAvg;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", unique=true, nullable=true)
     * @XmlElement(cdata=false)
     */
    protected $facebookId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", unique=true, nullable=true)
     * @XmlElement(cdata=false)
     */
    protected $googleId;
    
    /**
 	* @ORM\OneToMany(targetEntity="Vehicle", mappedBy="user")
 	*/
 	protected $vehicles;
 	
 	/**
 	 * @ORM\OneToOne(targetEntity="DriverParams", mappedBy="user", cascade={"persist","remove"})
 	 */
 	protected $driverParams;
 	
 	/**
 	 * @ORM\OneToOne(targetEntity="PassengerParams", mappedBy="user", cascade={"persist","remove"})
 	 */
 	protected $passengerParams;
    
 	/**
 	 * @ORM\OneToMany(targetEntity="Offer", mappedBy="offerer", cascade={"persist"})
 	 */
 	protected $offersSent;
 	
 	/**
 	 * @ORM\OneToMany(targetEntity="Offer", mappedBy="offeree", cascade={"persist"})
 	 */
 	protected $offersReceived;

///////////////////////////////////////////////////////////////////////////////	
	
	
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
     * Set phoneNo
     *
     * @param string $phoneNo
     * @return User
     */
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    /**
     * Get phoneNo
     *
     * @return string 
     */
    public function getPhoneNo()
    {
    	return $this->phoneNo;
    }
	
	/**
	 * Is online
	 *
	 * @return boolean
	 */
	public function isOnline() {
		return $this->online;
	}
	
	public function setOnline($online) {
		$this->online = $online;
		return $this;
	}

	public function getCurrentLocLat() {
		return $this->currentLocLat;
	}
	public function setCurrentLocLat($currentLocLat) {
		$this->currentLocLat = $currentLocLat;
		return $this;
	}
	public function getCurrentLocLng() {
		return $this->currentLocLng;
	}
	public function setCurrentLocLng($currentLocLng) {
		$this->currentLocLng = $currentLocLng;
		return $this;
	}
	
	/**
	 * Is active
	 *
	 * @return boolean
	 */
	public function isActive() {
		return $this->active;
	}
	public function setActive($active) {
		$this->active = $active;
		return $this;
	}
	
	
	public function getLastSeenOnline() {
		return $this->lastSeenOnline;
	}
	public function setLastSeenOnline($lastSeenOnline) {
		$this->lastSeenOnline = $lastSeenOnline;
		return $this;
	}
	public function getRole() {
		
		return $this->role;
	}
	
	/**
	 * 
	 * @param int $role from one below:
	 * @return \heyAuto\DemoBundle\Entity\User
	 */
	public function setRole($role) {
		$this->role = $role;
		return $this;
	}
		
	public static function getHeyAutoRoles() {
		
		return array (
			User::$HEYAUTO_ROLE_PASSENGER,
			User::$HEYAUTO_ROLE_DRIVER,
// 			User::$HEYAUTO_ROLE_PASS_BY_DRIVER,	
// 			User::$HEYAUTO_ROLE_TAXI_DRIVER
		);
	}
	
	public static function getGenders() {
	
		return array (
				User::$GENDER_MALE,
				User::$GENDER_FEMALE,
		);
	}
	
	
   /**
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }
    
	public function getGender() {
		return $this->gender;
	}
	public function setGender($gender) {
		$this->gender = $gender;
		return $this;
	}
	public function getBirthYear() {
		return $this->birthYear;
	}
	public function setBirthYear($birthYear) {
		$this->birthYear = $birthYear;
		return $this;
	}
	public function getUserRatingsCount() {
		return $this->userRatingsCount;
	}
	public function setUserRatingsCount($userRatingsCount) {
		$this->userRatingsCount = $userRatingsCount;
		return $this;
	}
	public function getUserRatingsAvg() {
		return $this->userRatingsAvg;
	}
	public function setUserRatingsAvg($userRatingsAvg) {
		$this->userRatingsAvg = $userRatingsAvg;
		return $this;
	}
	
	/**
	 * Get facebook_id
	 *
	 * @return string
	 */
	public function getFacebookId()
	{
		return $this->facebookId;
	}
	
	/**
	 * Set facebook_id
	 *
	 * @param string $facebookId
	 * @return User
	 */
	public function setFacebookId($facebookId)
	{
		$this->facebookId = $facebookId;
		return $this;
	}

	/**
	 * Get google_id
	 *
	 * @return string
	 */
	public function getGoogleId()
	{
		return $this->googleId;
	}
	
	/**
	 * Set google_id
	 *
	 * @param string $googleId
	 * @return User
	 */
	public function setGoogleId($googleId)
	{
		$this->googleId = $googleId;
		return $this;
	}
	
	public function getDriverParams() {
		return $this->driverParams;
	}
	public function setDriverParams(DriverParams $driverParams) {
		$this->driverParams = $driverParams;
		return $this;
	}
	public function getPassengerParams() {
		return $this->passengerParams;
	}
	public function setPassengerParams($passengerParams) {
		$this->passengerParams = $passengerParams;
		return $this;
	}
	
	/**
	* Get vehicles
	*
	* @return \Doctrine\Common\Collections\ArrayCollection()
	*/
	public function  getVehicles() {
		return $this->vehicles;
	}
	public function setVehicles($vehicles) {
		$this->vehicles = $vehicles;
		return $this;
	}
	/**
	 * Add vehicles
	 *
	 * @param \heyAuto\DemoBundle\Entity\Vehicle $vehicles
	 * @return User
	 */
	public function addVehicle(\heyAuto\DemoBundle\Entity\Vehicle $vehicles)
	{
		$this->vehicles[] = $vehicles;
	
		return $this;
	}
	
	/**
	 * Remove vehicles
	 *
	 * @param \heyAuto\DemoBundle\Entity\Vehicle $vehicles
	 */
	public function removeVehicle(\heyAuto\DemoBundle\Entity\Vehicle $vehicles)
	{
		$this->vehicles->removeElement($vehicles);
	}
	
	/**
	 * Add offersSent
	 *
	 * @param \heyAuto\DemoBundle\Entity\Offer $offersSent
	 * @return User
	 */
	public function addOffersSent(\heyAuto\DemoBundle\Entity\Offer $offersSent)
	{
		$this->offersSent[] = $offersSent;
	
		return $this;
	}
	
	/**
	 * Set offersSent
	 *
	 * @param \heyAuto\DemoBundle\Entity\Offer $offersSent
	 * @return User
	 */
	public function setOffersSent(\heyAuto\DemoBundle\Entity\Offer $offersSent)
	{
		$this->offersSent = $offersSent;
	
		return $this;
	}
	
	/**
	 * Remove offersSent
	 *
	 * @param \heyAuto\DemoBundle\Entity\Offer $offersSent
	 */
	public function removeOffersSent(\heyAuto\DemoBundle\Entity\Offer $offersSent)
	{
		$this->offersSent->removeElement($offersSent);
	}
	
	/**
	 * Get offersSent
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getOffersSent()
	{
		return $this->offersSent;
	}
	
	
	
	/**
	 * Add offersReceived
	 *
	 * @param \heyAuto\DemoBundle\Entity\Offer $offersReceived
	 * @return User
	 */
	public function addOffersReceived(\heyAuto\DemoBundle\Entity\Offer $offersReceived)
	{
		$this->offersReceived[] = $offersReceived;
	
		return $this;
	}
	
	/**
	 * Remove offersReceived
	 *
	 * @param \heyAuto\DemoBundle\Entity\Offer $offersReceived
	 */
	public function removeOffersReceived(\heyAuto\DemoBundle\Entity\Offer $offersReceived)
	{
		$this->offersReceived->removeElement($offersReceived);
	}
	
	/**
	 * Get offersReceived
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getOffersReceived()
	{
		return $this->offersReceived;
	}

	public function isEnable() {
		return $this->active;
	}
	
	///////////////////////////////////////////////////////////////////
		
	public static $USER_DATA_ARRAY_FULL 	= 0;
	public static $USER_DATA_ARRAY_LONG 	= 1;
	public static $USER_DATA_ARRAY_SHORT 	= 2;
	
	public function toArray($arrayType = 0) {
		
		$userData = null;
		$currentVehicleData = null;
		$driverParamsData = null;
		$passengerParamsData = null;
		$offersSentData = null;
		$offersReceivedData = null;
		// $vehiclesData = null;
		
		$vehicles = $this->getVehicles();
		if( !$vehicles->isEmpty() ) {
			$currentVehicleData = $vehicles->get(0)->toArray();
		}



		// if( !$this->getVehicles()->isEmpty() ) {
		// 	$vehiclesData = array();
		// 	foreach ($this->getVehicles() as $vehicle) {
		// 		array_push($vehiclesData, $vehicle->toArray());
		// 	}
		// }
		


		if( $this->getDriverParams() != null ) {
			$driverParamsData = $this->getDriverParams()->toArray();
		}
		
		if( $this->getPassengerParams() != null ) {
			$passengerParamsData = $this->getPassengerParams()->toArray();
		}
		
		if( !$this->getOffersSent()->isEmpty() ) {
			$offersSentData = array();
			foreach ($this->getOffersSent() as $offer) {
				array_push($offersSentData, $offer->toArray());
			}
		}
		
		if( !$this->getOffersReceived()->isEmpty() ) {
			$offersReceivedData = array();
			foreach ($this->getOffersReceived() as $offer) {
				array_push($offersReceivedData, $offer->toArray());
			}
		}
		
		switch($arrayType) {
			case(User::$USER_DATA_ARRAY_FULL):
				$userData = array(
				'mId' 				=> $this->getId(),
				'mName'				=> $this->getUsername(),
				'mEmail'			=> $this->getEmail(),
				'mPhoneNo' 			=> $this->getPhoneNo(),
				'mLocLat' 			=> $this->getCurrentLocLat(),
				'mLocLng' 			=> $this->getCurrentLocLng(),
				'mOnline' 			=> $this->isOnline(),
				'mActive' 			=> $this->isActive(),
				'mLastSeenOnline' 	=> $this->getLastSeenOnline(),
				'mRole'				=> $this->getRole(),
				'mGender'			=> $this->getGender(),
				'mBirthYear'		=> $this->getbirthYear(),
				'mFullName'			=> $this->getFullName(),
				'mRatingsCount'		=> $this->getUserRatingsCount(),
				'mAvgRating'		=> $this->getUserRatingsAvg(),
				'mFacebookId'		=> $this->getFacebookId(),
				'mGoogleId'			=> $this->getGoogleId(),
				'mVehicle'			=> /*$vehiclesData*/$currentVehicleData,
				'mDriverParams'		=> $driverParamsData,
				'mPassengerParams'	=> $passengerParamsData,
				'mOffersSent'		=> $offersSentData,
				'mOffersReceived'	=> $offersReceivedData,
// 				'mPassword' 		=> $this->getPassword(),
				'mToken'			=> $this->getToken(),
				);
				break;
				
			case(User::$USER_DATA_ARRAY_LONG):
				$userData = array(
				'mId' 				=> $this->getId(),
				'mName'				=> $this->getUsername(),
				'mEmail'			=> $this->getEmail(),
				'mPhoneNo' 			=> $this->getPhoneNo(),
				'mLocLat' 			=> $this->getCurrentLocLat(),
				'mLocLng' 			=> $this->getCurrentLocLng(),
				'mOnline' 			=> $this->isOnline(),
				'mActive' 			=> $this->isActive(),
// 				'mLastSeenOnline' 	=> $this->getLastSeenOnline(),
				'mRole'				=> $this->getRole(),
				'mGender'			=> $this->getGender(),
				'mBirthYear'		=> $this->getbirthYear(),
				'mFullName'			=> $this->getFullName(),
// 				'mRatingsCount'		=> $this->getUserRatingsCount(),
// 				'mAvgRating'		=> $this->getUserRatingsAvg(),
// 				'mFacebookId'		=> $this->getFacebookId(),
// 				'mGoogleId'			=> $this->getGoogleId(),
// 				'mVehicle'			=> /*$vehiclesData*/$currentVehicleData,
// 				'mDriverParams'		=> $driverParamsData,
// 				'mPassengerParams'	=> $passengerParamsData,
// 				'mOffersSent'		=> $offersSentData,
// 				'mOffersReceived'	=> $offersReceivedData,
// 				'mPassword' 		=> $this->getPassword(),
// 				'mToken'			=> $this->getToken(),
				);
				break;

			case(User::$USER_DATA_ARRAY_SHORT):
				$userData = array(
				'mId' 				=> $this->getId(),
				'mName'				=> $this->getUsername(),
// 				'mEmail'			=> $this->getEmail(),
				'mPhoneNo' 			=> $this->getPhoneNo(),
				'mLocLat' 			=> $this->getCurrentLocLat(),
				'mLocLng' 			=> $this->getCurrentLocLng(),
				'mOnline' 			=> $this->isOnline(),
				'mActive' 			=> $this->isActive(),
// 				'mLastSeenOnline' 	=> $this->getLastSeenOnline(),
				'mRole'				=> $this->getRole(),
				'mGender'			=> $this->getGender(),
				'mBirthYear'		=> $this->getbirthYear(),
				'mFullName'			=> $this->getFullName(),
// 				'mRatingsCount'		=> $this->getUserRatingsCount(),
// 				'mAvgRating'		=> $this->getUserRatingsAvg(),
// 				'mFacebookId'		=> $this->getFacebookId(),
// 				'mGoogleId'			=> $this->getGoogleId(),
// 				'mVehicle'			=> /*$vehiclesData*/$currentVehicleData,
// 				'mDriverParams'		=> $driverParamsData,
// 				'mPassengerParams'	=> $passengerParamsData,
// 				'mOffersSent'		=> $offersSentData,
// 				'mOffersReceived'	=> $offersReceivedData,
// 				'mPassword' 		=> $this->getPassword(),
// 				'mToken'			=> $this->getToken(),
				);
				break;

				default:
				break;	 
		}
		return $userData;
	}




	//////////////////////////////////////////////////////////
	
	/**
	* @see \Serializable::serialize()
	*/
	public function serialize() {
		return serialize(array(
				$this->getId(),
				$this->getUserName(),
				$this->getEmail(),
				$this->getPhoneNo(),
				$this->isOnline(),
				$this->isActive(),
				$this->isEnable(),
				$this->getGenders(),
				$this->getBirthYear(),
				$this->getFullName(),
				$this->getRole(),
				$this->getLastSeenOnline(),
				$this->getUserRatingsCount(),
				$this->getUserRatingsAvg(),
				$this->getToken(),
				// $this->getVehicles(),
				// $currentVehicleData,
				// $driverParamsData,
				// $passengerParamsData,
				// $offersSentData,
				// $offersReceivedData,
		));
	}

	/**
	* @see \Serializable::unserialize()
	*/
	public function unserialize($serialized) {
		list (
			$this->id,
			$this->username,
			$this->email,
			$this->phoneNo,
			$this->online,
			$this->active,
			$this->enable,
			$this->gender,
			$this->birthYear,
			$this->fullName,
			$this->role,
			$this->lastSeenOnline,
			$this->userRatingsCount,
			$this->userRatingsAvg,
			$this->token,
			// $this->vehicles,
		) = unserialize($serialized);
	}
}
