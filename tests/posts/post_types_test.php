<?php

class Posts_PostTypes_Test extends PHPUnit_Framework_TestCase
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
        $postTypes = new \Dxw\MyTheme\Posts\PostTypes();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $postTypes);

        // ...

        $postTypes->register();
    }
}
