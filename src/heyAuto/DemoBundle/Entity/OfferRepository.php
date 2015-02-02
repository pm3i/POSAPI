<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\User;
use heyAuto\DemoBundle\Entity\UserRepository;
use heyAuto\DemoBundle\Entity\Offer;
use Symfony\Component\Validator\Constraints\EqualTo;
use Monolog\Logger;

/**
 * OfferRepository
 *
 */
class OfferRepository extends EntityRepository
{
	
	/**
	 * INFO: if null param is given, then corresponding field isn't taken into account
	 * 
	 * @param string $offererId
	 * @param string $offereeId
	 * @param string $status
	 * @param string $onlyOpened
	 * @return multitype:
	 */
	public function findOfferBy(
				$offererId=null,
				$offereeId=null,
				$status=null,
			 	$onlyOpened=null) {
		
// 		$offererId 	= 9;
// 		$offereeId 	= null;
// 		$status    	= null;
// 		$onlyOpened = 1;
		
		
		$qb = $this->createQueryBuilder('Offer');

		if(!empty($offererId)) {
			$qb->andWhere('Offer.offerer = :offererId')
			->setParameter('offererId', $offererId);
		}
		if(!empty($offereeId)) {
			if( !empty($offererId) && $offererId == $offereeId ) {
				$qb->orWhere('Offer.offeree = :offereeId')
				->setParameter('offereeId', $offereeId);
			} else {
				$qb->andWhere('Offer.offeree = :offereeId')
				->setParameter('offereeId', $offereeId);
			}
		}
		if(!empty($status)) {
			$qb->andWhere('Offer.status = :status')
			->setParameter('status', $status);
		}
		if($onlyOpened == true) {
			$qb->andWhere('Offer.status != :status')
			->setParameter('status', Offer::$STATUS_CLOSED);
		}
		
		return $qb->getQuery()
		->getResult();
	}
	
	public function findAllForOffererId($offererId, $status=null)
	{
		$statusQueryPart='';
		if (!empty($status)) {
			$statusQueryPart = ' AND p.status='.$status;
		}
		
		return $this->getEntityManager()
		->createQuery(
				'SELECT p 
				FROM heyAutoDemoBundle:Offer p
				WHERE p.offerer='.$offererId
				.$statusQueryPart			
		)->getResult();
	}
	
	public function findAllForOffereeId($offereeId)
	{
		return $this->getEntityManager()
		->createQuery(
				'SELECT p
				FROM heyAutoDemoBundle:Offer p
				WHERE p.offeree='.$offereeId
		)->getResult();
	}
	
	public function findAllForUserId($userId)
	{
		return $this->getEntityManager()
		->createQuery(
				'SELECT p
				FROM heyAutoDemoBundle:Offer p
				WHERE p.offeree='.$userId
				.'OR p.offerer='.$userId
		)->getResult();
	}
	
	
	public function findOneByOffererIdAndOffereeId($offererId, $offereeId)
	{
		if($offereeId == null) {
			$offereeEquals = " IS ";
			$offereeId = "NULL";
		} else {
			$offereeEquals = "=";
		}
		return $this->getEntityManager()
		->createQuery(
				'SELECT p FROM heyAutoDemoBundle:Offer p 
				WHERE p.offerer='.$offererId.' AND 
				p.offeree'.$offereeEquals.$offereeId
		)->getResult();
		
	}
	
	public function createNewOffer(Offer $offer)
	{
	
		if($offer == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => null,
					'mMessage' => "Unknown error"
			);
				
		} elseif($offer->getOfferer() == null) {
				
			return array (
					'mSuccess' => false,
					'mErrorField' => "offerer",
					'mMessage' => "No offerer specified"
			);
	
		} elseif($offer->getExpirationDate() == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => "expirationDate",
					'mMessage' => "No expiration date specified"
			);
	
		}else {
	
			$offer->setStatus(Offer::$STATUS_LIFT_REQUEST_WAITING_FOR_DRIVER_ACCEPTANCE);
				
			$manager = $this->getEntityManager();
			$manager->persist($offer);			
			
			$manager->flush();

			
			return array (
					'mSuccess' => true,
					'mErrorField' => null,
					'mMessage' => "Offer created successfully"
			);
				
		}
	}
	
	
	public function findOfferId($offerId)
	{
		return $this->findOneBy(array('id' => $offerId));
	}
	
	public function updateOffer(Offer $offer) {
	
		$manager = $this->getEntityManager();
		$dbOffer = $this->findOfferId($offer->getId());
		if(!$dbOffer){
			return false;
		} else {
			$manager->persist($offer);
			$manager->flush();
			
			//--- update users' ratings when offers is closed and both ratings are issued
			$dbOffer = $this->findOfferId($offer->getId());
			if( $dbOffer->getStatus() == Offer::$STATUS_CLOSED && 
				$dbOffer->getDriverRating() != null &&
				$dbOffer->getPassengerRating() != null ){
				
				$this->getEntityManager()->getRepository('heyAutoDemoBundle:User')
					->updateUsersRatingsFromOffer($dbOffer);
				
// 				UserRepository
// 				UserRepository $sad = new UserRepository();
				//->updateUsersRatingsFromOffer(offer);
			}
			return true;
		}		
	}
	
	
}