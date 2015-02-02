<?php

namespace heyAuto\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use heyAuto\DemoBundle\Entity\User;

class LoadUserData implements FixtureInterface {
	/**
	/* Load data fixtures with the passed EntityManager
	 * 
	 */
	public function load(ObjectManager $manager) {

		$alice = new User();
		$alice->setUsername('alice');
		$alice->setEmail('alice@gmail.com');
		$alice->setPassword('fooalicepassword');
		$alice->setPhoneNo('123451');
		
		$bob = new User();
		$bob->setUsername('bob');
		$bob->setEmail('bob@gmail.com');
		$bob->setPassword('foobobpassword');
		$bob->setPhoneNo('5551234');
		
		$manager->persist($alice);
		$manager->persist($bob);
		$manager->flush();
		
	}

}