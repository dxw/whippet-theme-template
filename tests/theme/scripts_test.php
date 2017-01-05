<?php

class Theme_Scripts_Test extends PHPUnit_Framework_TestCase
{
    use \Dxw\Iguana\Theme\Testing;

    public function setUp()
    {
        \WP_Mock::setUp();

        \WP_Mock::wpFunction('esc_url', [
            'return' => function ($a) { return '_'.$a.'_'; },
        ]);
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testConstruct()
    {
        $helpers = $this->getHelpers(\Dxw\MyTheme\Theme\Scripts::class, [
            'assetPath' => 'assetPath',
            'getAssetPath' => 'getAssetPath',
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

    public function testGetAssetPath()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        \WP_Mock::wpFunction('get_stylesheet_directory_uri', [
            'args' => [],
            'return' => 'http://foo.bar.invalid/cat/dog',
        ]);

        $this->assertEquals('http://foo.bar.invalid/cat/static/meow', $scripts->getAssetPath('meow'));
    }

    public function testAssetPath()
    {
        $scripts = new \Dxw\MyTheme\Theme\Scripts($this->getHelpers());

        \WP_Mock::wpFunction('get_stylesheet_directory_uri', [
            'args' => [],
            'return' => 'http://foo.bar.invalid/cat/dog',
        ]);

        $this->expectOutputString('_http://foo.bar.invalid/cat/static/meow_');
        $scripts->assetPath('meow');
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
            'args' => ['jquery', 'http://a.invalid/static/lib/jquery.min.js'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_script', [
            'args' => ['modernizr', 'http://a.invalid/static/lib/modernizr.min.js'],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_script', [
            'args' => ['main', 'http://a.invalid/static/main.min.js', ['jquery', 'modernizr'], '', true],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('wp_enqueue_style', [
            'args' => ['main', 'http://a.invalid/static/main.min.css'],
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

        $this->expectOutputString(implode("\n", [
            '        <meta name="viewport" content="width=device-width, initial-scale=1.0">',
            '',
            '        <link rel="apple-touch-icon-precomposed" href="_http://a.invalid/static/img/apple-touch-icon-precomposed.png_">',
            '',
            '        <link rel="icon" type="image/png" href="_http://a.invalid/static/img/shortcut-icon.png_">',
            '        ',
        ]));

        $scripts->wpPrintScripts();
    }
}
