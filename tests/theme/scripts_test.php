<?php

class Theme_Scripts_Test extends PHPUnit_Framework_TestCase
{
    use \Dxw\Iguana\Theme\Testing;

    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testConstruct()
    {
        $helpers = $this->getHelpers(\Dxw\MyTheme\Theme\Scripts::class, [
            'assetPath' => 'getUri',
        ]);

        $scripts = new \Dxw\MyTheme\Theme\Scripts($helpers);

        $this->assertFunctionsRegistered();
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
            '',
            '        <!-- Prefetch external asset dns -->',
            '        <link rel="dns-prefetch" href="#">',
            '',
            '        <!-- Prefetch internal image assets -->',
            '        <link rel="prefetch" href="#">',
            '',
            '        <link rel="apple-touch-icon-precomposed" href="_http://a.invalid/build/img/touch-icon.png_">',
            '',
            '        <link rel="icon" type="image/png" href="_http://a.invalid/build/img/dxw.png_">',
            '        ',
        ]));

        $scripts->wpPrintScripts();
    }
}
