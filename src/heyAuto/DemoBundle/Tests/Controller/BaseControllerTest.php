<?php

namespace heyAuto\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use FOS\UserBundle\Security\UserProvider;

class BaseControllerTest extends WebTestCase {

    protected static $USER_REPO = 'heyAutoDemoBundle:User';
    protected static $FOS_USER_MANAGER = 'fos_user.user_manager';

    /**
     * @var EntityManager
     */
    protected $_doctrine;

    protected $_userRepo;

    protected $_fosUserRepo;

    protected $_client;

    protected $_kernel;


    protected function setUp() {

        $this->_kernel = static::createKernel();
        $this->_kernel->boot();
        $this->_doctrine = $this->_kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->_doctrine->beginTransaction();
        $this->_userRepo = $this->_doctrine->getRepository( DefaultControllerTest::$USER_REPO );
        $this->_fosUserRepo = $this->_kernel->getContainer()->get( DefaultControllerTest::$FOS_USER_MANAGER );
        $this->_client = static::createClient();
    }

    public function testTrue() {
        $this->assertTrue( true == true);
    }

}
