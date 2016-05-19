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

    public function testRegister()
    {
        $titleTag = new \Dxw\MyTheme\Theme\TitleTag();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $titleTag);

        \WP_Mock::wpFunction('add_theme_support', [
            'args' => ['title-tag'],
            'times' => 1,
        ]);

        $titleTag->register();
    }
}
