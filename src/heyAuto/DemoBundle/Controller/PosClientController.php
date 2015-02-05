<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosCompany;
use heyAuto\DemoBundle\Entity\PosInvoice;
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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @author eros
 */
class PosClientController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetdetailclient")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getInfoClientJsonAction(Request $request) {
		
		$invoiceCode = 'T1_B3_20150203_082302';

		$posVoices = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosClient' )
					->getPosClientByinvoice($invoiceCode);

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
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * Chuc nang ghi no
	 * @Post("/rest/wsdebt")
	 **/
	public function createDebtAction(Request $request) {
		$posClient = new PosClient();
		$posInvoice = new PosInvoice();

		$clientName    = 'Vu';//$obj->{'clientName'};
		$clientPhone   = '111';//$obj->{'clientPhone'};
		$clientAdd     = 'aaa';//$obj->{'clientAdd'};
		$company_code  = 'NHHR';//$obj->{'company_code'};

		$pay_cost      = '200';//$obj->{'price'};
		$inv_code      = 'T1_B4888_20150204_084043';//$obj->{'inv_code'};
		$now_debt	   = '2015-02-03';//$obj->{'date_debt'};
		
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		//$now_debt		= $now_debt->format('y-m-d H:m:s');
		$date_debt		= date_create($now_debt);
		$now_debt		= date_format($date_debt, 'Y-m-d H:i:s');

		$resultJson = null;
		$posItableData = null;
		try {
			// khoi tao doi tuong add gia tri vao
			//set cho pos itable
			$posClient -> setName($clientName);
			$posClient -> setPhone($clientPhone);
			$posClient -> setAddress($clientAdd);
			$posClient -> setCompanyCode($company_code);

			//---Them 1 client moi---//
			$responseClients = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosClient')->createNewPosClient($posClient);
			$clientId = $posClient->getClientId();	

			$invoiceIds = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoice')->findInvoiceIdByInvoiceCode($inv_code, $company_code);

			// update trang thai invoice code trong bang pos invoice//
			// set data cho doi tuong
			$posInvoice -> setStatus(0);
			$posInvoice -> setInvType(4);
			$posInvoice -> setPayCost($pay_cost);
			$posInvoice -> setRepaymentDate($now_debt);
			$posInvoice -> setClientId($clientId);
			$posInvoice -> setInvCode($inv_code);

			$posInvoice -> setUserId(356);  // du lieu test

			$posInvoice -> setInvStarttime($now);
			if (!empty($invoiceIds)){
				$posInvoice -> setInvId($invoiceIds[0] -> getInvId());
			}	
			$posInvoice -> setCompanyCode($company_code);
			$responseInvoices = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoice')->updateInvoiceByInvoiceCode($posInvoice);


			
			$posItableData = array( "success"          => "1");
			$resultJson[] = $posItableData;
		} catch(Exception $e){
			$posItableData = array( "success"          => "0");
			$resultJson[] = $posItableData;
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
	 * Chuc nang ghi no
	 * @Post("/rest/wspayment")
	 **/
	public function paymentAction(Request $request) {
		$posInvoice = new PosInvoice();

		$company_code  = 'NHHR';//$obj->{'company_code'};
		$inv_code      = 'T1_B4888_20150204_084043';//$obj->{'inv_code'};
		$vat           = '15';//$obj->{'vat'};
		$com           = '30';//$obj->{'com'};
		$cost          = '222';//$obj->{'cost'};
		$total         = '333';//$obj->{'total'};
		$inv_type      = '0';//$obj->{'inv_type'};
		
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		$resultJson = null;
		$posItableData = null;
		try {
			// khoi tao doi tuong add gia tri vao

			$invoiceIds = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoice')->findInvoiceIdByInvoiceCode($inv_code, $company_code);

			// update trang thai invoice code trong bang pos invoice//
			// set data cho doi tuong
			$posInvoice -> setStatus(0);
			$posInvoice -> setInvType($inv_type);
			$posInvoice -> setInvCode($inv_code);

			$posInvoice -> setUserId(356);  // du lieu test
			$posInvoice -> setPayCost(0); // du lieu test
			$posInvoice -> setInvStarttime($now);// du lieu test
			
			$posInvoice -> setInvEndtime($now);
			$posInvoice -> setTotal($total);
			$posInvoice -> setCommision($com);
			$posInvoice -> setCost($cost);
			$posInvoice -> setVat($vat);
			if (!empty($invoiceIds)){
				$posInvoice -> setInvId($invoiceIds[0] -> getInvId());
			}	
			$posInvoice -> setCompanyCode($company_code);
			$responseInvoices = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoice')->updateInvoiceByInvoiceCode($posInvoice);

			if($inv_type != 2){
				$posInvoiceItables = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')->getInvoiceItableHaveTableOnline($inv_code);
				if(count($posInvoiceItables) > 0){
					$posItables = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
							->findItableByCodeTableAndCompanyCode($posInvoiceItables[0] -> getCodeTable(), $company_code);
					$posItables[0] -> setStatus(0);
					$posItables[0] -> setFlag(0);
					$responseItables = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')->updateItable($posItables[0]);

					$posInvoiceItables[0] -> setStatus(0);
					$responseInvoiceItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')->updateInvoiceItable($posInvoiceItables[0]);
				}

			}
			$posItableData = array( "success"          => "1");
			$resultJson[] = $posItableData;
		} catch(Exception $e){
			$posItableData = array( "success"          => "0");
			$resultJson[] = $posItableData;
		}
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}


	
}
