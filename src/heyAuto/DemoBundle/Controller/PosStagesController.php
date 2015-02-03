<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosITable;
use heyAuto\DemoBundle\Entity\PosStage;
use heyAuto\DemoBundle\Entity\PosStageITable;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Security\UserProvider;
use heyAuto\DemoBundle\Crypto\MCrypt;
use Monolog\Logger;
use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use JMS\Serializer\Annotation\Type;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * 
 * @author ceto
 */
class PosStagesController extends Controller {

	/**
	 * UPDATE POSSTAGE (via POST, PATCH or PUT)
	 * @ParamConverter("posstage", class="heyAutoDemoBundle:PosStage")
	 * @Post("/rest/updateposstages/{id}")
	 * @Patch("/rest/updateposstages/{id}")
	 * @Put("/rest/updateposstages/{id}")
	 * oryginally: posStageAction
	 **/

	public function updatePosStageAction(Request $request) {
		$posStage = new PosStage();
		$companyCode = $request->get('mCompany_code');
		$code = $request->get('mCode');
		$status = $request->get('mStatus');
		$result = "0";

		$response = new JsonResponse();
		$isAnythingToUpdate = false;
		if ($status != 0 && !empty($code) && !empty($companyCode)) {
			$result = "3";	
			$isAnythingToUpdate = false;			
		} else {
			$dbPosStage = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStage')->findPosStageByCode($code);
			$posStage->setCode($code);
			$isAnythingToUpdate = true;
			/*if ($dbPosStage->getId() == $PosStage->getId()) {
			
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mCode',
						'mMessage' => "New Code equals current one. No need to update.");
				$response->setData($responseMsg);
				return $response;
			} */
			

			$description = $code;
			if (!empty($description)) {
				$dbPosStage = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStage')->findPosStageByDescription($description);
				$posStage->setDescription($description);
				$isAnythingToUpdate = true;	
			 	/*if ($dbPosStage->getId() == $PosStage->getId()) {
			
					$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mDescription',
						'mMessage' => "New mDescription equals current one. No need to update.");
					$response->setData($responseMsg);
					return $response;
				}*/
			}

			$userId = $request->get('mUser_id');
			if (!empty($userId)) {
				$dbPosStage = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStage')->findPosStageByUserId($userId);
				$posStage->setUserId($userId);
				$isAnythingToUpdate = true;	
			 	/*if ($dbPosStage->getId() == $PosStage->getId()) {
			
					$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mUser_id',
						'mMessage' => "New mUser_id equals current one. No need to update.");
					$response->setData($responseMsg);
					return $response;
				}*/
			}
		}

		if(!$isAnythingToUpdate) {
			$responseMsg = array (
						'mSuccess' => false,
						'mErrorField' => "null__--------",
						'mMessage' => "Nothing to update");
			$result = "0";
		} else {		
			$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStage')->updatePosStage($posStage);
			$result = "1";
		}
		
		$response->setData($responseMsg);
		return $response;
	}
	

	/**
	 * DELETE POSSTAGE (via POST, PATCH or PUT)
	 * @ParamConverter("posstage", class="heyAutoDemoBundle:PosStage")
	 * @Post("/rest/deleteposstages/{id}")
	 * @Patch("/rest/deleteposstages/{id}")
	 * @Put("/rest/deleteposstages/{id}")
	 * oryginally: posStageAction
	 **/

	public function deletePosStageAction(Request $request) {
		$response = new JsonResponse();
		$posITable = new PosITable();
		$posStageITable = new PosStageITable();
		$isDelete = false;
		$idStage = $request->get('id');

		$tableOnStageData = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStageITable')->findAllTableByStageId($idStage);
			
		echo var_dump($tableOnStageData);

		foreach ($tableOnStageData as $tableOnline) {
			$status = $tableOnline->getStatus();
			if ($status != 0) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mId',
						'mMessage' => "Stage have table online.");
					$response->setData($responseMsg);
					return $response;
			}
		}
		if($isDelete) {
			$responseMsg = array (
						'mSuccess' => false,
						'mErrorField' => null,
						'mMessage' => "Nothing to Delete");
		} else {		
			// Xóa bàn trong bảng pos_stage_itable có stage_code = $floor
			$tableOnStage = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStageITable')->findAllTableByStageId($idStage);
			foreach ($tableOnStage as $table) {
				$idTable = $table->get('mId_table');				
				return $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStageITable')->deleteItableInStage($idTable);			
			}
			// Xóa bàn trong bảng pos_itable có id = $table_id
			$companyCode = $request->get('mCompany_code');
			$tableWithCompanyCodeData = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')->findTableByCompanyCode($companyCode);
			foreach ($tableWithCompanyCodeData as $table) {
				$idTable = $table->get('mId');
				return $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')->deleteItableByCompanyCodeItableId($companyCode, $idTable);
			}

			$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStage')->deletePosStage($idStage);	
		}
		
		$response->setData($responseMsg);
		return $response;
	}
}
