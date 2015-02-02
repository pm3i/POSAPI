<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\PosCompany;
use heyAuto\DemoBundle\Entity\PosGroupMobile;
use heyAuto\DemoBundle\Entity\PosUserGroupMap;
use Symfony\Component\Validator\Constraints\EqualTo;
use Monolog\Logger;



/**
 * PosUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PosCompanyRepository extends EntityRepository
{


	public function findCompanyByCompanyName($companyname)
	{
		return $this->getEntityManager()->getRepository('heyAutoDemoBundle:PosCompany')->findOneBy(array('companyname' => $companyname));
	}

	public function findCompanyByCompanyCode($companycode)
	{
		return $this->getEntityManager()->getRepository('heyAutoDemoBundle:PosCompany')->findOneBy(array('company_code' => $companycode));
	}

	public function createNewPosCompany(PosCompany $posCompany) 
	{
		
		if($posCompany == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => null,
					'mMessage' => "Unknown error" 
			);
			
		} elseif($posCompany->getCompanyCode() == null) {
			
			return array (
					'mSuccess' => false,
					'mErrorField' => "companycode",
					'mMessage' => "No company code specified"
			);

		} elseif($posCompany->getCompanyname() == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => "company name",
					'mMessage' => "No company name specified"
			);
			
		}else {
		
			if( $posCompany->getCompanyname() != null && $this->findCompanyByCompanyName($posCompany->getCompanyname()) != null ) {
				return array (
						'mSuccess' => false,
						'mErrorField' => "name",
						'mMessage' => "Company with name [".$posCompany->getCompanyname()."] already exists in database"
				);

			}

			if( $posCompany->getCompanyCode() != null && $this->findCompanyByCompanyCode($posCompany->getCompanyCode()) != null ) {
				return array (
						'mSuccess' => false,
						'mErrorField' => "name",
						'mMessage' => "Company with code [".$posCompany->getCompanyCode()."] already exists in database"
				);

			}	
			
			$manager = $this->getEntityManager();
			$manager->persist($posCompany);
			$manager->flush();
			
			return array (
						'mSuccess' => true,
						'mErrorField' => null,
						'mMessage' => "Registration succeded"
			);
			
		}
	}
	
}
