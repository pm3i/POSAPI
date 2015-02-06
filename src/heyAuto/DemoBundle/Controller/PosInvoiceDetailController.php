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


}
