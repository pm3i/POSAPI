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
class PosCategoryController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetallcategories")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getAllCategoriesJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';
		$language_code = '1';

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosCategory' )
					->getAllCategory($mCompanyCode, $language_code);

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
	 * @Get("/rest/wsreport")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getReportJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';
		$start_date    = '20150201';
		$end_date      = '20150209';

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
					->reportInvoice($start_date, $end_date, $mCompanyCode);

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
	 * @Get("/rest/wsreportitems")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getReportItemJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';
		$start_date    = '20150101';
		$end_date      = '20150209';
		$language_code      = '1';

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
					->reportItemsInvoice($start_date, $end_date, $mCompanyCode, $language_code);

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
	 * @Get("/rest/wsreportitem_category")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getReportCategoryJsonAction(Request $request) {
		
		$mCompanyCode='NHHR';
		$start_date    = '20150201';
		$end_date      = '20150209';
		$language_code      = '1';
		$category_id      = '80';

		$posCookItemArr = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosInvoice' )
					->reportCategoryInvoice($start_date, $end_date, $mCompanyCode, $language_code, $category_id);

		$resultJson = null;
		foreach($posCookItemArr as $posCookItem) {			
			$resultJson[] = $posCookItem;
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}
}
