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
use heyAuto\DemoBundle\Entity\PosItems;

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
class PosItemsController extends Controller {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsget_name_items")
	 *
	 * lay tat ca invoice detail
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */

	public function getNameItemAction(Request $request) {
		
		$companyCode='NHHR';
		$languageCode = 1;
		$cate_id       = '1';// $obj->{'cate_id'};
		$cate_name     = 'th';//vn_str_filter($obj->{'cate_name'});
				// lay ra id cua bang gia mon an theo company code
		$posItemCosts = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCost' )->getIdPosItemCost($companyCode);

		$resultJson = null;

		// lay ra thong tin cua chi tiet hoa don
		$posItems = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItems' )
							->getInfoPosItems($posItemCosts[0] -> getId() , $cate_name, $cate_id, $languageCode, $companyCode);
		foreach($posItems as $posItem) {
			//$posItem -> setPrice($posItems->getPrice());			
			$resultJson[] = $posItem->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetallparentitems")
	 *
	 * lay tat ca item
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */

	public function getAllParenItemsAction(Request $request) {
		
		$companyCode='NHHR';
		$languageCode = 1;
		$parent_id       = '1';// $obj->{'cate_id'};
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$dateNow 			= date_format($date, 'Y-m-d H:i:s');
		// lay ra id cua bang gia mon an theo company code
		$posItemCosts = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItemCost' )->getIdPosItemCost($companyCode);

		$resultJson = null;

		// lay ra thong tin cua chi tiet hoa don
		$posItems = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosItems' )
							->getAllParentItemPosItems($posItemCosts[0] -> getId(), $parent_id, $dateNow, $companyCode);
		foreach($posItems as $posItem) {		
			$resultJson[] = $posItem->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}


	public function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
    }
	
}
