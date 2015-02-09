<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosVoice;
use heyAuto\DemoBundle\Entity\PosVoicePos;

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
 * @author eros
 */
class PosVoiceController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetnamevoice")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getNameVoiceJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';

		$posVoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoice' )
					->getVoicebyCompanyCode($mCompanyCode);

		$resultJson = null;
		foreach($posVoices as $posVoice) {			
			$resultJson[] = $posVoice->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Post("/rest/wsvoiceservice")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function insertorupdateVoicePosJsonAction(Request $request) {
		
		$invdetail_id = '51';
		$status = '0';
		$flag = '0';
		$type = '0';
		$user_id = '361';
		$company_code = 'NHSG';

		$posVoicesposArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					->getVoicePosbyCompanyCodeInvDetailId($company_code, $invdetail_id);

		if(count($posVoicesposArr) > 0){
			foreach ($posVoicesposArr as $posVoicespos) {
				$posVoicespos->setStatus(1);
				$posVoicespos->setFlag($flag);
				$posVoicespos->setType($type);
				$posVoicespos->setUserId($user_id);

				$result = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					->updatePosVoicePos($posVoicespos);

			}
		}else{
				$posVoicespos = new PosVoicePos();
				$posVoicespos->setStatus($status);
				$posVoicespos->setFlag($flag);
				$posVoicespos->setType($type);
				$posVoicespos->setUserId($user_id);
				$posVoicespos->setInvdetailId($invdetail_id);
				$posVoicespos->setCompanyCode($company_code);
				$result = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					->createNewPosVoicePos($posVoicespos);	
		}

		$resultJson = null;		
		$resultJson[] = array('voiceservice' => $result );
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsvoiceservice_getallvoice")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getAllVoiceJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';

		$posVoicesArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					->getAllVoice($mCompanyCode);

		$resultJson = null;
		foreach($posVoicesArr as $posVoice) {			
			$posCodeTableArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
							->getInvoiceItableByCompanyCodeAndInvoiceCode($posVoice["inv_code"], $mCompanyCode);
			for ($i=0; $i < count($posCodeTableArr) ; $i++) { 
				$posVoice["code_table"] = $posCodeTableArr[$i]-> getCodeTable();
			}
			$resultJson[] = $posVoice;
		}

	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Post("/rest/wsvoiceservice_updatevoice")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function updateVoicePosJsonAction(Request $request) {
		
		$vocie_id = '5';
		$status = '1';
		$flag = '1';
		$result = "";

		$posVoicespos = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					->findVoicePosByVoiceId($vocie_id);

		if ($posVoicespos!=null){
			$posVoicespos->setStatus($status);
			$posVoicespos->setFlag($flag);
			$result = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosVoicePos' )
					 ->updatePosVoicePos($posVoicespos);
		}
		

		$resultJson = null;		
		$resultJson[] = array('wsvoiceservice_updatevoice' => $result );
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	
}
