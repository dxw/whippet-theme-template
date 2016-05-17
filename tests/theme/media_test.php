<?php

class Theme_Media_Test extends PHPUnit_Framework_TestCase
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
        $media = new \Dxw\MyTheme\Theme\Media();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $media);

        \WP_Mock::wpFunction('set_post_thumbnail_size', [
            'args' => [150, 150, true],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('add_image_size', [
            'args' => ['medium', 200, 200, true],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('add_image_size', [
            'args' => ['large', 800, 300, true],
            'times' => 1,
        ]);

        $media->register();
    }
}
