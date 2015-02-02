<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\PosInvoiceItable;
use heyAuto\DemoBundle\Entity\PosStageITable;
use heyAuto\DemoBundle\Entity\PosStage;
use Symfony\Component\Validator\Constraints\EqualTo;
use Monolog\Logger;



/**
 * PosUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PosInvoiceItableRepository extends EntityRepository
{
	
	public function getInvoiceItableByCompanyCodeAndCodeTable($code_table_tranf, $company_code) {
		return $this->getEntityManager()
			->createQuery(
					" SELECT pit FROM heyAutoDemoBundle:PosInvoiceItable pit
						WHERE pit.company_code = '".$company_code."' 
							  AND pit.code_table = '".$code_table_tranf."'
					"
			)->getResult();
		
	}

	public function updateItable(PosInvoiceItable $posInvoiceItable) {

		$manager = $this->getEntityManager();
		$manager->merge($posInvoiceItable);
		$manager->flush();

		return array (
						'mSuccess' => true,
						'mErrorField' => null,
						'mMessage' => "User updated successfully"
				);
		
	}

}