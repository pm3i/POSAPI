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
use heyAuto\DemoBundle\Entity\PosStage;
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
class PosITableController extends Controller {
	
	//find itable by companyCode

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/positablebycompanycode")
	 *
	 * GET POSCOMPANYS LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getPosItableByCompanyCodeJsonAction(Request $request) {
		$companyCode = "NHSG";

		$positables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )->getItableByCompanyCode($companyCode);

		$resultJson = null;
		foreach($positables as $positable) {			
			$resultJson[] = $positable->toArray(0);
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/wsgetalltable")
	 *
	 * GET POSCOMPANYS LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getPosItableByFloorsonAction(Request $request) {
		$companyCode = "NHSG";
		$floor = 1;

		$positables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )->getItableByFloor($companyCode, $floor);

		$resultJson = null;
		foreach($positables as $positable) {			
			$resultJson[] = $positable->toArray(0);
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
	 * @Post("/rest/wsinsertnewtable")
	 * oryginally: postItableAction
	 **/
	 /// Ham insert chua co thong bao tra ve ket qua thanh cong
	public function createPosITableAction(Request $request) {
		$posITable = new PosITable();
		$posStageITable = new PosStageITable();

		$floor            = 1;
		$pos_x    		  = 0;
		$pos_y     		  = 0;
		$location_x 	  = 0;
		$location_y 	  = 0;
		$company_code     = 'NHHR';
		$code_table1 	  = '14';
		$user_id     	  = 356;
		$isCodeTable      = "T".$floor."_B".$code_table1;
		$positables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )->checkExistTable($company_code, $isCodeTable);
		
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		$resultJson = null;
		
		if(count($positables) > 0) {
			// ban da ton tai
			foreach($positables as $positable) {			
				$resultJson[] = $positable->toArray(1);
			}
		} else {
			try {
				// khoi tao doi tuong add gia tri vao
				//set cho pos itable
				$posITable -> setCodeTable($isCodeTable);
				$posITable -> setDescriptionTable($isCodeTable);
				$posITable -> setCreateTime($now);
				$posITable -> setStatus(0);
				$posITable -> setFlag(0);
				$posITable -> setPosX($pos_x);
				$posITable -> setPosY($pos_y);
				$posITable -> setUserid($user_id);
				$posITable -> setLocationX($location_x);
				$posITable -> setLocationY($location_y);
				$posITable -> setCompanyCode($company_code);

				//---Them 1 ban moi---//
				$responseItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')->createNewPosITable($posITable);	
				echo $posITable-> getItableId();
				//---Them ket noi giua tang va ban
				//set cho stage itable
				$posStageITable -> setIdItable($posITable-> getItableId());
				$posStageITable -> setIdStage($floor);
				$responseStageItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStageITable')->createNewPosITableStage($posStageITable);
				
				$posItableData = null;
				$posItableData = array( "result"          => "'".$isCodeTable."'");
				$resultJson[] = $posItableData;
			} catch(Exception $e){
				$posItableData = null;
				$posItableData = array( "result"          => "false");
				$resultJson[] = $posItableData;
			}
			$response = new JsonResponse();
			print_r($resultJson);
			$response->setData( $resultJson );
			return $response;

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
	 * Delete itable
	 * @Post("/rest/wsdeleteitable")
	 * oryginally: postItableAction
	 **/
	 /// Ham insert chua co thong bao tra ve ket qua thanh cong
	public function deletePosITableAction(Request $request) {
		$posITable = new PosITable();
		$posStageITable = new PosStageITable();

		$itable_id            = 33;
		$company_code  		  = 'NHHR';
		$positables = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosITable' )
					->checkItableExistForDelete($company_code, $itable_id);

		$resultJson = null;
		
		if(count($positables) <= 0) {
			// ban khong ton tai
			foreach($positables as $positable) {			
				$resultJson[] = $positable->toArray(1);
			}
		} else {
			try {
				// xoa ban trong bang itable
				$responseItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
									->deleteItableByCompanyCodeItableId($company_code, $itable_id);	

				// xoa ban trong bang Stage Itable
				$responseStageItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosStageITable')
									->deleteItableInStage($itable_id);
				
				$posItableData = null;
				$posItableData = array( "result"          => "Delete success itable and stage_itable by itable_id='".$itable_id."'!");
				$resultJson[] = $posItableData;
			} catch(Exception $e){
				$posItableData = null;
				$posItableData = array( "result"          => "false");
				$resultJson[] = $posItableData;
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
	 * @Post("/rest/wsupdatelistitable")
	 * oryginally: postItableAction
	 **/
	 /// Ham insert chua co thong bao tra ve ket qua thanh cong
	public function updatePosITableAction(Request $request) {
		$posITable = new PosITable();

		$table_id 		  = 21;
		$pos_x    		  = 0;
		$pos_y     		  = 0;
		$company_code     = 'NHHR';
		$code_table 	  = 'T1_B11';
		$user_id     	  = 356;
		
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

		$resultJson = null;
		try {
			// khoi tao doi tuong add gia tri vao
			//set cho pos itable
			$posITable -> setCodeTable($code_table);
			$posITable -> setDescriptionTable($code_table);
			$posITable -> setPosX($pos_x);
			$posITable -> setPosY($pos_y);
			$posITable -> setUserid($user_id);
			$posITable -> setUpdateTime($now);

			//---sua 1 ban ---//
			$responseItable = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosITable')
							->updateItableByCompanyCodeItableId($posITable,$code_table , $pos_x , 
								$pos_y, $now , $user_id , $company_code, $table_id);	
			$posItableData = null;
			$posItableData = array( "result"          => "Update itable success");
			$resultJson[] = $posItableData;
		} catch(Exception $e){
			$posItableData = null;
			$posItableData = array( "result"          => "Update false");
			$resultJson[] = $posItableData;
		}
		

		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;

	}


	//Lay tat ca cac ban trong tang

	/**
	 * @param PosStageITable $posStageITable
	 * @return JsonResponse
	 * @ParamConverter("posStageITable", class="heyAutoDemoBundle:PosStageITable")
	 * GET TABLE ON A STAGE
	 * @Get("/rest/alltablesonastage/{id_stage}")
	 * Request parameters:
	 *
	 *
	 **/
	public function getAllTablesOnAStageJsonAction(Request $request) {
		$id_stage = $request->get('id_stage');
		$response = new JsonResponse();
		$postablesstage = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosStageITable' )->findAllTableByStageId ($id_stage);
		$resultJson = null;

		foreach($postablesstage as $postablestage) {

			$resultJson[] = $postablestage->toArray($id_stage);
		}

		$response->setData( $resultJson );
		return $response;
	}
	
	
}
