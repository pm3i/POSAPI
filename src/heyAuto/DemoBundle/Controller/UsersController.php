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
use heyAuto\DemoBundle\Entity\Offer;
use heyAuto\DemoBundle\Entity\PosUser;

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
use Symfony\Component\HttpFoundation\Session\Session;
use heyAuto\DemoBundle\Form\Type\AccountFormType;
use heyAuto\DemoBundle\Form\Type\RideFormType;
use heyAuto\DemoBundle\Form\Type\UserFormType;
use heyAuto\DemoBundle\Form\Type\VehicleFormType;
use heyAuto\DemoBundle\Form\Type\OfferFormType;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * 
 * @author maser
 */
class UsersController extends BaseController {
	
	/**
	 *
	 * @return array
	 * @View()
	 * GET USERS LIST
	 * @Get("/rest/users.html")
	 */
	public function getUsersAction() {
		$logger = $this->get('logger');
// 		$logger->debug('mastest: UsersController::getUsersAction');
		
		$users = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:User' )->findAll ();
		return array (
				'users' => $users 
		);
	}

	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/posuser")
	 *
	 * GET VEHICLES LIST
	 * ---------------
	 * Request parameters:
	 *
	 *
	 */
	public function getLogPosJsonAction(Request $request) {
		//$logger = $this->get('logger');
		//$logger->debug('mastest: VehiclesController::getVehiclesJsonAction');
	
		$logposs = $this->getDoctrine()->getRepository ( 'heyAutoDemoBundle:PosUser' )->findAll();

		$resultJson = null;
		foreach($logposs as $logpos) {
			$resultJson[] = $logpos->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}
	
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/users")
	 * 
	 * GET USERS LIST
	 * ---------------
	 * Request parameters:
	 * 
	 * online { empty value - all users are fetched;
	 * 			0, false	- all users are fetched;
	 * 			1, true		- only online users are fetched; }
	 * 
 	 * role   { empty value 					- all users are fetched;
 	 * 			User::$HEYAUTO_ROLE_ANY 		- all users are fetched;
 	 * 			$HEYAUTO_ROLE_PASSENGER			- only passengers are fetched;
 	 * 			$HEYAUTO_ROLE_DRIVER			- only drivers are feteched;
	 * 			$HEYAUTO_ROLE_PASS_BY_DRIVER 	- only pass-by drivers are fetched;
	 * 			$HEYAUTO_ROLE_TAXI_DRIVER		- only taxi drivers are fetched; }
	 * 
	 */
	public function getUsersJsonAction(Request $request) {
		$logger = $this->get('logger');
// 		$logger->debug('mastest UsersController::getUsersJsonAction');
		
		
		$online = $request->get('mOnline');
		$role = $request->get('mRole');
		
		if( !empty($online) && filter_var($online, FILTER_VALIDATE_BOOLEAN)) {
			$users = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:User' )->findOnlineUsersWithRole($role);
			
		}  else {
			$users = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:User' )->findUsersWithRole($role);
		}

		$userJson = null;
		foreach($users as $user) {
			$userJson[] = $user->toArray(User::$USER_DATA_ARRAY_FULL);
		}
		
		$response = new JsonResponse();
		$response->setData( $userJson );
		return $response;
	}
	
	
	/**
	 * @param User $user
	 * @return JsonResponse
	 * @ParamConverter("user", class="heyAutoDemoBundle:User")
	 * GET USER
	 * @Get("/rest/users/{user}")
	 **/
	public function getUserAction(User $user) {
		$logger = $this->get('logger');
		$logger->debug('mastest UsersController::getUserAction');
		$response = new JsonResponse();
		$response->setData( $user->toArray(User::$USER_DATA_ARRAY_FULL) );
		
		return $response;
	}
		

	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 * 
	 * CREATE USER
	 * @Post("/rest/users")
	 * oryginally: postUserAction
	 **/
	 
	public function createUserAction(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest UsersController::createUserAction');
		$user = new User();
		
		$name = $request->get('mName');
		$password = $request->get('mPassword');
		$email = $request->get('mEmail');
		$phoneNo = $request->get('mPhoneNo');

		$fullname = $request->get('mFullName');
		$gender = $request->get('mGender');
		$birthYear = $request->get('mBirthYear');

		$logger->debug('vutest: ' . $fullname);
		$logger->debug('vutest: ' . $gender);
		$logger->debug('vutest: ' . $birthYear);

		// Vu: add fullname, gender, birthyear to db....
		$user->setFullName( $fullname );
		$user->setGender( $gender );
		$user->setBirthYear( $birthYear );
				
		$user->setUsername( $name );
		$user->setUsernameCanonical( $name );
		
		$encoder      = $this->get('security.encoder_factory')->getEncoder($user);
		$encoded_pass = $encoder->encodePassword($password, $user->getSalt());
		
		$user->setPassword( $encoded_pass );
		$user->setEmail( $email );
		$user->setEmailCanonical( $email );
		$user->setPhoneNo( $phoneNo );		
		
		$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->createNewUser($user);	
		
		
		$response = new JsonResponse();
		$response->setData($responseMsg);
		return $response;
	}
	

	/**
	 * UPDATE USER (via POST, PATCH or PUT)
	 * @ParamConverter("user", class="heyAutoDemoBundle:User")
	 * @Post("/rest/users/{user}")
	 * @Patch("/rest/users/{user}")
	 * @Put("/rest/users/{user}")
	 **/
	public function updateUserAction(User $user, Request $request) {
		
		$logger = $this->get('logger');
		$logger->debug('tientest UsersController::updateUserAction');
		$this->debugRequest($request); // --> It causes error 500: can't update user in android
		
		$response = new JsonResponse();
		//confirm token sent by client via request with user's token from database
		$token = $request->get('mToken');
		if($user->getConfirmationToken() != $token) {
			$responseMsg = array (
					'mSuccess' => false,
					'mErrorField' => 'mToken',
					'mMessage' => "Incorrect token provided");
			$response->setData($responseMsg);
			return $response;
		}
		
		$isAnythingToUpdate = false;

		$username = $request->get('mName');
		if( !empty($username) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').username =>'.$username);
			
			$dbUser = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserByName($username);
			if($dbUser == null) {
				$user->setUsername($username);
				$user->setUsernameCanonical($username);
				$isAnythingToUpdate = true;
			} elseif ($dbUser->getId() == $user->getId() ) {
				
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mName',
						'mMessage' => "New name equals current one. No need to update.");
				$response->setData($responseMsg);
				return $response;
				
			} else {
				
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mName',
						'mMessage' => "User with that name already exists in database");
				$response->setData($responseMsg);
				return $response;
				
			}
		}

		 /*set password if changed*/
		$decodedPassword = $request->get('mPassword');
        if(!empty( $decodedPassword)) {
        	$encoder      = $this->get('security.encoder_factory')->getEncoder($user);
            $encoded_pass = $encoder->encodePassword( $request->get('mPassword'), $user->getSalt());
      		$user->setPassword($encoded_pass);
      		$isAnythingToUpdate = true;
      	}
	
		$phoneNo = $request->get('mPhoneNo');

		if( !empty($phoneNo) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').phoneNo =>'.$phoneNo);
			
			$dbUser = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserByPhoneNo($phoneNo);
			if($dbUser == null) {
				$user->setPhoneNo($phoneNo);
				$isAnythingToUpdate = true;
			} elseif ($dbUser->getId() == $user->getId() ) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mPhoneNo',
						'mMessage' => "New phone no. equals current one. No need to update.");
				$response->setData($responseMsg);
				return $response;
			
			} else {
			
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mPhoneNo',
						'mMessage' => "User with that phone no. already exists in database");
				$response->setData($responseMsg);
				return $response;
			
			}
			
		}
	
		$email = $request->get('mEmail');
		
		if( !empty($email) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').email =>'.$email);
			
			$dbUser = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserByEmail($email);
			if($dbUser == null) {
				$user->setEmail($email);
				$user->setEmailCanonical($email);
				$isAnythingToUpdate = true;
			} elseif ($dbUser->getId() == $user->getId() ) {
			
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mEmail',
						'mMessage' => "New email address equals current one. No need to update.");
				$response->setData($responseMsg);
				return $response;
			
			} else {
			
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mEmail',
						'mMessage' => "User with that email address already exists in database");
				$response->setData($responseMsg);
				return $response;
			
			}
			
		}
				
		$online = strtolower($request->get('mOnline'));
		// $logger->debug('mastest2: updating user('.$user->getUsername().') req.online=<'.$online.'>');
		if( $online != null ) {
			// $logger->debug('mastest2: updating user('.$user->getUsername().') req.online !=null');
			
			if ($online == true ||
				$online == false ||
				$online == 'true' ||
				$online == 'false' ||
				$online == '1' ||
				$online == '0' ||
				$online == 1 ||
				$online == 0) {
					// $logger->debug('mastest: updating user('.$user->getUsername().').online =>'.$online);
					$boolOnline = filter_var($online, FILTER_VALIDATE_BOOLEAN);
					$user->setOnline($boolOnline);
					$isAnythingToUpdate = true;
				} else {
					$responseMsg =  array (
							'mSuccess' => false,
							'mErrorField' => 'mOnline',
							'mMessage' => "Not a boolean value given");
					$response->setData($responseMsg);
					return $response;
				}
		}
	
		$active = strtolower($request->get('mActive'));
		// $logger->debug('mastest2: updating user('.$user->getUsername().') req.active ='.$active);
		
		if( $active != null ) {
			if ($active == 'true' ||
					$active == 'false' ||
					$active == '1' ||
					$active == '0') {
						// $logger->debug('mastest: updating user('.$user->getUsername().').active =>'.$active);
						$boolActive = filter_var($active, FILTER_VALIDATE_BOOLEAN);
						$user->setActive($boolActive);
						$isAnythingToUpdate = true;
					} else {
						$responseMsg =  array (
								'mSuccess' => false,
								'mErrorField' => 'mActive',
								'mMessage' => "Not a boolean value given");
						$response->setData($responseMsg);
						return $response;
					}
		}
		
		$lat = $request->get('mLocLat');
		if( !empty($lat) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').latitude =>'.$lat);
			$user->setCurrentLocLat($lat);
			$isAnythingToUpdate = true;
		}
	
		$lng = $request->get('mLocLng');
		if( !empty($lng) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').longitude =>'.$lng);
			$user->setCurrentLocLng($lng);
			$isAnythingToUpdate = true;
		}
	
		$role = $request->get('mRole');
		if( !empty($role) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').role =>'.$role);
			if( !in_array($role, User::getHeyAutoRoles()) ) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mRole',
						'mMessage' => "Wrong value given");
				$response->setData($responseMsg);
				return $response;
			}
			
			$user->setRole($role);
			$isAnythingToUpdate = true;
		}
		
		
		$gender = $request->get('mGender');
		if( !empty($gender) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').gender =>'.$gender);
			if( !in_array($gender, User::getGenders()) ) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mGender',
						'mMessage' => "Wrong value given");
				$response->setData($responseMsg);
				return $response;
			}
				
			$user->setGender($gender);
			$isAnythingToUpdate = true;
		}
		
		$birthYear = $request->get('mBirthYear');
		if( !empty($birthYear) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').birthYear =>'.$birthYear);
			$user->setBirthYear($birthYear);
			$isAnythingToUpdate = true;
		}
		
		$fullName = $request->get('mFullName');
		if( !empty($fullName) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').username =>'.$username);
			
			$dbUser = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserByFullName($fullName);
			if($dbUser == null) {
				$user->setFullName($fullName);
				$isAnythingToUpdate = true;
			} elseif ($dbUser->getId() == $user->getId() ) {
				
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mFullName',
						'mMessage' => "New name equals current one. No need to update.");
				$response->setData($responseMsg);
				return $response;
				
			} else {
				
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => 'mFullName',
						'mMessage' => "User with that fullname already exists in database");
				$response->setData($responseMsg);
				return $response;
				
			}
			
		}
		
		$userRatingsCount = $request->get('mUserRatingsCount');
		if( !empty($userRatingsCount) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').userRatingsCount =>'.$userRatingsCount);
			$user->setUserRatingsCount($userRatingsCount);
			$isAnythingToUpdate = true;
		}
		
		$userRatingsAvg = $request->get('mUserRatingsAvg');
		if( !empty($userRatingsAvg) ) {
			// $logger->debug('mastest: updating user('.$user->getUsername().').userRatingsAvg =>'.$userRatingsAvg);
			$user->setUserRatingsAvg($userRatingsAvg);
			$isAnythingToUpdate = true;
		}

		//TODO verify if it shouldn't been done by vehicleController
		$isVehicleToUpdate = strtolower($request->get('isVehicleToUpdate'));
		if( filter_var($isVehicleToUpdate, FILTER_VALIDATE_BOOLEAN) && 
			$isVehicleToUpdate == true ) {
				$isAnythingToUpdate = true;
			}
		
		$offersSent = $request->get('mOffersSent');
		if (count($offersSent)>0) {
			$isAnythingToUpdate = true;
		}
		
		// $logger->debug('mastest: UsersController:: isAnythingToUpdate='.$isAnythingToUpdate);
		if(!$isAnythingToUpdate) {
			$responseMsg = array (
						'mSuccess' => false,
						'mErrorField' => null,
						'mMessage' => "Nothing to update");
		} else {
			
			
			// $logger->debug('mastest: UsersController:: updating user:');
			// $logger->debug('mastest: UsersController:: name='.$user->getUsername());
			// $logger->debug('mastest: UsersController:: email='.$user->getEmail());
			// $logger->debug('mastest: UsersController:: password='.$user->getPassword());
			// $logger->debug('mastest: UsersController:: phoneNo='.$user->getPhoneNo());
			// $logger->debug('mastest: UsersController:: locLat='.$user->getCurrentLocLat());
			// $logger->debug('mastest: UsersController:: locLng='.$user->getCurrentLocLng());
			// $logger->debug('mastest: UsersController:: active='.$user->isActive());
			// $logger->debug('mastest: UsersController:: online='.$user->isOnline());
				
			
			
			$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->updateUser($user);
		}
		
		$response->setData($responseMsg);
		return $response;
	}

	/**
	 * @return JsonResponse
	 * LOGIN USER
	 * @Post("/rest/login")
	 */
	public function loginUserAction(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest UsersController::loginUserAction');
		
		
		$response = new JsonResponse();
		$errorResponseMsg =  array (
				'mSuccess' => false,
// 				'token' => 'null',
				'mMessage' => "Wrong credentials");
		
		$name = $request->get('mName');
		$encryptedPassword = $request->get('mPass');
		$logger->debug('mastest encryptedPassword='.$encryptedPassword);
		
		if( !empty($name) && !empty($encryptedPassword)) {
			$mcrypt = new MCrypt();
			$password = $mcrypt->decrypt($encryptedPassword);
			$logger->debug('mastest decryptedPassword='.$password);
			
// PASSWORD ENCRYPTION MOCK
// for testing purposes uncomment line below. Then plain password can be given in request
// 			$password = $encryptedPassword;

		} else {
			$response->setData($errorResponseMsg);
			
			return $response;
		}
		 
		$encoded_pass = null;
		 
		$user = $this->get('fos_user.user_manager')->findUserByUsername($name);
		if (null === $user) {
			// 	    	echo "no user with that name in db!\n";
			$response->setData($errorResponseMsg);
			return $response;
		} else {
			 
			$encoder      = $this->get('security.encoder_factory')->getEncoder($user);
			$encoded_pass = $encoder->encodePassword($password, $user->getSalt());
		}
		 
		
// 		$logger->debug('mastest: UsersController:: logging user:');
// 		$logger->debug('mastest: UsersController:: name='.$name);
// 		$logger->debug('mastest: UsersController:: encryptedPassword='.$encryptedPassword);
// 		$logger->debug('mastest: UsersController:: password='.$password);
// 		$logger->debug('mastest: UsersController:: encoded_pass='.$encoded_pass);
		
		
		if( !$name == null && !$encoded_pass == null ){
			$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->loginUser($name, $encoded_pass);
			$response->setData($responseMsg);
			return $response;
		} else {
			$response->setData($errorResponseMsg);
			return $response;
		}
		 
	}
}
