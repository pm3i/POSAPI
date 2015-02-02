<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use heyAuto\DemoBundle\Entity\PosUsers;
use heyAuto\DemoBundle\Entity\PosGroupMobile;
use heyAuto\DemoBundle\Entity\PosUserGroupMap;
use Symfony\Component\Validator\Constraints\EqualTo;
use Monolog\Logger;



/**
 * PosUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PosUserGroupMapRepository extends EntityRepository
{
	public function createNewPosUserGroupMap(PosUserGroupMap $posUserGroupMap) 
	{
		
		if($posUserGroupMap == null) {
			return array (
					'mSuccess' => false,
					'mErrorField' => null,
					'mMessage' => "Unknown error" 
			);
			
		} elseif($posUserGroupMap->getUserId() == null) {
			
			return array (
					'mSuccess' => false,
					'mErrorField' => "username",
					'mMessage' => "No user name specified"
			);

		}else {	
			
			$manager = $this->getEntityManager();
			$manager->persist($posUserGroupMap);
			$manager->flush();
			
			return array (
						'mSuccess' => true,
						'mErrorField' => null,
						'mMessage' => "Registration succeded"
			);
			
		}
	}
	
}
