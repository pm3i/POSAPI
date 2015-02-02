<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use heyAuto\DemoBundle\Entity\User;
use heyAuto\DemoBundle\Entity\Vehicle;
use heyAuto\DemoBundle\Entity\Pos_logpos;

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

/**
 * 
 * @author maser
 */
class VehiclesController extends Controller {
	
/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/vehicles")
	 *
	 * GET VEHICLES LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getVehiclesJsonAction(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest: VehiclesController::getVehiclesJsonAction');
	
		$vehicles = $this->getDoctrine()->getRepository ( 'heyAutoDemoBundle:Vehicle' )->findAll();

		$resultJson = null;
		foreach($vehicles as $vehicle) {
			$resultJson[] = $vehicle->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}

	

	/**
	 * UPDATE VEHICLE (via POST, PATCH or PUT)
	 * @ParamConverter("user", class="heyAutoDemoBundle:User")
	 * @Post("/rest/vehicles/{user}")
	 * @Patch("/rest/vehicles/{user}")
	 * @Put("/rest/vehicles/{user}")	
	 **/
	public function updateVehicleAction(Request $request, $user) {

		$logger = $this->get('logger');
		$logger->debug('>>>>>>>>>>>>>>>>>>>: updating vehicle' );
		$response = new JsonResponse();
		$isAnythingToUpdate = false;
		$u = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserById($user->getId());

		if( $u->getVehicles()!= null && count($u->getVehicles())>0) {
			$vehicle = $u->getVehicles()->get(0);
			
      	}else{
      		$vehicle = new Vehicle();
      		$vehicle->setUser($user);
      	}

		
		$make = $request->get('mMake');
		if( !empty($make) ) {
			$vehicle->setMake($make);
			$isAnythingToUpdate = true;
		}
		
		$model = $request->get('mModel');
		if( !empty($model) ) {
			$vehicle->setModel($model);
			$isAnythingToUpdate = true;
		}
		
		$color = $request->get('mColor');
		if( !empty($color) ) {
			$vehicle->setColor($color);
			$isAnythingToUpdate = true;
		}

		$year = $request->get('mYear');
		if( !empty($year) ) {
			$vehicle->setYear($year);
			$isAnythingToUpdate = true;
		}
		
		$registrationNo = $request->get('mRegistrationNo');
		if( !empty($registrationNo) ) {
			$vehicle->setRegistrationNo($registrationNo);
			$isAnythingToUpdate = true;
		}

		if(!$isAnythingToUpdate) {
			$responseMsg = array (
						'mSuccess' => false,
						'mErrorField' => null,
						'mMessage' => "Nothing to update");
		} else {

			$responseMsg = $this->getDoctrine()->getRepository(
				'heyAutoDemoBundle:Vehicle')->updateVehicle($vehicle);
		}
		
		$response->setData($responseMsg);
		return $response;
	}

	
}