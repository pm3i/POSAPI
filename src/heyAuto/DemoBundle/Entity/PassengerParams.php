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
 * PassengerParams
 *
 * @ORM\Entity
 * @ORM\Table(name="passenger_params")
 */
class PassengerParams
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
     * @ORM\OneToOne(targetEntity="User", inversedBy="passengerParams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="with_pet", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $withPet;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="with_luggage", type="boolean", nullable=true)
     * @XmlElement(cdata=false)
     */
    private $withLuggage;
	
    //////////////////////////////////////////////////////////////////////////
    
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
     * Set withPet
     *
     * @param boolean $withPet
     * @return PassengerParams
     */
    public function setWithPet($withPet)
    {
        $this->withPet = $withPet;

        return $this;
    }

    /**
     * Set withLuggage
     *
     * @param boolean $withLuggage
     * @return PassengerParams
     */
    public function setWithLuggage($withLuggage)
    {
        $this->withLuggage = $withLuggage;

        return $this;
    }

    /**
     * Set user
     *
     * @param \heyAuto\DemoBundle\Entity\User $user
     * @return PassengerParams
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
     * Is withPet
     *
     * @return boolean
     */
    public function isWithPet()
    {
    	return $this->withPet;
    }
    
    /**
     * Is withLuggage
     *
     * @return boolean
     */
    public function isWithLuggage()
    {
    	return $this->withLuggage;
    }
	//////////////////////////////////////////////////////////////////////////
	
	public function toArray() {
	
		$passengerParamsData = null;
		$passengerParamsData = array(
				'mWithPet'			=> $this->isWithPet(),
				'mWithLuggage' 		=> $this->isWithLuggage()
		);
		return $passengerParamsData;
	}

	//////////////////////////////////////////////////////////////////////////
	
}
