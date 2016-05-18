<?php

class Theme_Scripts_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function getHelpers()
    {
        $helpers = $this->getMockBuilder(\Dxw\Iguana\Theme\Helpers::class)
        ->disableOriginalConstructor()
        ->getMock();

        return $helpers;
    }

    public function testInstantiate()
    {
        $helpers = $this->getHelpers();

        $helpers->expects($this->exactly(1))
        ->method('registerFunction')
        ->will($this->returnCallback(function ($a, $b) {
            $this->assertEquals('assetPath', $a);
            $this->assertCount(2, $b);
            $this->assertInstanceOf(\Dxw\MyTheme\Theme\Scripts::class, $b[0]);
            $this->assertEquals('getUri', $b[1]);
        }));

        $scripts = new \Dxw\MyTheme\Theme\Scripts($helpers);
    }

    public function testRegister()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $scripts);

        \WP_Mock::expectActionAdded('wp_enqueue_scripts', [$scripts, 'wpEnqueueScripts']);
        \WP_Mock::expectActionAdded('wp_print_scripts', [$scripts, 'wpPrintScripts']);

        $scripts->register();
    }

    public function testGetUri()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        \WP_Mock::wpFunction('get_stylesheet_directory_uri', [
            'args' => [],
            'return' => 'http://foo.bar.invalid/cat/dog',
        ]);

        $this->assertEquals('http://foo.bar.invalid/cat/build/meow', $scripts->getUri('meow'));
    }

    public function testWpEnqueueScripts()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        \WP_Mock::wpFunction('get_stylesheet_directory_uri', [
            'args' => [],
            'return' => 'http://a.invalid/zzz',
        ]);

        \WP_Mock::wpFunction('wp_deregister_script', [
            'args' => ['jquery'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_script', [
            'args' => ['jquery', 'http://a.invalid/build/lib/jquery.min.js'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_script', [
            'args' => ['modernizr', 'http://a.invalid/build/lib/modernizr.min.js'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_script', [
            'args' => ['main', 'http://a.invalid/build/main.min.js', ['jquery', 'modernizr'], '', true],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_style', [
            'args' => ['main', 'http://a.invalid/build/main.min.css'],
            'times' => 1,
        ]);

        $scripts->wpEnqueueScripts();
    }

    public function testWpPrintScripts()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        \WP_Mock::wpFunction('get_stylesheet_directory_uri', [
            'args' => [],
            'return' => 'http://a.invalid/zzz',
        ]);

        \WP_Mock::wpFunction('esc_attr', [
            'return' => function ($a) { return '_'.$a.'_'; },
        ]);

        $this->expectOutputString(implode("\n", [
            '        <meta name="viewport" content="width=device-width, initial-scale=1.0">',
            '        <link rel="icon" type="image/png" href="_http://a.invalid/build/img/dxw.png_">',
            '        ',
        ]));

        $scripts->wpPrintScripts();
    }
}
