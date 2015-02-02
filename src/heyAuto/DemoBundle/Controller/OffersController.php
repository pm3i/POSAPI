<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

use heyAuto\DemoBundle\Entity\Offer;
use heyAuto\DemoBundle\Entity\User;
use heyAuto\DemoBundle\Controller\BaseController;


/**
 * 
 * @author maser
 */
class OffersController extends BaseController {
	
	/**
	 *
	 * @return JsonResponse
	 * @Get("/rest/offers")
	 * @Get("/rest/offers/")
	 *
	 * GET OFFERS LIST
	 * ---------------
	 * Request parameters:
	 *	
	 *	no parameters 					- all offers will be fetched
	 *	@param integer $offererId 		- get offers for offererId
	 *  @param integer $offereeId 		- get offers for offereeId
	 *  @param integer $offererId, @param integer $offereeId 
	 *  								- (if offererId != offereeId) 
	 *  									=> get one offer with offererId and offereeId
	 *  								  (if offererId == offereeId  : AS userId)
	 *  									=> get offers where userId is offerer or offeree 
	 *  @param boolean $onlyOpened		- if true => get offers with status != STATUS_CLOSED
	 *  								  if false => get offers with any status
	 *  
	 *  @param integer $status			- get offers with specific status
	 *  
	 */
	public function getOffersJsonAction(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest: OffersController::getOffersJsonAction');
	
		$offererId = $request->get('mOffererId');
		$offereeId = $request->get('mOffereeId');
		$status = $request->get('mStatus');
		$onlyOpened = $request->get('onlyOpened');
		
		$offers = $this->getDoctrine()->getRepository ( 'heyAutoDemoBundle:Offer' )
			->findOfferBy(
					$offererId,
					$offereeId,
					$status,
			 		$onlyOpened
					);
		
		$resultJson = null;
		foreach($offers as $offer) {
			$resultJson[] = $offer->toArray();
		}
	
		$response = new JsonResponse();
		$response->setData( $resultJson );
		return $response;
	}
	
	/**
	 * 
	 * GET OFFER
	 * ---------------
	 * @Get("/rest/offers/{mOfferId}")
	 *
	 * @param integer $mOfferId
	 * 
	 * @return JsonResponse
	 *
	 **/
	public function getOfferAction( $mOfferId ) {
		$logger = $this->get('logger');
		$logger->debug('mastest: OffersController::getOfferAction');
		$response = new JsonResponse();
		
		$offer = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')
			->findOfferId( $mOfferId );
		if(!$offer){
			$errorRespondeData =  array (
					'mSuccess' 		=> false,
					'mErrorField' 	=> "mOfferId",
					'mMessage' 		=> "ERROR: There is no offer with specified id=".$mOfferId
			);
			$response->setData( $errorRespondeData );
		} else {
			$response->setData( $offer->toArray() );
		}
		
		return $response;
	}
	
	/**
	 *
	 * CREATE OFFER
	 * ----------------
	 * @Post("/rest/offers")
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 *
	 **/
	
	public function createOfferAction(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest: OffersController::createOfferAction');
		
// 		$this->debugRequest($request);
		
		$response = new JsonResponse();
		$offer = new Offer();
	
		
		//TODO add token funcionality provided by offerer, to prevent creating offers by non users
		
		$offererId = $request->get('mOffererId');
		$offereeId = $request->get('mOffereeId');
		$pickupLoclat = $request->get('mPickupLoclat');
		$pickupLoclng = $request->get('mPickupLoclng');
		$destLoclat = $request->get('mDestLoclat');
		$destLoclng = $request->get('mDestLoclng');
		$status = $request->get('mStatus');
// 		$expirationDate = $request->get('mExpirationDate');
// 		$expirationCounter = $request->get('mExpirationCounter');
		
		if( $offererId != null) {
			$offerer = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->find( $offererId );
			$offer->setOfferer($offerer);
			
			if( $offerer == null ) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => "mOfferer",
						'mMessage' => "Given offererId doesn't exist in database"
				);
				$response->setData($responseMsg);
				return $response;
			}
		}
		
		if( $offereeId != null) {
			$offeree = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->find( $offereeId );
			$offer->setOfferee($offeree);
			
			if( $offeree == null ) {
				$responseMsg =  array (
						'mSuccess' => false,
						'mErrorField' => "mOfferee",
						'mMessage' => "Given offereeId doesn't exist in database"
				);
				$response->setData($responseMsg);
				return $response;
			}
			
		}
		
// 		$offerWithSameSides = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')
// 			->findOneByOffererIdAndOffereeId($offererId, $offereeId);
		
		$activeOfferWithSameSides = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')
			->findOfferBy( $offererId, $offereeId, null, true);
		
		if( $activeOfferWithSameSides != null ) {
			$responseMsg =  array (
					'mSuccess' => false,
					'mErrorField' => "mOfferer and mOfferee",
					'mMessage' => "Offer from this offerer to this offeree already exists in database"
			);
			$response->setData($responseMsg);
			return $response;
		}
		
		
		$offer->setPickupLocLat($pickupLoclat);
		$offer->setPickupLocLng($pickupLoclng);
		$offer->setDestLocLat($destLoclat);
		$offer->setDestLocLng($destLoclng);
		$offer->setStatus($status);
		
		$fieldName = "mExpirationCounter";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_INT_POSITIVE,
				$this::$CONVERTER_NO_CONVERSION);
		if( !$success ) {
			return $this->getErrorJsonResponse($fieldName, "Wrong value given");
		}
		$logger->debug('mastest: OffersController::createOfferAction $expirationCounter='.$request->get('mExpirationCounter'));
		
		$logger->debug('mastest: OffersController::createOfferAction $expirationCounter='.$offer->getExpirationCounter());
		
		
		$currentDate = new \DateTime();
		$offer->setCreatedAtDate($currentDate);
		$logger->debug('mastest: OffersController::createOfferAction created at date='.$currentDate->format('Y-m-d H:i:s'));
		
		$expirationDate = new \DateTime();
		$expirationDate->add(new \DateInterval("PT".$offer->getExpirationCounter()."S"));
		$offer->setExpirationDate($expirationDate);
		$logger->debug('mastest: OffersController::createOfferAction expirationDate='.$expirationDate->format('Y-m-d H:i:s'));
		
		$responseMsg = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')->createNewOffer($offer);
		
		$response->setData($responseMsg);
		return $response;
	}
	

	/**
	 *
	 * UPDATE OFFER (via POST, PATCH or PUT)
	 * ----------------
	 * @Post("/rest/offers/{mOfferId}")
	 *
	 * @param integer $mOfferId
	 * 
	 * @return JsonResponse
	 **/
	
	public function updateOfferAction($mOfferId, Request $request) {
		$logger = $this->get('logger');
		$loggerReferer = "mastest: OffersController::updateOfferAction ";
		
		$logger->debug('mastest: OffersController::updateOfferAction, offerId='.$mOfferId);
		
		$this->debugRequest($request);
		
		$response = new JsonResponse();
		
	//---------	get offer with specified id from db  ------------------
		
		$offer = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')
			->findOfferId( $mOfferId );
		
		$fieldName = "mOfferId";
		$errorMsg = "ERROR: There is no offer with specified id=".$mOfferId;
		if(!$offer){
			$errorRespondeData =  array (
					'mSuccess' => false,
					'mErrorField' => $fieldName,
					'mMessage' => $errorMsg
			);
			$response->setData( $errorRespondeData );
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
	//---------	confirm if token belongs to offerer or offeree ------------------
		$token = $request->get('mToken');
		$success = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')
			->verifyIfTokenBelongsToOffererOrOfferee($offer, $token);
		
		$fieldName = "mToken";
		$errorMsg = "ERROR: Incorrect token provided";
		if( !$success ){
			$responseMsg =  array (
					'mSuccess' => false,
					'mErrorField' => $fieldName,
					'mMessage' => $errorMsg );
			
			$response->setData($responseMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
	//---------------------------------------------------------------------------------
	// updating fields:
	//---------------------------
		
		// non std fields ---------------------------------
		
	 	$fieldName = "mOffereeId";
		$errorMsg1 = "ERROR: Offeree can't be the same as offerer";
		$errorMsg2 = "ERROR: Offeree with this id doesn't exist";
		$offereeId = $request->get($fieldName);
		if( !empty($offereeId) && ($offereeId == $offer->getOfferer()->getId())) {
	 		return $this->getErrorJsonResponse($fieldName, $errorMsg1);
	 	}
		 
		if( !empty($offereeId) ) {
			/* @var $offeree User */
			$offeree = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->find( $offereeId );
			if ( $offeree ) {
				$offer->setOfferee($offeree);
			} else {
				$response = $this->getErrorJsonResponse($fieldName, $errorMsg2);
				$logger->debug($loggerReferer.$fieldName.", ".$errorMsg2);
				return $response;
			} 
		}
		
		
		// std fields -----------------------------------
		
		$fieldName = "mExpirationDate";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_DATE,
				$this::$CONVERTER_DATE_2_DATETIME);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		

		$fieldName = "mStatus";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_OFFER_STATUS,
				$this::$CONVERTER_NO_CONVERSION);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
		$fieldName = "mPickupLocLat";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}

		
		$fieldName = "mPickupLocLng";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
		$fieldName = "mDestLocLat";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDestLocLng";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDistCovered";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mPassengerRating";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_INT_POSITIVE);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDriverRating";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_INT_POSITIVE);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
		//--- updating offer in db
		$offer->toString();
		$success = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')->updateOffer($offer);
		
		//--- returning json response
		if( $success ) {
			$responseMsg =  array (
					'mSuccess' => true,
					'mErrorField' => null,
					'mMessage' => "Offer id(".$mOfferId.") has been successfully updated");
		} else {
			$responseMsg =  array (
					'mSuccess' => false,
					'mErrorField' => 'offerId',
					'mMessage' => "ERROR updating offer id(".$mOfferId."). Offer with this id doesn't exist");
		}
		$response->setData($responseMsg);
		$logger->debug($loggerReferer.print_r($responseMsg,1));
		return $response;
		
		
		
	}
	
	
	/**
	 *
	 * CLOSE OFFER (via POST, PATCH or PUT)
	 * ----------------
	 * @Post("/rest/offers/{mOfferId}/close")
	 *
	 * @param integer $mOfferId
	 *
	 * @return JsonResponse
	 **/
	
	public function closeOfferAction($mOfferId, Request $request) {
		$logger = $this->get('logger');
		$loggerReferer = "mastest: OffersController::closeOfferAction ";
		
		$logger->debug('mastest: OffersController::closeOfferAction, offerId='.$mOfferId);
		
		$this->debugRequest($request);
		
		$response = new JsonResponse();
		
	//---------	get offer with specified id from db  ------------------
		
		$offer = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')
			->findOfferId( $mOfferId );
		
		$fieldName = "mOfferId";
		$errorMsg = "ERROR: There is no offer with specified id=".$mOfferId;
		if(!$offer){
			$errorRespondeData =  array (
					'mSuccess' => false,
					'mErrorField' => $fieldName,
					'mMessage' => $errorMsg
			);
			$response->setData( $errorRespondeData );
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
	//---------	confirm if token belongs to offerer or offeree ------------------
		$token = $request->get('mToken');
		$success = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')
			->verifyIfTokenBelongsToOffererOrOfferee($offer, $token);
		
		$fieldName = "mToken";
		$errorMsg = "ERROR: Incorrect token provided";
		if( !$success ){
			$responseMsg =  array (
					'mSuccess' => false,
					'mErrorField' => $fieldName,
					'mMessage' => $errorMsg );
			
			$response->setData($responseMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
	//---------------------------------------------------------------------------------
	// updating fields:
	//---------------------------
		
		// non std fields ---------------------------------
		
	 	$fieldName = "mOffereeId";
		$errorMsg1 = "ERROR: Offeree can't be the same as offerer";
		$errorMsg2 = "ERROR: Offeree with this id doesn't exist";
		$offereeId = $request->get($fieldName);
		if( !empty($offereeId) && ($offereeId == $offer->getOfferer()->getId())) {
	 		return $this->getErrorJsonResponse($fieldName, $errorMsg1);
	 	}
		 
		if( !empty($offereeId) ) {
			/* @var $offeree User */
			$offeree = $this->getDoctrine()->getRepository('heyAutoDemoBundle:User')->find( $offereeId );
			if ( $offeree ) {
				$offer->setOfferee($offeree);
			} else {
				$response = $this->getErrorJsonResponse($fieldName, $errorMsg2);
				$logger->debug($loggerReferer.$fieldName.", ".$errorMsg2);
				return $response;
			} 
		}
		
		
		// std fields -----------------------------------
		
		$fieldName = "mExpirationDate";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_DATE,
				$this::$CONVERTER_DATE_2_DATETIME);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mPickupLocLat";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}

		
		$fieldName = "mPickupLocLng";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		
		$fieldName = "mDestLocLat";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDestLocLng";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDistCovered";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_FLOAT);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mPassengerRating";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_INT_POSITIVE);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		$fieldName = "mDriverRating";
		$errorMsg = "ERROR: Wrong value given";
		$success = $this->updateObjectValue(
				$offer,
				$fieldName,
				$request->get($fieldName),
				$this::$VALIDATOR_INT_POSITIVE);
		if( !$success ) {
			$response = $this->getErrorJsonResponse($fieldName, $errorMsg);
			$logger->debug($loggerReferer.$fieldName.", ".$errorMsg);
			return $response;
		}
		
		//--- close offer
		if( $offer->getStatus() != Offer::$STATUS_CLOSED ){
			$offer->setClosedWithStatus( $offer->getStatus() );
			$offer->setStatus( Offer::$STATUS_CLOSED );
		}

		$currentDate = new \DateTime();
		$offer->setClosedAtDate($currentDate);
		
		//--- updating offer in db
		$offer->toString();
		$success = $this->getDoctrine()->getRepository('heyAutoDemoBundle:Offer')->updateOffer($offer);
		
		//--- returning json response
		if( $success ) {
			$responseMsg =  array (
					'mSuccess' => true,
					'mErrorField' => null,
					'mMessage' => "Offer id(".$mOfferId.") has been successfully closed");
		} else {
			$responseMsg =  array (
					'mSuccess' => false,
					'mErrorField' => 'mOfferId',
					'mMessage' => "ERROR closing offer id(".$mOfferId."). Offer with this id doesn't exist");
		}
		$response->setData($responseMsg);
		$logger->debug($loggerReferer.print_r($responseMsg,1));
		return $response;
		
		
		
	}
	
}