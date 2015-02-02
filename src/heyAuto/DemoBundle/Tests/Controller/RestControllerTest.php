<?php

namespace heyAuto\DemoBundle\Tests\Controller;
use heyAuto\DemoBundle\Tests\Controller;

class RestControllerTest extends BaseControllerTest {

    protected static $USERS_URL = '/rest/users';
    protected static $TEST_USER_LOGIN = 'maser';


    protected function setUp() {

        parent::setUp();
    }

    public function testGetUsers() {

        $this->_client->request('GET', RestControllerTest::$USERS_URL);
        $response = $this->_client->getResponse();
        // echo $response;

        $users = $this->_userRepo->findUsersWithRole(null);

        $data = json_decode($response->getContent(), true);
        $this->assertSame($users[0]->getId(), $data[0]['mId']);
    }

    public function testGetUser() {

        $users = $this->_userRepo->findUsersWithRole(null);

        $this->_client->request('GET', RestControllerTest::$USERS_URL . '/' . $users[0]->getId());
        // echo RestControllerTest::$USERS_URL . '/' . $users[0]->getId();
        $response = $this->_client->getResponse();
        // echo $response;

        $data = json_decode($response->getContent(), true);
        $this->assertSame($users[0]->getId(), $data['mId']);
    }

//TODO: code commented due to unit test error - memory limit exceeded (128M)
//     public function testUpdateUser() {

//         echo 'test';
        
//         // get test user
//         $user = $this->_userRepo->findOneByUsername( RestControllerTest::$TEST_USER_LOGIN );

//         // change user data
//         $user->setEmail( $user->getEmail() . '1');
//         $user->setPhoneNo( $user->getPhoneNo() . '1');
//         $user->setGender( $user->getGender() == 1 ? 2 : 1 );
//         $user->setBirthYear( $user->getBirthYear() . '1');
//         $user->setFullName( $user->getFullName() . '1');
//         $user->setPassword( $user->getPassword() . '1');

//         $encoder      = $this->_kernel->getContainer()->get('security.encoder_factory')->getEncoder($user);
//         $encoded_pass = $encoder->encodePassword( $user->getPassword(), $user->getSalt());
//         $user->setPassword($encoded_pass);

//         // update user via REST
//         $this->_client->request(
//             'POST',
//             RestControllerTest::$USERS_URL . '/' . $user->getId(),
//             array( 'user'    => $user )
//             );

//         // assert no errors in response
//         $this->assertTrue($this->_client->getResponse()->isSuccessful());

//         // get updated user
//         $updatedUser = $this->_userRepo->findOneByUsername( RestControllerTest::$TEST_USER_LOGIN );

//         // assert user data was changed in db
//         $this->assertTrue( $user->getId() == $updatedUser->getId() );
//         $this->assertTrue( $user->getEmail() == $updatedUser->getEmail() );
//         $this->assertTrue( $user->getPhoneNo() == $updatedUser->getPhoneNo() );
//         $this->assertTrue( $user->getGender() == $updatedUser->getGender() );
//         $this->assertTrue( $user->getBirthYear() == $updatedUser->getBirthYear() );
//         $this->assertTrue( $user->getFullName() == $updatedUser->getFullName() );
//         $this->assertTrue( $user->getPassword() == $updatedUser->getPassword() );
//     }
}
