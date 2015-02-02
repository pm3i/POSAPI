<?php

namespace heyAuto\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class WebsiteControllerTest extends BaseControllerTest {

    protected static $HOME_URL = '/home';
    protected static $PROFILE_URL = '/account';
    protected static $TEST_USER_LOGIN = 'maser';
    protected static $TEST_USER_PASSWORD = '123';

    protected function setUp() {
        parent::setUp();
    }

    public function testHome() {
        $crawler = $this->_client->request('GET', WebsiteControllerTest::$HOME_URL);

        $this->assertTrue($crawler->filter('html:contains("HEY")')->count() > 0);
    }

    public function testHome2() {

        $this->_client->request('GET', WebsiteControllerTest::$HOME_URL);

        $this->assertRegExp('/href="\/signin"/',
            $this->_client->getResponse()->getContent()
        );

    }

    public function testLogIn() {

        $this->logIn();

        $this->_client->request('GET', WebsiteControllerTest::$HOME_URL);

        $this->assertTrue($this->_client->getResponse()->isSuccessful());

        $this->assertRegExp('/href="\/signout"/',
            $this->_client->getResponse()->getContent()
        );

        $this->assertRegExp('/<a.*account.*' . WebsiteControllerTest::$TEST_USER_LOGIN . '.*<\/a>/',
            $this->_client->getResponse()->getContent()
        );
    }

    public function testProfilePage() {

        $this->logIn();

        $this->_client->request('GET', WebsiteControllerTest::$PROFILE_URL);

        // echo $this->_client->getResponse();
        $this->assertTrue($this->_client->getResponse()->isSuccessful());


        $this->assertRegExp('/id="user_type_fullName"/',
            $this->_client->getResponse()->getContent()
        );


        $user = $this->_userRepo->findOneByUsername( WebsiteControllerTest::$TEST_USER_LOGIN);

        $this->assertRegExp('/value="' . $user->getFullName() . '"/',
            $this->_client->getResponse()->getContent()
        );
    }

    public function testProfileUpdate() {

        // log in user
        $this->logIn();

        // get test user
        $user = $this->_userRepo->findOneByUsername( WebsiteControllerTest::$TEST_USER_LOGIN );

        // change user data
        $user->setEmail( $user->getEmail() . '1');
        $user->setPhoneNo( $user->getPhoneNo() . '1');
        $user->setGender( $user->getGender() == 1 ? 2 : 1 );
        $user->setBirthYear( $user->getBirthYear() . '1');
        $user->setFullName( $user->getFullName() . '1');
        $user->setPassword( $user->getPassword() . '1');

        // get account page
        $crawler = $this->_client->request('GET', WebsiteControllerTest::$PROFILE_URL);

        // get form
        $form = $crawler->filter('button[type=submit]')->form();

        // change some values on the form
        $form[ 'user_type[email]' ]       = $user->getEmail();
        $form[ 'user_type[phoneNo]' ]     = $user->getPhoneNo();
        $form[ 'user_gender' ]            = $user->getGender();
        $form[ 'user_type[birthYear]' ]   = $user->getBirthYear();
        $form[ 'user_type[fullName]' ]    = $user->getFullName();
        $form[ 'user_type[password][pass]' ]    = $user->getPassword();

        // submit the form
        $crawler = $this->_client->submit($form);

        // assert no errors in response
        // echo '$this->_client->getResponse()->getStatusCode()=' . $this->_client->getResponse()->getStatusCode();
        echo $this->_client->getResponse()->isSuccessful();
        $this->assertTrue($this->_client->getResponse()->isSuccessful());

        // assert username is displayed in response - it works as a double check for errors in response
        $this->assertRegExp('/value="'. $user->getFullName() . '"/',
            $this->_client->getResponse()->getContent()
        );

        // get updated user
        $updatedUser = $this->_userRepo->findOneByUsername( WebsiteControllerTest::$TEST_USER_LOGIN );

        // assert user data was changed in db
        $this->assertTrue( $user->getId() == $updatedUser->getId() );
        $this->assertTrue( $user->getEmail() == $updatedUser->getEmail() );
        $this->assertTrue( $user->getPhoneNo() == $updatedUser->getPhoneNo() );
        $this->assertTrue( $user->getGender() == $updatedUser->getGender() );
        $this->assertTrue( $user->getBirthYear() == $updatedUser->getBirthYear() );
        $this->assertTrue( $user->getFullName() == $updatedUser->getFullName() );
        $this->assertTrue( $user->getPassword() == $updatedUser->getPassword() );

    }

    protected function logIn()
    {
        // $firewall = 'main';

        $session = $this->_client->getContainer()->get('session');

        // $token = new UsernamePasswordToken(
        //     WebsiteControllerTest::$TEST_USER_LOGIN,
        //     WebsiteControllerTest::$TEST_USER_PASSWORD,
        //     $firewall,
        //     array('ROLE_USER'));

        $user = $this->_userRepo->findOneByUsername( WebsiteControllerTest::$TEST_USER_LOGIN);
        $session->set(SecurityContext::LAST_USERNAME, $user->getUsername());
        $session->set('last_user', $user);
        $session->save();

        // $session->set('_security_'.$firewall, serialize($token));
        // $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->_client->getCookieJar()->set($cookie);
    }

}
