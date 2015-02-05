<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosInvoice;
use heyAuto\DemoBundle\Entity\PosInvoiceDetail;
use heyAuto\DemoBundle\Entity\PosItemCost;
use heyAuto\DemoBundle\Entity\PosItemCostDetail;

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
class PosInvoiceController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetallinvoice")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getallinvoiceAction(Request $request) {
		
		$mCompanyCode='NHSG';

		$posInvoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
				->getNumberRowForInvoice($mCompanyCode);
		$numberrow = count($posInvoices);
		echo $numberrow;
		$resultJson = null;
		//$resultJson[] = $user->toArray();
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetanallinvdetail")
	 *
	 * lay tat ca invoice detail
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */

	// Ham dang tra du lieu sai
	public function getAllInvoiceDetailAction(Request $request) {
		
		$companyCode='NHHR';
		$languageCode = 2;
		$invoice_code = '';
		// lay ra id cua bang gia mon an theo company code
		$posItemCosts = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCost' )->getIdPosItemCost($companyCode);

		$resultJson = null;
		$idItemCost = null;
		$priceItemCostDetail = null;
		foreach($posItemCosts as $posItemCost) {			
			$idItemCost= $posItemCost->getId();
		}

		// lay ra thong tin cua chi tiet hoa don
		$posInvoicesDetails = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getInvoiceDetail($idItemCost, $companyCode);

		$posItemCostDetails = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCostDetail' )
							->getPriceItemCostDetail($idItemCost, $companyCode);
		//foreach($posItemCostDetails as $posItemCostDetail) {			
		//		$priceItemCostDetail = $posItemCostDetail->getPrice();
		//}
		foreach($posInvoicesDetails as $posInvoicesDetail) {	

			$resultJson[] = $posInvoicesDetail->toArray($posItemCostDetails[1]->getPrice());
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	// get name media
	private function getNamePosMedia(PosInvoiceDetail $invD, $companyCode){
		$posMediaItems = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosMediaItems' )
							->findIdMediaItem($invD->getItemId);
		foreach($posMediaItems as $posMediaItem) {	
			$posMedias = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosMedia' )
							->findNameMedia($posMediaItem->getItemsId(), $companyCode);
		}
	}


	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wsaddnewinvoicedetail")
	 * oryginally: postItableAction
	 **/
	
	public function createNewPosInvoiceDetailAction(Request $request) {
		$posInvoiceDetail = new PosInvoiceDetail();

		$inv_code = 'T2_B1_20150205_084229';
		$item_id = '207';
		$quantity = 1;
		$comment = '';
		$user_id = '356';
		$company_code = 'NHHR';
		$resultJson = null;
		$posItableData = null;
		

		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		$posInvoiceDetail -> setItemId($item_id);
		$posInvoiceDetail -> setInvCode($inv_code);
		$posInvoiceDetail -> setFlag(1);
		$posInvoiceDetail -> setQuantity($quantity);
		$posInvoiceDetail -> setComment($comment);
		$posInvoiceDetail -> setInvdCreatetime($now);
		$posInvoiceDetail -> setChecked(0);
		$posInvoiceDetail -> setUserid($user_id);
		$posInvoiceDetail -> setCompanyCode($company_code);

		try {
			$responseMsg = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->createNewPosInvoiceDetail($posInvoiceDetail);

			$posItemCosts = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCost' )->getIdPosItemCost($company_code);

			$posInvoiceDetails = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getPriceQuantityInInvoiceDetail($item_id, $company_code, $inv_code, $posItemCosts[0] -> getId());
			$total=0;
			$sumQuantity = 0;

			for ($i=0; $i < count($posInvoiceDetails); $i++) { 
				$posItemCostDetailsPrice = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getPriceFromItemId($posInvoiceDetails[$i]->getItemId(), $company_code);
				$posInvoiceDetails[$i]->setPrice($posItemCostDetailsPrice[0]->getPrice());
				$sumQuantity += $posInvoiceDetails[$i]->getQuantity();
				$total = (($posInvoiceDetails[$i]->getPrice()) * $sumQuantity);
				//$posItableData = array( "success"          => $sumQuantity, "count" => count($posInvoiceDetails));
			}

			$posInvoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
							->findInvoiceIdByInvoiceCode($inv_code, $company_code);

			$posInvoices[0] -> setTotal($total);
			$posInvoices[0] -> setInvEndtime($now);

			$updateInvoiceAction = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
							->updateInvoiceByInvoiceCode($posInvoices[0]);

			$posItableData = array( "success"          => "1");
			
		} catch(Exception $e){
			$posItableData = array( "success"          => "0");
		}
		 $resultJson[] = $posItableData;

		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}




	
}
