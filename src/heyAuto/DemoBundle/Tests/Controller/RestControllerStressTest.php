<?php

namespace heyAuto\DemoBundle\Tests\Controller;
use heyAuto\DemoBundle\Tests\Controller;

class RestControllerStressTest extends BaseControllerTest {

    protected static $USERS_URL = '/rest/users';
    protected static $TEST_USER_LOGIN = 'maser';


    protected function setUp() {

        parent::setUp();
    }

    public function testGetUsers() {
// NOT FINISHED!!
        $this->_client->request('GET', RestControllerStressTest::$USERS_URL);
        $response = $this->_client->getResponse();

        $users = $this->_userRepo->findAll();

        $data = json_decode($response->getContent(), true);
//         echo print_r($data[0], 1);
        $this->assertSame($users[0]->getId(), $data[0]['mId']);
        $this->assertSame($users[0]->getBirthYear(), $data[0]['mBirthYear']);
        $this->assertSame($users[0]->getPhoneNo(), $data[0]['mPhoneNo']);
        
    }

    
}
