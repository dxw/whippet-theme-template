<?php

class Theme_TitleTag_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    private function getRegistrar()
    {
        $registrar = $this->getMockBuilder('\\Dxw\\MyTheme\\Registrar')
        ->disableOriginalConstructor()
        ->getMock();

        return $registrar;
    }

    public function testRegister()
    {
        $titleTag = new \Dxw\MyTheme\Theme\TitleTag($this->getRegistrar());

        \WP_Mock::wpFunction('add_theme_support', [
            'args' => ['title-tag'],
            'times' => 1,
        ]);

        $titleTag->register();
    }
}
