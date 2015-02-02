<?php

namespace heyAuto\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends BaseControllerTest {

    protected function setUp() {

        parent::setUp();
    }

    public function testTrue() {

        $this->assertTrue( true == true);
    }

}
