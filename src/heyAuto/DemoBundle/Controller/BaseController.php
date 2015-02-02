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
use heyAuto\DemoBundle\Entity\Offer;
use heyAuto\DemoBundle\Entity\Vehicle;

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
 * BaseController
 */
class BaseController extends Controller {
	
	public static $VALIDATOR_NO_VALIDATION			= 0;
	public static $VALIDATOR_INT	 				= 1;
	public static $VALIDATOR_INT_POSITIVE			= 2;
	public static $VALIDATOR_FLOAT	 				= 3;
	public static $VALIDATOR_DATE	 				= 4;
	public static $VALIDATOR_OFFER_STATUS			= 5;
	
	
	
	public static $CONVERTER_NO_CONVERSION			= 0;
	public static $CONVERTER_DATE_2_DATETIME		= 1;
	
	public function updateObjectValue(
			&$objectToUpdate, $fieldName, $fieldValue,
			$validator=0, $converter=0
	) {
	
		if( !empty($fieldValue) ) {
	
			// validate
			switch( $validator ) {
				case $this::$VALIDATOR_INT:
					if( !$this->isInt($fieldValue) ) {
						return false;
					}
					break;
				case $this::$VALIDATOR_INT_POSITIVE:
					if( !$this->isIntPositive($fieldValue) ) {
						return false;
					}
					break;
				case $this::$VALIDATOR_FLOAT:
					if( !$this->isFloat($fieldValue) ) {
						return false;
					}
					break;
				case $this::$VALIDATOR_DATE:
					if ( !$this->validateDate($fieldValue) ) {
						return false;
					}
					break;
				case $this::$VALIDATOR_OFFER_STATUS:
					if( !$this->isInt($fieldValue) ) {
						return false;
					}
					if( !in_array($fieldValue, Offer::getAvailableStatuses()) ) {
						return false;
					}
					break;
				case $this::$VALIDATOR_NO_VALIDATION:
					break;
				default:
					break;
			}
				
			// convert
			switch( $converter ) {
				case $this::$CONVERTER_DATE_2_DATETIME:
					$fieldValue = new \DateTime($fieldValue);
					$fieldValueStr = $fieldValue->format('Y-m-d H:i:s'); //used only for logging purposes
					break;
				case $this::$CONVERTER_NO_CONVERSION:
					$fieldValueStr = $fieldValue;
					break;
				default:
					$fieldValueStr = $fieldValue;
					break;
			}
				
			// log update action
			$logger = $this->get('logger');
				
			// --- update object
			
			// below creates setter method name for updating fieldName
			// if fieldName is in java member notation like i.e. mFieldName
			// then m i subtracted from setter method name
			if( $fieldName[0] == 'm') {
				$method = "set".ucfirst(substr($fieldName,1,strlen($fieldName)));
			} else {
				$method = "set".ucfirst($fieldName);
			}
			$logger->debug('mastest: updating object ['.get_class($objectToUpdate).'](id='.$objectToUpdate->getId().').'.$fieldName.' =>'.$fieldValueStr.' using method: '.$method.'()');
			$objectToUpdate->{$method}($fieldValue);
				
			return true;
				
		} else {
			// log update action
			$logger = $this->get('logger');
			$logger->debug('mastest: updating object ['.get_class($objectToUpdate).'](id='.$objectToUpdate->getId().').'.$fieldName.' => [not updating]');
				
			return true;
		}
			
	}
	
	
	public function getErrorJsonResponse($fieldName, $message) {
		$jsonResponse = new JsonResponse();
		$responseMsg =  array (
				'mSuccess' => false,
				'mErrorField' => $fieldName,
				'mMessage' => $message);
		$jsonResponse->setData($responseMsg);
		return $jsonResponse;
	}
	
	
	public function debugRequest(Request $request) {
		$logger = $this->get('logger');
		$logger->debug('mastest: BaseController::debugRequest');
			
		$logger->debug('mastest3: textRequest=[[['.$request->__toString().']]]');
	
		$cnt = $request->request->getIterator()->count();
		$logger->debug('mastest3: request params count = <'.$cnt.'>');
			
		$it = $request->request->getIterator();
		for($i=0; $i<$cnt; $i++) {
			$key = $it->key();
			$val = $it->current();
			$logger->debug('mastest3: reqParam['.$i.'] = { \''.$key.'\' => \''.print_r($val,1).'\' }');
			$it->next();
		}
			
	}
	
	//------ validators ------------------
	
	public function isFloat($strValue) {
		$floatVal = filter_var($strValue, FILTER_VALIDATE_FLOAT);
		if( empty($floatVal) ) {
			return false;
		} else {
			return true;
		}
	}
	
	public function isInt($strValue) {
		$intVal = filter_var($strValue, FILTER_VALIDATE_INT);
		if( empty($intVal) ) {
			return false;
		} else {
			return true;
		}
	}
	
	public function isIntPositive($strValue) {
		$intVal = filter_var($strValue, FILTER_VALIDATE_INT);
		if( empty($intVal) ) {
			return false;
		} else {
			if( $intVal > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = \DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	
}
		