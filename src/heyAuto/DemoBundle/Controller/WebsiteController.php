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
use Symfony\Component\Security\Core\SecurityContext;

/**
 * 
 * @author maser
 */
class WebsiteController extends Controller {
	
	/**
     * @Route("/index")
     * @Template()
     */
    public function homeAction() {

        $logger     = $this->get('logger');
        $users      = $this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:User' )->findAll();
            return $this->render('heyAutoDemoBundle:Homepage:homepage.html.twig', array('users' => $users )); 
    }

 	/**
     * @Route("/signin")
     * @Template()
     */
	public function signinAction(Request $request)
    {
        // $request = $this->getRequest();
        $session = $request->getSession();
        $session->remove(SecurityContext::LAST_USERNAME);
        // create default form data 
        $form = $this->createForm(new AccountFormType(), new User());
        $form->handleRequest($request);
       
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {

            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else if (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {

            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
            if($request->getMethod() == 'POST' && $form->isValid()) {
	        	// get form data
	            $name = $form["username"]->getData();
	            $pass = $form["password"]->getData();
	            
	            //-- encrypt password
	            $mcrypt = new MCrypt();
	            $encryptedPassword = $mcrypt->encrypt($pass);
	            
	            // get login check result
	            $this->getRequest()->request->set('mName', $name);
                $this->getRequest()->request->set('mPass', $encryptedPassword);
                
                /*try login and return results*/
                $result = $this->forward('heyAutoDemoBundle:Users:loginUser', array('request' => $request));
                
                /*check login results*/
	            $checkLogin = json_decode($result->getContent(), true)['mSuccess'];
	            if($checkLogin != null) {

		            $id 	= json_decode($result->getContent(), true)['mId'];
                    $user 	= $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->findUserById($id);http://dev.heyauto.pl/app_dev.php/signout
                    $session->set(SecurityContext::LAST_USERNAME, $name);
                    $session->save();
                    /*login successfully -> go back to home page*/
                    // redirect with GET syntax url
                    // $url = $this->generateUrl("home", array("key" => "value"));
                    // $this->redirect($url.'#comment');	// ?key=value#comment
                    $url = $this->generateUrl("home");
					return $this->redirect($url);
	            }else{
	            	$session->save();
	            	echo '<script type="text/javascript">alert("Username or password incorrect. Please enter again!");</script>';
	            	/*login failed -> show message*/

	            }
	        } 
        }

        return $this->render('heyAutoDemoBundle:Users:signin.html.twig', array('form' => $form->createView() ));
    }
	
 	/**
     * @Route("/signout")
     * @Template()
     */
    public function signoutAction() {

    	$request = $this->get('request');
    	$session = $request->getSession();
        $session->remove(SecurityContext::LAST_USERNAME);
        return $this->forward('heyAutoDemoBundle:Website:home');
    }

    /**
     * @Route("/")
     * @Template()
     */
    public function accountAction()
    {
        $request = $this->get('request');

        if((new Tools())->checkLogged($request)) {

	        /*back up some values of current user for check modify*/
	        $username 		= $request->getSession()->get(SecurityContext::LAST_USERNAME);
	        $user 			= $this->get('fos_user.user_manager')->findUserByUsername($username);
	        $email 			= $user->getEmail();
	        $phoneNo 		= $user->getPhoneNo();
	        $genderFromDb 	= $user->getGender();
	        $birthYear 		= $user->getBirthYear();
	        $fullName 		= $user->getFullName();
	        $password 		= $user->getPassword();
	        $token 			= $user->getConfirmationToken();
	        /*back up user's vahicles data*/
	        $vehicles 		= array();
	        foreach ($user->getVehicles() as $value) {
	        	$vehicle = array();

	      		array_push($vehicle, $value->getMake());
	      		array_push($vehicle, $value->getModel());
	      		array_push($vehicle, $value->getColor());
	      		array_push($vehicle, $value->getYear());
	      		array_push($vehicle, $value->getRegistrationNo());
	      		array_push($vehicles, $vehicle);
	      	}

	      	$vehicleForUserHaveCar = null;
        	$vehicleForUserNotCar = new Vehicle();
	        $vehicleForUserNotCar->setUser($user);

	         if(count($vehicles)<=0) { 
	          $em = $this->getDoctrine()->getEntityManager();
	          $em->merge($vehicleForUserNotCar);
	          $em->flush();
	          $user->addVehicle($vehicleForUserNotCar); 
	         }else {
	   			$vehicleForUserHaveCar = $vehicles[0];
	         }

	        $form = $this->createForm(new UserFormType(), $user);
	        $form->handleRequest($request);

	        if($request->getMethod() == 'POST' /*&& $form->isValid()*/) {

	        	/*when button save onclick*/
	        	if ($form->get('save')->isClicked()) {
	        		
	        		/*upload photo*/
	                $request->request->set('mToken', $token);
	                
	                /*set user info*/
	                $request->request->set('mUsername', $username); 
	                /*set email if changed*/
	                if($email != $form->get('email')->getData())
	                	$request->request->set('mEmail', $form->get('email')->getData()); 
	                /*set phoneno if changed*/
	                if($phoneNo != $form->get('phoneNo')->getData())
	                    $request->request->set('mPhoneNo',   $form->get('phoneNo')->getData());
	                /*set gender if changed*/
	                if($request->request->get('user_gender') == User::$GENDER_MALE)
	                	$genderFromForm = User::$GENDER_MALE;
	                else{ $genderFromForm = User::$GENDER_FEMALE; }
	                if($genderFromDb != $genderFromForm)
	                    $request->request->set('mGender', $genderFromForm);
	                /*set birthyear if changed*/
	                if($birthYear != $form->get('birthYear')->getData())
	                    $request->request->set('mBirthYear', $form->get('birthYear')->getData());
	                /*set fullname if changed*/
	                if($fullName != $form->get('fullName')->getData())
	                    $request->request->set('mFullName',  $form->get('fullName')->getData());
	                /*set password if changed*/
					$decodedPassword = $form->get('password')->getData();
	                if(!empty( $decodedPassword)) {
	                	$request->request->set('mPassword',  $decodedPassword);
		              	$user->setPassword($decodedPassword);
	              	}
	              	else { $user->setPassword($password); }

	              	$vehicleFromForm = $user->getVehicles()->get(0);
	              	if ( $vehicleForUserHaveCar[0] != $vehicleFromForm->getMake()  ||
	              		 $vehicleForUserHaveCar[1] != $vehicleFromForm->getModel() ||
	              		 $vehicleForUserHaveCar[2] != $vehicleFromForm->getColor() ||
	              		 $vehicleForUserHaveCar[3] != $vehicleFromForm->getYear() ||
	              		 $vehicleForUserHaveCar[4] != $vehicleFromForm->getRegistrationNo() ) {
	              		 	$request->request->set('isVehicleToUpdate', true);
	              	}
	              	
	              	
	              	
	              	//------------------------------------------------------//

	              	/*update user info*/
	                $result = $this->forward('heyAutoDemoBundle:Users:updateUser', 
	                    array(
	                        'user'      => $user,
	                        'request'   => $request,
	                    ));

	                /*upload photo*/
	                $this->updaloadPhoto($request, $form);

	                /*set refresh page*/
//TODO(Tien): - block below has been commented due to WebsiteControllerTest error
             		//$page = $_SERVER['PHP_SELF'];
 					//$sec = "0";
					//header("Refresh: $sec; url=$page");

	                /*check update result*/
	                if(json_decode($result->getContent(), true)['mSuccess']) {
	                	// get user data again
	                	// update form data (new user info) again
	                	/// go to successfully page here
		                return $this->render('heyAutoDemoBundle:Users:account.html.twig',
			                array(
			                    'form'      => $form->createView(),
			                    'mId'		=> $user->getId(),
			                    'mGender'	=> $form->getData()->getGender()
			                ));
	                }
	                else {
	                	/*go to anywhere if failed*/
	                	//echo 'update failed';
	                	//echo json_decode($result->getContent(), true)['message'];
	                	// return $this->render('heyAutoDemoBundle:Users:account.html.twig',
			               //  array(
			               //      'form'      => $form->createView(),
			               //      'username'  => $username,
			               //      'userid'	=> $user->getId(),
	                 //    		'gender'	=> $user->getGender()
			               //  ));
	                }
	            }
	        }
	        
	        return $this->render('heyAutoDemoBundle:Users:account.html.twig',
	                array(
	                    'form'      => $form->createView(),
	                    'mId'		=> $user->getId(),
	                    'mGender'	=> $user->getGender()
	                ));
    	} else {
        	$url = $this->generateUrl("signin");
			return $this->redirect($url);
		}
    }

    public function dumpStringAction() {
    	return $this->render('heyAutoDemoBundle:Users:dumpString.html.twig', array());
    }

    /**
     * @Route("/")
     * @Template()
     */
    public function myRidesAction(Request $request) {

    	$tools = new Tools();
    	/*get request*/
        // $request 	= $this->get('request');
        if($tools->checkLogged($request)) {

	        /*get user logging*/
	        $username 	= $request->getSession()->get(SecurityContext::LAST_USERNAME);
	        $user 		= $this->get('fos_user.user_manager')->findUserByUsername($username);
	        /*get info of user rides*/
	        $doShowRidesAsOfferer  	= true;
	        $doShowRidesAsOfferee  	= true;

	        $data 		= $this->getRidesInfo($user, $doShowRidesAsOfferer , $doShowRidesAsOfferee );
	    	/*receive data from request and update them into db*/
	    	if($request->getMethod() == 'POST') {

	    		if ($request->request->get('myrides_offerer') == 'on') { $doShowRidesAsOfferer  = true; }
				else { $doShowRidesAsOfferer  = false; }

				if ($request->request->get('myrides_offeree') == 'on') { $doShowRidesAsOfferee  = true; }
				else { $doShowRidesAsOfferee  = false; }

	    		/*button save rating onclick*/
	    		//if($request->request->has('myrides_save')) {
	    			/*update for offerers*/
				if($doShowRidesAsOfferer  == true) {
					for ($i=0; $i<count($data[0]); $i++) { 
						/*get offer by id*/
						$offer = $this->getDoctrine()->getRepository( 'heyAutoDemoBundle:Offer' )->findOfferId($data[0][$i][0]);
						$offer->setPassengerRating($request->request->get($data[0][$i][0]));
						/*update offer to db*/
						$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:Offer' )->updateOffer($offer);
					}}
				if($doShowRidesAsOfferee  == true) {
					for ($i=0; $i<count($data[1]); $i++) { 
						/*get offer by id*/
						$offer = $this->getDoctrine()->getRepository( 'heyAutoDemoBundle:Offer' )->findOfferId($data[1][$i][0]);
						$offer->setDriverRating($request->request->get($data[1][$i][0]));
						/*update offer to db*/
						$this->getDoctrine ()->getRepository ( 'heyAutoDemoBundle:Offer' )->updateOffer($offer);
					}}
				//}
				/*get new value of rating from db*/
				$data = $this->getRidesInfo($user);
	    	}
	    	/*render form*/
	    	return $this->render('heyAutoDemoBundle:Users:myrides.html.twig', 
	    		array(
	    			'data' => $data,
	    			'offerer' => $doShowRidesAsOfferer,
	    			'offeree' => $doShowRidesAsOfferee,
	    			));
    	} else {
        	$url = $this->generateUrl("signin");
			return $this->redirect($url);
		}
    }

    public function getRidesInfo(
    		$user, 
    		$includeOffersAsDriverRole = true, 
    		$includeOffersAsPassengerRole = true) {

    	$tools = new Tools();
    	$data_offeree	= array();
        $data_offerer	= array();
        $data 			= array();
        $CHECK_OPEN 	= false;

    	if($includeOffersAsPassengerRole == true) {
		    // for offerees
	    	$result_offeree = $this->forward('heyAutoDemoBundle:Offers:getOffersJson', array(
		                    $this->getRequest()->request->set('mOffererId', 	null),
		                    $this->getRequest()->request->set('mOffereeId', 	$user->getId()),
		                    $this->getRequest()->request->set('mStatus', 		null),
		                    $this->getRequest()->request->set('onlyOpened', 	$CHECK_OPEN),
		                ));
	    	// conver JsonResponse to array
	        $json_offeree = json_decode($result_offeree->getContent(), true);
	    	
	        if($json_offeree != null) {
	        	/* 
	        	. get id
	        	. get end date
	        	. calculate pickup address
	        	. calculate pickup destination
	        	. get rating by user role [drivers or passengers]
	        	*/
		        foreach ($json_offeree as $item) {
		        	
		        	$map_values = $tools->getDistance( 'mDriving', 
		        		$item['mPickupLocLat'], $item['mPickupLocLng'], 
		        		$item['mDestLocLat'], $item['mDestLocLng']);
		        	$tmp = array();
		        	array_push($tmp, $item['mId']);
		        	array_push($tmp, $item['mClosedAtDate']);
		        	array_push($tmp, $map_values[0] ); // get Distance
		        	array_push($tmp, $map_values[1] ); // get Pickup
		        	array_push($tmp, $map_values[2] ); // get Destination
		        	array_push($tmp, $item['mDriverRating']);

		        	array_push($data_offeree, $tmp);
		        }
	    	}
    	}


    	if($includeOffersAsDriverRole == true) {
		    // for offerers
	    	$result_offerer = $this->forward('heyAutoDemoBundle:Offers:getOffersJson', array(
		                    $this->getRequest()->request->set('mOffererId', 	$user->getId()),
		                    $this->getRequest()->request->set('mOffereeId', 	null),
		                    $this->getRequest()->request->set('mStatus', 		null),
		                    $this->getRequest()->request->set('onlyOpened', 	$CHECK_OPEN),
		                ));
		    
	    	$json_offerer 	= json_decode($result_offerer->getContent(), true);
	    	if($json_offerer != null) {
	        	/* 
	        	. get id
	        	. get end date
	        	. calculate pickup address
	        	. calculate pickup destination
	        	. get rating by user role [drivers or passengers]
	        	*/
		        foreach ($json_offerer as $item) {
		        	
		        	$map_values = $tools->getDistance( 'mDriving', 
		        		$item['mPickupLocLat'], $item['mPickupLocLng'], 
		        		$item['mDestLocLat'], $item['mDestLocLng']);
		        	$tmp = array();
		        	array_push($tmp, $item['mId']);
		        	array_push($tmp, $item['mClosedAtDate']);
		        	array_push($tmp, $map_values[0] ); // get Distance
		        	array_push($tmp, $map_values[1] ); // get Pickup
		        	array_push($tmp, $map_values[2] ); // get Destination
		        	array_push($tmp, $item['mPassengerRating']);

		        	array_push($data_offerer, $tmp);
		        }
	    	}
	    }
    	array_push($data, $data_offerer);
    	array_push($data, $data_offeree);

    	return $data;
    }

    /*upload Photo to directory server*/
    public function updaloadPhoto(Request $request, $form){
    	
    	$username 		= $request->getSession()->get(SecurityContext::LAST_USERNAME);
	    $user 			= $this->get('fos_user.user_manager')->findUserByUsername($username);
	    $userID         = $user->getId();
	    $maxSize 		= $this->container->getParameter('images_max_size');
	    $imageFormat 	= $this->container->getParameter('images_format');
       
        if (isset($_FILES["ProfileImgToUpload"]["name"])) {
        	$uploadDirProfile = $this->container->getParameter('upload_dir_profile');
            $target_file = $uploadDirProfile . basename($_FILES["ProfileImgToUpload"]["name"]);

            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $tmpProfileImgNameToUpload = $_FILES["ProfileImgToUpload"]["tmp_name"];
            if(!empty($tmpProfileImgNameToUpload)) {
            	 // Check file size
				if ($_FILES["ProfileImgToUpload"]["size"] > $maxSize) {
				    echo '<script type="text/javascript">alert("Sorry, your profile image is too large.");</script>';
				}else{
					$check = getimagesize($_FILES["ProfileImgToUpload"]["tmp_name"]);
	                if($check !== false) {
	                    //Writes the photo to the server  
	                    if(move_uploaded_file($_FILES['ProfileImgToUpload']['tmp_name'], 
	                    	$uploadDirProfile. $userID. $imageFormat)){ }  
	                    else{} 
	                } else {
	                	echo '<script type="text/javascript">alert("File is not an image.");</script>';
	                }
	                // Allow certain file formats
	                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	                && $imageFileType != "gif" ) {
	                	echo '<script type="text/javascript">alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
	                }
				}
            }

        }

        if (isset($_FILES["CarImgToUpload"]["name"])) {

        	$uploadDirCar = $this->container->getParameter('upload_dir_car');
            $target_file = $uploadDirCar . basename($_FILES["CarImgToUpload"]["name"]);
            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // echo $userID;
            $tmpCarImgNameToUpload = $_FILES["CarImgToUpload"]["tmp_name"];
            if(!empty($tmpCarImgNameToUpload)) {
            	if ($_FILES["CarImgToUpload"]["size"] > $maxSize) {
            		echo '<script type="text/javascript">alert("Sorry, your car image is too large.");</script>';
				}else{
	                $check = getimagesize($_FILES["CarImgToUpload"]["tmp_name"]);
	                if($check !== false) {
	                    //Writes the photo to the server  
	                    if(move_uploaded_file($_FILES['CarImgToUpload']['tmp_name'], 
	                    	$uploadDirCar. $userID. $imageFormat)){}  
	                    else{} 
	                } else {
	                	echo '<script type="text/javascript">alert("File is not an image.");</script>';
	                }
	                // Allow certain file formats
	                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	                && $imageFileType != "gif" ) {
	                	echo '<script type="text/javascript">alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
	                }
	            }
            }

        }
    }
}
