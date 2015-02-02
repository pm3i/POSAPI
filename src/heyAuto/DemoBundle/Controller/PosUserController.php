<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\PosUsers;
use heyAuto\DemoBundle\Entity\PosCompany;
use heyAuto\DemoBundle\Entity\PosUserGroupMap;
use heyAuto\DemoBundle\Entity\PosStage;

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
class PosUserController extends Controller {
	
/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/posuser")
	 *
	 * Check login User
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function checkLoginJsonAction(Request $request) {
		
		//$vehicles = $this->getDoctrine()->getRepository ( 'heyAutoDemoBundle:PosUsers' )->findAll();
		$mUsername='adminsg';
		$mPassword= md5(utf8_encode('123'));
		$mCompanyCode='NHSG';

		$users = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosUsers' )
				->getUserForIdPassCompanyCode($mUsername, $mPassword, $mCompanyCode);

		$resultJson = null;
		foreach($users as $user) {

			$titles = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosUsers' )->getTitleForUser($user->getId());
			if (!empty($titles)){
				$user->setTitle($titles[0]->getTitle());	
			}else {
				$user->setTitle('client');
			}			
			
			$resultJson[] = $user->toArray();
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
	 * CREATE USER
	 * @Post("/rest/posuser")
	 * oryginally: postUserAction
	 **/
	 
	public function createPosUsersAction(Request $request) {
		$posUsers = new PosUsers();
		$posCompany = new PosCompany();
		$posUserGroupMap = new PosUserGroupMap();
		
		$username 		= 'symfony9';//$request->get('mUsername');
		$password 		= md5(utf8_encode('123'));//$request->get('mPassword');
		$email 			= 'a@a1.com';//$request->get('mEmail');
		$companyCode 	= 'NH278';//$request->get('mCompanyCode');

		$companyName	= 'Nha hang test 6';
		$phoneNumber	= '11111111111';
		$location		= 'Ha Noi';
		$lat 			= '1';
		$lon 			= '1';
		
		$now        	= new \DateTime();
		$now 			= $now->format('y-m-d H:m:s');
		$date 			= date_create($now);
		$now 			= date_format($date, 'Y-m-d H:i:s');

	
	/////// set data cho doi tuong Pos User  //////////
		$posUsers->setUsername( $username );
		$posUsers->setName( $username );
		//$encoder      = $this->get('security.encoder_factory')->getEncoder($user);
		//$encoded_pass = $encoder->encodePassword($password, $user->getSalt());
		$posUsers->setPassword( $password );
		$posUsers->setEmail( $email );	
		$posUsers->setCompanyCode($companyCode);
		$posUsers->setUsertype( '' );	
		$posUsers->setBlock(0);	
		$posUsers->setRegisterDate($now);
		$posUsers->setLastvisitDate($now);
		$posUsers->setLastResetTime($now);
		$posUsers->setParams(0);
		$posUsers->setResetCount(0);
		$posUsers->setActivation('');
		$posUsers->setSendEmail(0);
	/////////////////////////////////////////////////

	/////// set data cho doi tuong Pos Company  //////////
		$posCompany->setCompanyCode($companyCode);
		$posCompany->setCompanyname($companyName);
		$posCompany->setPhone($phoneNumber);
		$posCompany->setLocation($location);
		$posCompany->setLat($lat);
		$posCompany->setLon($lon);
		$posCompany->setEmail($email );
		$posCompany->setRadius(0);
	/////////////////////////////////////////////////////	

		//---Dang ky User---//
		$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosUsers')->createNewPosUsers($posUsers);	

		//---Dang ky Company---//
		$responseMsg1 = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosCompany')->createNewPosCompany($posCompany);	

		//---Lay user id---//
		/////// set data cho doi tuong Pos Company  //////////
		$posUsers = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosUsers')->getUserForIdPassCompanyCode($username, $password, $companyCode);
		foreach($posUsers as $posUser) {
			$posUserGroupMap->setUserId($posUser->getId());
		}
		$posUserGroupMap->setGroupId(7);
		$posUserGroupMap->setGroupMobileId(3);
		/////////////////////////////////////////////////////
		
		$responseMsg2 = $this->getDoctrine()->getRepository('heyAutoDemoBundle:PosUserGroupMap')->createNewPosUserGroupMap($posUserGroupMap);	
		
		$response = new JsonResponse();
		$response->setData($responseMsg2);
		return $response;
	}
	
	public function date_normalizer($d){ 
		if($d instanceof DateTime){
			 return $d->getTimestamp(); 
		} else { 
			return strtotime($d); 
		} 
	} 



		//lay tat ca thong tin nha hang khi login
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/poscompanys")
	 *
	 * GET POSCOMPANYS LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getPosCompanysJsonAction(Request $request) {
	
		//$vehicles = $this->getDoctrine()->getRepository ( 'heyAutoDemoBundle:PosUsers' )->findAll();
		// $mUsername='adminsg';
		// $mPassword= md5(utf8_encode('123'));
		// $mCompanyCode='NHSG';

		$posCompanys = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosCompany' )->findAll ();

		$resultJson = null;
		foreach($posCompanys as $posCompany) {			
			$resultJson[] = $posCompany->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}




	//find all pos_stage

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/allPosstages")
	 *
	 * GET POSCOMPANYS LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getAllPosStagesJsonAction(Request $request) {

		$posstages = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosStage' )->findAll ();
		

		$resultJson = null;
		foreach($posstages as $posstage) {			
			$resultJson[] = $posstage->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}
	

	/**
	 * @param PosStage $posstage
	 * @return JsonResponse
	 * GET POSSTAGE
	 * @Get("/rest/posstages")
	 **/
	public function getPosStagesJsonAction(Request $request) {

		$logger = $this->get('logger');
		$response = new JsonResponse();
		$posstages = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:PosStage' )->findStagebyStatus (1);
		//$logger->debug(">>>>>>>>>>>>>>>>>>:" . print_r($posstages));
		$resultJson = null;
		// echo count($posstages);
		foreach($posstages as $posstage) {

			$resultJson[] = $posstage->toArray(1);
		}

		$response->setData( $resultJson );
		return $response;
	}
	
}