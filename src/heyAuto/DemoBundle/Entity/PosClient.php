<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosClient
 *
 * @ORM\Table(name="pos_client")
 * @ORM\Entity(repositoryClass="heyAuto\DemoBundle\Entity\PosClientRepository")
 */
class PosClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $client_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=25)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=250)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="company_code", type="string", length=255)
     */
    private $company_code;


    /**
     * Set client_id
     *
     * @param integer $clientId
     * @return PosClient
     */
    public function setClientId($clientId)
    {
        $this->client_id = $clientId;

        return $this;
    }

    /**
     * Get client_id
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PosClient
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
     * Set phone
     *
     * @param string $phone
     * @return PosClient
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
     * Set address
     *
     * @param string $address
     * @return PosClient
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
     * Set company_code
     *
     * @param string $companyCode
     * @return PosClient
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
        $posclientData = null;
            $posclientData = array(
            'client_id'                 => $this->getClientId(),
            'name'               => $this->getName(),
            'phone'               => $this->getPhone(),
            'address'               => $this->getAddress(),
            'company_code'       => $this->getCompanyCode(),
            );
            
        return $posclientData;
    }
    
    
////////////////////////////////////////////////////////////////////////////////////////
}
