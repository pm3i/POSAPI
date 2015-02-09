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
use heyAuto\DemoBundle\Entity\PosInvoiceItable;
use heyAuto\DemoBundle\Entity\PosClient;

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
	public function getAllInvoiceByStatusAction(Request $request) {
		
		$mCompanyCode='NHHR';
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		$sonews = 15;
		$number_pager = 1;

		$resultJson = null;

		$posInvoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
				->getInvoiceByStatus($now, $mCompanyCode);
		//$tongsotrang = ceil(count($posInvoices) / $sonews);
		$numberrow = count($posInvoices);
		if( $number_pager > 0) {
			$from =($number_pager - 1) * $sonews;

			$to = $number_pager * $sonews;

			$posInvoicesOfClients = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
					->getInvoiceOfClient($from, $to, $mCompanyCode);

			for ($i=0; $i <count($posInvoicesOfClients) ; $i++) { 
				
				$inv_code = $posInvoicesOfClients[$i]["inv_code"];
				//$posItableData = array( "success"          => $posInvoicesOfClients[$i]["inv_code"]);
				$codeTableInvoiceItables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
					->getCodeTableFromInvoiceCode($inv_code, $mCompanyCode);
					for ($j=0; $j < count($codeTableInvoiceItables); $j++) { 
						$code_table = $codeTableInvoiceItables[$j]["code_table"];
						if ($code_table != null) {
							$posInvoicesOfClients[$i]["code_table"] = ($codeTableInvoiceItables[$j]["code_table"]);
						} else {
							$posInvoicesOfClients[$i]["code_table"] = "null";
						}
						
					}

				$resultJson[] = $posInvoicesOfClients[$i];
			}
		} else {
			for ($i=0; $i < count($posInvoices) ; $i++) { 
				$inv_code = $posInvoices[$i]["inv_code"];
				$codeTableInvoiceItables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
					->getCodeTableFromInvoiceCode($inv_code, $mCompanyCode);
				for ($j=0; $j < count($codeTableInvoiceItables); $j++) { 
					$code_table = $codeTableInvoiceItables[$j]["code_table"];
					if (!empty( $code_table)) {
						$posInvoices[$i]["code_table"] = ($codeTableInvoiceItables[$j]["code_table"]);
					} else {
						$posInvoices[$i]["code_table"] = "null";
					}
				}
				$resultJson[] = $posInvoices[$i];
			}

		}

		//$resultJson[] = $posItableData;
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
	public function getAn_AllInvoiceDetailAction(Request $request) {
		
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
	 * @Post("/rest/wsaddnewinvoice")
	 * oryginally: postItableAction
	 **/
	
	public function createNewPosInvoiceAction(Request $request) {
		$posClient = new PosClient();
		$posInvoice = new PosInvoice();
		$user_id    = '356';
		$inv_code   = 'T1_B16_20150206_155020';
		$parent_inv = '0';
		$inv_type   = '';
		$status 		= '1';
		$company_code = 'NHSG';
		$nameClient      = 'Vu test';
		$phoneClient     = '055593';
		$addressClient   = 'Ha noi';

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 			= date_format($date, 'Y-m-d H:i:s');

		// check client to insert info
		$posClientsArr =  $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosClient' )
							->getPosClientByPhone($phoneClient, $company_code);
		if(count($posClientsArr) <= 0){
			$posClient -> setName($nameClient);
			$posClient -> setPhone($phoneClient);
			$posClient -> setAddress($addressClient);
			$posClient -> setCompanyCode($company_code);
			$checkStatus = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosClient')->createNewPosClient($posClient);
		}

		$posClientsArr =  $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosClient' )
							->getPosClientByPhone($phoneClient, $company_code);

		foreach ($posClientsArr as $posClient) {
			$posInvoice -> setTotal("0.0");
			$posInvoice -> setCost("0.0");
			$posInvoice -> setInvCode($inv_code);
			$posInvoice -> setVat("0.0");
			$posInvoice -> setCommision("0.0");
			$posInvoice -> setInvStarttime($time_in);
			$posInvoice -> setUserId($user_id);
			$posInvoice -> setStatus($status);
			$posInvoice -> setInvType($inv_type);
			$posInvoice -> setInvCodeParent($parent_inv);
			$posInvoice -> setCompanyCode($company_code);
			$posInvoice -> setClientId($posClient->getClientId());
			$checkStatus = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoice')->createNewPosInvoice($posInvoice);
		}
		if($checkStatus == 1){
			$posItableData = array( "success"          => "1");
		} else if($checkStatus == 2){
			$posItableData = array (
					'mSuccess' => false,
					'mErrorField' => null,
					'mMessage' => "Unknown error" 
			);
		}else{
			$posItableData = array( "success"          => "0");
		}
		$resultJson[] = $posItableData;
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

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
		
		date_default_timezone_set('Asia/Bangkok');
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
			// tao moi invoice detail
			$responseMsg = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->createNewPosInvoiceDetail($posInvoiceDetail);

			// lay Id cua item cost theo company code
			$posItemCosts = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCost' )->getIdPosItemCost($company_code);

			// lay du lieu invoice detail
			$posInvoiceDetails = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getPriceQuantityInInvoiceDetail($item_id, $company_code, $inv_code, $posItemCosts[0] -> getId());
			$total=0;
			$sumQuantity = 0;

			for ($i=0; $i < count($posInvoiceDetails); $i++) { 
				// lay price trong bang Item cost detail
				$posItemCostDetailsPrice = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getPriceFromItemId($posInvoiceDetails[$i]->getItemId(), $company_code);
				// set price cho doi tuong Invoice detail
				$posInvoiceDetails[$i]->setPrice($posItemCostDetailsPrice[0]->getPrice());
				$sumQuantity += $posInvoiceDetails[$i]->getQuantity(); // tinh tong quantity
				$total = (($posInvoiceDetails[$i]->getPrice()) * $sumQuantity); // tinh tong gia tien + so luong
				//$posItableData = array( "success"          => $sumQuantity, "count" => count($posInvoiceDetails));
			}

			// lay ra doi tuong posinvoice de thuc hien update
			$posInvoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
							->findInvoiceIdByInvoiceCode($inv_code, $company_code);

			$posInvoices[0] -> setTotal($total);
			$posInvoices[0] -> setInvEndtime($now);

			// update gia tri thay doi vao invoice: tong tien
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

	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wssplitinvoice")
	 * oryginally: postItableAction
	 **/
	
	public function splitInvoiceAction(Request $request) {
		$posInvoiceDetails = new PosInvoiceDetail();
		$inv_code = 'T1_B19_20150206_120021';
		$item_id  = '299';
		$quantity = '1';
		$comment  = '11';
		$flag     = '0';
		$subAdd	  = '';
		$user_id  = '356';
		$company_code = 'NHSG';
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 			= date_format($date, 'Y-m-d H:i:s');

		$total = 0;

		//khi chen phan tu dau tien thi no xoa het du lieu voi inv_code cu
		if($flag ==1){
			try{
				$posInvDetail = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
											->deleteInvoiceDetailByInvoieCode($inv_code);
				if($posInvDetail){
					$posItableData = array( "success"          => "1");
				} else {
					$posItableData = array( "success"          => "0");
				}
				
			}catch(Exception $e){
				$posItableData = array( "success"          => "0");
			}
		}

		$posInvoiceDetails->setItemId($item_id);
		$posInvoiceDetails->setInvCode($inv_code);
		$posInvoiceDetails->setFlag(1);
		$posInvoiceDetails->setQuantity($quantity);
		$posInvoiceDetails->setComment($comment);
		$posInvoiceDetails->setInvdCreatetime($time_in);
		$posInvoiceDetails->setChecked(0);
		$posInvoiceDetails->setUserid($user_id);
		$posInvoiceDetails->setCompanyCode($company_code);
		try {
			//tao moi 1 invoice detail
			$posnewInvDetail = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
											->createPosInvoiceDetailReturn01($posInvoiceDetails);
			if($posnewInvDetail == 1){
				// lay gia tri cua price va quantity
				$posItemCostDetailsPrices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
							->getPriceInvoiceDetailWithDateNow($inv_code, $company_code);

				for ($i=0; $i < count($posItemCostDetailsPrices) ; $i++) { 
					$total +=  $posItemCostDetailsPrices[$i]["price"]* $posItemCostDetailsPrices[$i]["quantity"];
				}

				// update tong tien vao posinvoice
				$updatepricePosInvoice = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
							->updatePriceInPosInvoice($inv_code, $total, $time_in);
				if($updatepricePosInvoice){ // neu update thanh cong thi tra ve gia tri la 1
					$posItableData = array( "success"          => "1");		
				} else {
					$posItableData = array( "success"          => "0");		
				}
			}

		} catch (Exception $e) {
			$posItableData = array( "success"          => "0");
		}
		
		$resultJson[] = $posItableData;
		
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetallinvdetail")
	 *
	 * lay tat ca invoice detail
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
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
							->getAllInvoiceDetail($idItemCost, $companyCode);

		foreach($posInvoicesDetails as $posInvoicesDetail) {	
			$posMedias = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosMedia' )
							->getAllMedia($posInvoicesDetail["item_id"], $companyCode);
			for ($i=0; $i < count($posMedias) ; $i++) { 
				$posInvoicesDetail["imagename"] = $posMedias[$i]["name"];
			}
			$resultJson[] = $posInvoicesDetail;
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wsupdatestatusinv")
	 * oryginally: postItableAction
	 **/
	
	public function updateStatusInvoiceAction(Request $request) {
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$dateCurrent 			= date_format($date, 'Y-m-d H:i:s');

		$inv_code   = 'T1_B19_20150206_120021';
		$vat        = '';
		$com        = '';
		$cost       = '';
		$total      = '';
		$inv_type   = '1';
		$company_code = 'NHSG';

		// update status cho pos invoice
		$updateStatusInvoice = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
						->updateStatusAndEndTimeInPosInvoice($inv_code, $inv_type, $dateCurrent );
		if($inv_type!=2){
			// lay ra thong tin invoice itable theo invoice code va company code
			$posInvoiceItables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->findInvoiceItableByInvCodeStatusCompanyCode($inv_code, $company_code);
			foreach ($posInvoiceItables as $posInvoiceItable) {
				// update vao bang itable status = 2, flag = 0 tai code table xac dinh
				$updateStatusFlagForPosItable = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )
						->updateStatusFlagForPosItable($dateCurrent, $posInvoiceItable->getCodeTable(), $company_code);
			}
			// update vao bang invoice itable status = 0
			$updateStatusInvItableByInvCode = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->updateStatusInvItableByInvCode($dateCurrent, $inv_code, $company_code);
			if($updateStatusFlagForPosItable && $updateStatusInvItableByInvCode){
				$posItableData = array( "success"          => "1");		
			} else {
				$posItableData = array( "success"          => "0");		
			}
		}

		$resultJson[] = $posItableData;
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}	

	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wsupdatejoininv")
	 * oryginally: postItableAction
	 **/
	
	public function updateJoinInvoiceAction(Request $request) {
		$posInvoiceItables = new PosInvoiceItable();

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$dateCurrent 			= date_format($date, 'Y-m-d H:i:s');

		$inv_code_new = 'T1_B18_20150206_T1_B20_20150206_20150206_160005';
		$inv_code_old = 'T1_B18_20150206_155709';
		$company_code = 'NHSG';

		// get code table va user id tu pos invoice itable
		$posInvoiceItables =  $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->getInvoiceItableByCompanyCodeAndInvoiceCode($inv_code_old, $company_code);
		foreach ($posInvoiceItables as $posInvoiceItable) {
			$posInvoiceItable->setInvCode($inv_code_new);
			$posInvoiceItable->setCodeTable($posInvoiceItable->getCodeTable());
			$posInvoiceItable->setUserId($posInvoiceItable->getUserId());
			$posInvoiceItable->setStatus(1);
			$posInvoiceItable->setCreattime($dateCurrent);
			$posInvoiceItable->setCompanyCode($company_code);

			$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )->createNewPosInvoiceItable($posInvoiceItable);
			$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
					->updateStatusInvItableByInvCode($dateCurrent, $inv_code_old, $company_code);
		}
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}	
	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wsdestroyInvoice")
	 * oryginally: postItableAction
	 **/
	
	public function destroyInvoiceAction(Request $request) {
		$inv_code   = 'T1_B18_20150206_161656';
		$vat        = '';
		$com        = '';
		$cost       = '';
		$total      = '';
		$inv_type   = '1';
		$company_code = 'NHSG';
		$resultJson = null;

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 		= date_format($date, 'Y-m-d H:i:s');

		$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
						->updateStatusByInvoiceCodeAndCompanyCode($inv_code, $company_code, $time_in, $inv_type, 2);

		if($inv_type!=2){
			$posInvoiceItableArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->getInvoiceItableByCompanyCodeAndInvoiceCode($inv_code, $company_code);
			foreach ($posInvoiceItableArr as $posInvoiceItable) {
				$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )
						->updateStatusFlagForPosItable2( $time_in, $posInvoiceItable->getCodeTable(), $company_code, 0, 0);
			}

			$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->updateStatusInvItableByInvCode( $time_in, $inv_code, $company_code);
		}
		
		$resultJson[] = array('success' => "1" );
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}

	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE itable
	 * @Post("/rest/wsremove_and_update_table")
	 * oryginally: postItableAction
	 **/
	
	public function removeUpdateTableAction(Request $request) {
		$code_table   = 'T1_B20';
		$user_id	= '356';

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 		= date_format($date, 'Y-m-d H:i:s');

		$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceItable' )
						->updateInvItableByCodeTableAndStatus( $code_table, 0, $time_in);

		$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )
				->updatePosItableForWSRemoveUpdateTable( $time_in, $user_id, $code_table, 0);
	
		
		$resultJson[] = array('success' => "1" );
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}


}
