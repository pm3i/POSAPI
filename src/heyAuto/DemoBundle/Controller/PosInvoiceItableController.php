<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosITable;
use heyAuto\DemoBundle\Entity\PosInvoiceItable;
use heyAuto\DemoBundle\Entity\PosStageITable;

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
class PosInvoiceItableController extends Controller {
	
	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * update itable
	 * @Post("/rest/wsupdatetransfertable")
	 * oryginally: postItableAction
	 **/
	 /// Ham insert chua co thong bao tra ve ket qua thanh cong
	public function updatePosInvoiceItableAction(Request $request) {
		$posInvoiceItable = new PosInvoiceItable();

		$code_table_tranf 		  = 'T1_B3';
		$code_table_get    		  = 'T1_B2';
		$company_code     		  = 'NHSG';
		$user_id     	 		  = 356;
		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');
		$timeNewinvoice = date_format($date, 'Ymd_His');
		$newInvoice = $code_table_get.'_'.$timeNewinvoice;
		$resultJson = null;
		if(!empty($code_table_tranf) && !empty($code_table_get)) {
			try {
				//---lay ra danh sach invoice table theo code table cu trong bang  PosInvoiceItable---//
				$posInvoiceItables = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')
								->getInvoiceItableByCompanyCodeAndCodeTable($code_table_tranf, $company_code);	

				// lay ra tat ca cac ban co code table la codetable cu				
				$posItableOlds = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
								->findItableByCodeTableAndCompanyCode($code_table_tranf, $company_code);

				// lay ra tat ca cac ban co code table la codetable moi
				$posItableNews = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
								->findItableByCodeTableAndCompanyCode($code_table_get, $company_code);

				// update invoice itable
				if(count($posInvoiceItables) > 0){
					foreach($posInvoiceItables as $posInvoiceItable) {	
						$posInvoiceItable-> setCodeTable($code_table_get);
						$posInvoiceItable-> setStatus(1);
						$posInvoiceItableData = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')
									->updateInvoiceItable($posInvoiceItable);	
					}
					$result1 = 1;
				} else {
					$result1 = 0;
				}


				// update table theo code table cu
				if(count($posItableOlds) > 0){
					foreach($posItableOlds as $posItableOld) {	
						$posItableOld-> setStatus(0);
						$posItableOld-> setFlag(0);
						$posItableOld-> setUserid($user_id);
						$posItableOld-> setUpdateTime($now);

						$posInvoiceItableData = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
									->updateInvoiceItable($posItableOld);	
					}
					$result2 = 1;
				}else {
					$result2 = 0;
				}

				// update table theo code table moi
				if(count($posItableNews) > 0){
					foreach($posItableNews as $posItableNew) {	
						$posItableNew-> setStatus(2);
						$posItableNew-> setFlag(0);
						$posItableNew-> setUserid($user_id);
						$posItableNew-> setUpdateTime($now);

						$posInvoiceItableData = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
									->updateInvoiceItable($posItableNew);	
					}
					$result3 = 1;
				}else {
					$result3 = 0;
				}

				//----------------Tra thong bao ve client---------------//
				$posInvoiceItableData = null;
				if($result1 == 1 && $result2 == 1 && $result3 ==1){
					//update thanh cong
					$posInvoiceItableData = array( "result"          => 1);
					$resultJson[] = $posInvoiceItableData;
				} else {
					$posInvoiceItableData = array( "result"          => 0);
					$resultJson[] = $posInvoiceItableData;
				}
			} catch(Exception $e){
				$posInvoiceItableData = null;
				$posInvoiceItableData = array( "result"          => 0);
				$resultJson[] = $posInvoiceItableData;
			}
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
	 * @Post("/rest/wsaddinv_itable")
	 * oryginally: postItableAction
	 **/
	
	public function createNewPosInvoiceItableAction(Request $request) {
		$posInvoiceItable = new PosInvoiceItable();

		$inv_code   = 'T1_B18_20150206_161656';
		$table_code = 'T1_B19';
		$user_id    = '361';
		$company_code = 'NHSG';

		$posItableData = null;

		date_default_timezone_set('Asia/Bangkok');
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$time_in 			= date_format($date, 'Y-m-d H:i:s');

		$posInvoiceItableArr = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')
									->findInvoiceItableByInvCodeCodeTableCompanyCode($inv_code, $table_code, $company_code);	
		if(count($posInvoiceItableArr) <= 0){
			$posInvoiceItable->setInvCode($inv_code);
			$posInvoiceItable->setCodeTable($table_code);
			$posInvoiceItable->setUserId($user_id);
			$posInvoiceItable->setStatus(1);
			$posInvoiceItable->setCreattime($time_in);
			$posInvoiceItable->setCompanyCode($company_code);
			$result = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosInvoiceItable')
									->createNewPosInvoiceItable($posInvoiceItable);
			$posItableData = array( "success"          => $result);						
		}else{
			$posItableData = array( "success"          => 0);
		}


		$resultJson[] = $posItableData;
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}


	
}
