<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosCompany
 *
 * @ORM\Table(name="pos_companyprofile")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosCompanyRepository")
 */
class PosCompany
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
     * @ORM\Column(name="companyname", type="string", length=500)
     */
    private $companyname;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=250)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=500)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=150)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=50)
     */
    private $company_code;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=50)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="blobdata", type="string", length=500)
     */
    private $blobdata;

    /**
     * @var string
     *
     * @ORM\Column(name="GPS_area", type="string", length=255)
     */
    private $GPS_area;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", length=53)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lon", type="float", length=53)
     */
    private $lon;

    /**
     * @var float
     *
     * @ORM\Column(name="radius", type="float", length=53)
     */
    private $radius;


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
     * Set companyname
     *
     * @param string $companyname
     * @return PosCompany
     */
    public function setCompanyname($companyname)
    {
        $this->companyname = $companyname;

        return $this;
    }

    /**
     * Get companyname
     *
     * @return string 
     */
    public function getCompanyname()
    {
        return $this->companyname;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return PosCompany
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return PosCompany
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return PosCompany
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PosCompany
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
     * Set fax
     *
     * @param string $fax
     * @return PosCompany
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return PosCompany
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set company_code
     *
     * @param string $companyCode
     * @return PosCompany
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
     * Set location
     *
     * @param string $location
     * @return PosCompany
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return PosCompany
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
     * Set flag
     *
     * @param integer $flag
     * @return PosCompany
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
     * Set blobdata
     *
     * @param integer $blobdata
     * @return PosCompany
     */
    public function setBlobdata($blobdata)
    {
        $this->blobdata = $blobdata;

        return $this;
    }

    /**
     * Get blobdata
     *
     * @return integer 
     */
    public function getBlobdata()
    {
        return $this->blobdata;
    }

    /**
     * Set GPS_area
     *
     * @param string $gPSArea
     * @return PosCompany
     */
    public function setGPSArea($gPSArea)
    {
        $this->GPS_area = $gPSArea;

        return $this;
    }

    /**
     * Get GPS_area
     *
     * @return string 
     */
    public function getGPSArea()
    {
        return $this->GPS_area;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return PosCompany
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param float $lon
     * @return PosCompany
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return float 
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set radius
     *
     * @param float $radius
     * @return PosCompany
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * Get radius
     *
     * @return float 
     */
    public function getRadius()
    {
        return $this->radius;
    }


    public function toArray() {
        // $posUserGroupMap = $this->getPosUserGroupMap();
        // if( !$posUserGroupMap->isEmpty() ) {
        //     $currentPosUserGroupMap = $posUserGroupMap->get(0)->toArray();
        // }

        // truy van lay du lieu tu bang PosGroupMobile

        // loc ra  va cho vao mot bie
    
        $poscompanysData = null;
            $poscompanysData = array(
            'mId'               => $this->getId(),
            'mCompanyname'      => $this->getCompanyname(),
            'mlogo'             => $this->getLogo(),
            'mAddress'          => $this->getAddress(),
            //'mPassword'         => $this->getPassword(),
            'mPhone'            => $this->getPhone(),
            'mEmail'            => $this->getEmail(),
            'mFax'               => $this->getFax(),
            'mWebsite'            => $this->getWebsite(),
            'mCompany_code'     => $this->getCompanyCode(),
            'mLocation'          => $this->getLocation(),
            'mType'              => $this->getType(),
            'mFlag'           => $this->getFlag(),
            'mBlobdata'          => $this->getBlobdata(),
            'mGPS_area'       => $this->getGPSArea(),
            'mLat'            => $this->getLat(),
            'mLon'            => $this->getLon(),
            'mRadius'            => $this->getRadius(),
            'mResult'           => "success"
            );
            
        return $poscompanysData;
    }

}

