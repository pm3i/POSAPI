<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\PosVoice;
use heyAuto\DemoBundle\Entity\PosVoicePos;
use Symfony\Component\Validator\Constraints\EqualTo;
use Monolog\Logger;

/**
 * PosStageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PosVoicePosRepository extends EntityRepository
{

	public function findVoicePosByVoiceId($voiceId)
	{
		return $this->getEntityManager()->getRepository('heyAutoDemoBundle:PosVoicePos')->findOneBy(array('voice_id' => $voiceId));
	}

	public function getVoicebyCompanyCode($companyCode) {
		return $this->getEntityManager()
		->createQuery(
				"SELECT p
					FROM heyAutoDemoBundle:PosVoice p
					WHERE p.company_code = '".$companyCode."' "
		)->getResult();

	}

	public function getVoicePosbyCompanyCodeInvDetailId($companyCode, $invDetailId) {
		return $this->getEntityManager()
		->createQuery(
				"SELECT p
					FROM heyAutoDemoBundle:PosVoicePos p
					WHERE p.company_code = '".$companyCode."'
					AND p.invdetail_id = '".$invDetailId."'
				"
		)->getResult();

	}

	public function updatePosVoicePos(PosVoicePos $posVoicePos) {

		$manager = $this->getEntityManager();
		$manager->merge($posVoicePos);
		$manager->flush();

		return 1;
		
	}


	public function createNewPosVoicePos(PosVoicePos $posVoicePos) 
	{
		
		if($posVoicePos == null) {
			return 0;
			
		} else {
			
			$manager = $this->getEntityManager();
			$manager->persist($posVoicePos);
			$manager->flush();
			
			return 1;
			
		}
	}

	public function getAllVoice($companyCode){
		 $sql = "SELECT DISTINCT v.voice_id, v.invdetail_id, pv.type, v.status, pv.name, v.flag, 
		 		inv_d.checked,v.type, inv_d.quantity, inv_d.item_id, inv_d.inv_code
				FROM pos_voice_pos AS v
				INNER JOIN pos_invoice_detail AS inv_d ON v.invdetail_id = inv_d.id
				INNER JOIN pos_items AS it ON inv_d.item_id = it.item_id	
				INNER JOIN pos_language_item AS l_i ON l_i.item_id = it.item_id
				INNER JOIN pos_voice AS pv ON it.item_id = pv.item_id
				WHERE v.company_code = '".$companyCode."' AND v.status = 1 AND pv.type = 'food' AND pv.item_id = it.item_id
				";
		$stmt = $this->getEntityManager()->getConnection()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}


}