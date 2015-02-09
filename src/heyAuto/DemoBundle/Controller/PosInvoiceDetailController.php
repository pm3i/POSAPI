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
class PosInvoiceDetailController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetquantitybalance")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getQuantityBlanceJsonAction(Request $request) {
		
		$item_id  = 298;
 		$company_code  = 'NHSG';

		$posItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItems' )
					->getSumQuantityInWsGetQuantityBlance($company_code, $item_id);
		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->getSumQuantityInvoiceDetail($company_code, $item_id);

		$resultJson = null;
		// $resultJson[] = $posItemArr;
		foreach ($posItemArr as $posItem) {
			$quantityItem  = $posItem["quantitycook"];
		}

		foreach ($posInvoiceDetailArr as $posInvoiceDetail) {
			$quantityInvoiceDetail  = $posInvoiceDetail["quantity"];
		}
		if(!empty($quantityItem )){
			$total = ($quantityItem - $quantityInvoiceDetail);
		} else {
			$total = 0;
		}
		
		
		
		$resultJson[] = array('quantitybalance' => $total );
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsvoiceservice2")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getNumberItemsJsonAction(Request $request) {
		
		$item_id  = 299;
 		$invCode  = 'T1_B20_20150206_185938';

		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->findInvoiceDetailByInvoieCodeAndItemId($invCode, $item_id);

		$resultJson = null;

		foreach ($posInvoiceDetailArr as $posInvoiceDetail) {
			$resultJson[] = $posInvoiceDetail->toArray();
		}
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Post("/rest/wsupdatedetailinvdetail")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function updatedetailInvDetailJsonAction(Request $request) {
		
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 		= date_format($date, 'Y-m-d H:i:s');

		$id ='682';

		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->findInvoiceDetailById($id);

		$resultJson = null;

		foreach ($posInvoiceDetailArr as $posInvoiceDetail) {
			$posInvoiceDetail -> setChecked(1);
			$posInvoiceDetail -> setInvdUpdatetime($time_in);
			$resultJson[] = array('success' => $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->updateInvoiceDetail($posInvoiceDetail));
		}
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Post("/rest/wsdelDetailInvdetail")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function deleteDetailInvDetailJsonAction(Request $request) {
		
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 		= date_format($date, 'Y-m-d H:i:s');

		$inv_code  = 'T1_B20_20150206_185938';
		$company_code = 'NHSG';

		$id ='683';
		$total = 0;

		$posInvoiceDetailArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->deleteInvoiceDetailById($id);

		$posInvoiceDetailPriceArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoiceDetail' )
					->getPriceInvoiceDetailWithDateNow($inv_code, $company_code);
		for ($i=0; $i < count($posInvoiceDetailPriceArr) ; $i++) { 
			$total +=  $posInvoiceDetailPriceArr[$i]["price"]* $posInvoiceDetailPriceArr[$i]["quantity"];
		}

		// update tong tien vao posinvoice
		$updatepricePosInvoice = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
					->updatePriceInPosInvoice($inv_code, $total, $time_in);
		if($updatepricePosInvoice){ // neu update thanh cong thi tra ve gia tri la 1
			$posItableData = array( "success"          => "1");		
		} else {
			$posItableData = array( "success"          => "0");		
		}

		$resultJson = null;
		$resultJson[] = $posItableData;
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


}
