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
	 * DELETE Invoice (via POST, PATCH or PUT)
	 * @ParamConverter("PosInvoice", class="heyAutoDemoBundle:PosInvoice")
	 * @Post("/rest/deleteposinvoices/{id}")
	 * @Patch("/rest/deleteposinvoices/{id}")
	 * @Put("/rest/deleteposinvoices/{id}")
	 * oryginally: PosInvoiceAction
	 **/

	public function deletePosInvoiceAction(Request $request){
		$idInvoice = $request->get('mInv-id');
		
	}

	
}
