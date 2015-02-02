// <?php

// namespace heyAuto\DemoBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use FOS\UserBundle\Controller\SecurityController;
// use FOS\RestBundle\Controller\Annotations\View;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
// use heyAuto\DemoBundle\Entity\User;
// use heyAuto\DemoBundle\Entity\Vehicle;

// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Doctrine\Common\Persistence\ObjectManager;
// use Symfony\Component\HttpFoundation\Request;
// use FOS\UserBundle\Security\UserProvider;
// use heyAuto\DemoBundle\Crypto\MCrypt;
// use Monolog\Logger;
// use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
// use Symfony\Component\Serializer\Encoder\JsonEncoder;
// use JMS\Serializer\Annotation\Type;
// use FOS\RestBundle\Controller\Annotations\Post;
// use FOS\RestBundle\Controller\Annotations\Patch;
// use FOS\RestBundle\Controller\Annotations\Put;
// use FOS\RestBundle\Controller\Annotations\Get;

// /**
//  * 
//  * @author tien
//  */
// class UploadController extends Controller {


// 	/**
// 	 * UPLOAD IMAGE (via POST, PATCH or PUT)
// 	 * @Post("/rest/upload/profilePhoto")
// 	 * @Patch("/rest/upload/profilePhoto")
// 	 * @Put("/rest/upload/profilePhoto")
// 	 * oryginally: uploadPictureFromClientAction
// 	 **/
// 	public function uploadPictureFromClientAction(Request $request) {
		
// 		$logger = $this->get('logger');
// 		$response 		= new JsonResponse();
// 	    $imageFormat 	= $this->container->getParameter('images_format');

// 		if (isset($_FILES["imageProfile"])) {
// 		    move_uploaded_file($_FILES["imageProfile"]['tmp_name'],
// 		     $this->container->getParameter('upload_dir_profile'). $request->get('userid').$imageFormat);

// 			$responseMsg = array (
// 						'mSuccess' => true,
// 						'mErrorField' => null,
// 						'mMessage' => "Upload profile success!"
// 					);
// 	 	}else{
// 		 	$responseMsg = array (	
// 							'mSuccess' => false,
// 							'mErrorField' => "user's profile photo",
// 							'mMessage' => "Can not upload profile image!"
// 						);
// 	 	}
		
// 		$response->setData($responseMsg);
// 		return $response;
	    
        
// 	}	
	
// 	/**
// 	 * UPLOAD IMAGE (via POST, PATCH or PUT)
// 	 * @Post("/rest/upload/vehiclePhoto")
// 	 * @Patch("/rest/upload/vehiclePhoto")
// 	 * @Put("/rest/upload/vehiclePhoto")
// 	 * oryginally: uploadCarFromClientAction
// 	 **/
// 	public function uploadCarFromClientAction(Request $request) {
		
// 		$logger = $this->get('logger');
// 		$response 		= new JsonResponse();
// 		$imageFormat 	= $this->container->getParameter('images_format');

// 		if (isset($_FILES["imageCar"])) {
// 		    move_uploaded_file($_FILES["imageCar"]['tmp_name'],
// 		     $this->container->getParameter('upload_dir_car'). $request->get('userid').".jpg");

// 			$responseMsg = array (
// 				'mSuccess' => true,
// 				'mErrorField' => null,
// 				'mMessage' => "Upload car success!"
// 			);
// 	 	}else{
// 		 	$responseMsg = array (	
// 				'mSuccess' => false,
// 				'mErrorField' => "vehicle's photo",
// 				'mMessage' => "Can not upload car image!"
// 			);
// 	 	}
		
// 		$response->setData($responseMsg);
// 		return $response;
	    
        
// 	}
	

	
// }