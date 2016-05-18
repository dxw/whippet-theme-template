<?php

class Lib_Whippet_LayoutRegister_Test extends PHPUnit_Framework_TestCase
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
        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $layoutRegister);

        \WP_Mock::expectFilterAdded('template_include', [\Dxw\MyTheme\Lib\Whippet\Layout::class, 'apply'], 99);

        $layoutRegister->register();
    }
}
