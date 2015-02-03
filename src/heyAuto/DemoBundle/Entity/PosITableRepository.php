<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\PosITable;
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
class PosItableRepository extends EntityRepository
{
	
	public function getItableByCompanyCode($companyCode) {
		return $this->getEntityManager()
		->createQuery(
				" SELECT tb
					FROM heyAutoDemoBundle:PosITable tb
					INNER JOIN heyAutoDemoBundle:PosStageITable st WITH st.id_itable = tb.itable_id
					INNER JOIN heyAutoDemoBundle:PosStage p_s WITH p_s.code = st.id_stage
					WHERE p_s.company_code = '".$companyCode."' 
						  AND tb.company_code= '".$companyCode."' 
						  AND p_s.status=1 
			   			  AND st.status=1
				"
		)->getResult();
	}

	public function getItableByFloor($companyCode, $floor) {
		return $this->getEntityManager()
		->createQuery(
				" SELECT tb
					FROM heyAutoDemoBundle:PosITable tb
					INNER JOIN heyAutoDemoBundle:PosStageITable st WITH st.id_itable = tb.itable_id
					INNER JOIN heyAutoDemoBundle:PosStage p_s WITH p_s.code = st.id_stage
					WHERE p_s.company_code = '".$companyCode."' 
						  AND tb.company_code= '".$companyCode."' 
						  AND p_s.code= '".$floor."' 
						  AND p_s.status=1 
			   			  AND st.status=1
				"
		)->getResult();
	}


	public function checkExistTable($companyCode, $isCodeTable) {
		return $this->getEntityManager()
		->createQuery(
				" SELECT i
					FROM heyAutoDemoBundle:PosITable i
					WHERE i.company_code = '".$companyCode."' 
						  AND i.code_table = '".$isCodeTable."'
						  AND ( i.status = 0 or i.status = 1)
				"
		)->getResult();
	}

	public function checkItableInStage($companyCode, $floor) {
		return $this->getEntityManager()
		->createQuery(
				" SELECT TOP 1 tb
					FROM heyAutoDemoBundle:PosITable tb
					INNER JOIN heyAutoDemoBundle:PosStageITable st WITH st.id_itable = tb.itable_id
					WHERE tb.company_code= '".$companyCode."' 
						  AND st.id_stage='".$floor."'
						  AND st.status=1 
						  ORDER BY tb.itable_id DESC
				"
		)->getResult();
	}

	public function checkItableExistForDelete($companyCode, $itableId) {
		return $this->getEntityManager()
		->createQuery(
				" SELECT tb
					FROM heyAutoDemoBundle:PosITable tb
					WHERE tb.company_code= '".$companyCode."' 
						AND tb.itable_id = '".$itableId."' 
				"
		)->getResult();
	}

	public function deleteItableByCompanyCodeItableId($companyCode, $itableId) {
		return $this->getEntityManager()
		->createQuery(
				" DELETE FROM heyAutoDemoBundle:PosITable tb
					WHERE tb.company_code= '".$companyCode."' 
						AND tb.itable_id = '".$itableId."' 
				"
		)->getResult();
	}

	public function updateItableByCompanyCodeItableId(PosITable $posItable, $companyCode, $itableId) {
		return $this->getEntityManager()
		->createQuery(
				" UPDATE heyAutoDemoBundle:PosITable SET 
					code_table 	= '".$posItable->getCodeTable()."',
					pos_x		= '".$posItable->getPosX()."',
					pos_y 		= '".$posItable->getPosY()."',
					update_time	= '".$posItable->getUpdateTime()."',
					userid 		= '".$posItable->getUserid()."',
					WHERE company_code= '".$companyCode."' 
						AND itable_id = '".$itableId."' 
				"
		)->getResult();
	}

	public function createNewPosITable(PosITable $posItable) 
	{
		
		if($posItable == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => null,
					'mMessage' => "Unknown error" 
			);
			
		} else {
			
			$manager = $this->getEntityManager();
			$manager->persist($posItable);
			$manager->flush();
			$posItable ->setItableId ($posItable->getItableId());
			
			return array (
						'mSuccess' => true,
						'mErrorField' => null,
						'mMessage' => "Registration succeded"
			);
			
		}
	}

	public function findTableByCompanyCode ($companyCode)
	{
		return $this->findBy (array('company_code' => $companyCode));
	}

}
