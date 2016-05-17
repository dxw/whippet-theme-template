<?php

class Posts_CustomFields_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testRegister()
    {
        $customFields = new \Dxw\MyTheme\Posts\CustomFields();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $customFields);

        // ...

        $customFields->register();
    }
}
