<?php

namespace heyAuto\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PosStageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PosStageRepository extends EntityRepository
{
	public function findStagebyStatus($status) {
		return $this->findBy(array('status' => $status));
	}
}
