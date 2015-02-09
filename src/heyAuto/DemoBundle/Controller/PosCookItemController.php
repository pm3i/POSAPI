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
use heyAuto\DemoBundle\Entity\PosCookItem;

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
class PosCookItemController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetallcookitempos")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getAllCookItemJsonAction(Request $request) {
		
		$mCompanyCode='NHSG';
		$item_id  =  299;
		$user_id = 361;

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosCookItem' )
					->getAllCookItem($item_id, $user_id, $mCompanyCode);

		$resultJson = null;
		foreach($posCookItemArr as $posCookItem) {			
			$resultJson[] = $posCookItem;
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetcookinvdetail")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getCookInvoiceDetailJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';

		$posCookInvoiceArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->getInvoiceCookDetail($mCompanyCode);

		$resultJson = null;
		foreach($posCookInvoiceArr as $posCookInvoice) {	
			$posMedias = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosMedia' )
							->getAllMedia($posCookInvoice["item_id"], $mCompanyCode);
			for ($i=0; $i < count($posMedias) ; $i++) { 
				$posCookInvoice["imagename"] = $posMedias[$i]["name"];
			}
			$resultJson[] = $posCookInvoice;	
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetcookitem")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getCookItemJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosCookItem' )
					->getCookItem($mCompanyCode);

		$resultJson = null;
		foreach($posCookItemArr as $posCookItem) {			
			$resultJson[] = $posCookItem;
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wscheckComment")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function checkCommentJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';
		$item_id='205';

		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->checkComment($item_id, $mCompanyCode);

		$resultJson = null;
		foreach($posInvoiceDetailArr as $posInvoiceDetail) {	
			$resultJson[] = $posInvoiceDetail;	
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Post("/rest/wsaddcookitem")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function addCookItemJsonAction(Request $request) {
		$posCookItem = new PosCookItem();

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 		= date_format($date, 'Y-m-d H:i:s');

		$item_id        = '205';
		$user_id        = '356';
		$quantity       = '2';
		$notes          = '1111';
		$checked        = '1';
		$company_code   = 'NHHR';

		$posCookItem->setItemId($item_id);
		$posCookItem->setUserId($user_id);
		$posCookItem->setQuantity($quantity);
		$posCookItem->setCookCreatetime($time_in);
		$posCookItem->setNotes($notes);
		$posCookItem->setChecked($checked);
		$posCookItem->setCompanyCode($company_code);

		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosCookItem' )
					->createNewPosCookeItem($posCookItem);
	
		$response = new JsonResponse();
		$response->setData( $posInvoiceDetailArr );
		return $response;
	}


	
}
