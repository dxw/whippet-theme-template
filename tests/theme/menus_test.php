<?php

class Theme_Menus_Test extends PHPUnit_Framework_TestCase
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
        $menus = new \Dxw\MyTheme\Theme\Menus();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $menus);

        \WP_Mock::wpFunction('register_nav_menu', [
            'args' => ['header', 'Header Menu'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('register_nav_menu', [
            'args' => ['footer', 'Footer Menu'],
            'times' => 1,
        ]);

        $menus->register();
    }
}
