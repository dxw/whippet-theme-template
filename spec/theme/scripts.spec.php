<?php

describe(\Dxw\MyTheme\Theme\Scripts::class, function () {
    beforeEach(function () {
        \WP_Mock::setUp();
        \WP_Mock::wpFunction('esc_url', [
            'return' => function ($a) {
                return '_'.$a.'_';
            },
        ]);
        $this->abspath = \org\bovigo\vfs\vfsStream::setup()->url();
        $this->helpers = new \Dxw\Iguana\Theme\Helpers();
        $this->scripts = new \Dxw\MyTheme\Theme\Scripts($this->helpers);
        $this->mockAssetPath = function ($asset) {
            $static_folder = $this->abspath.'/../static/';
            if (!file_exists($static_folder)) {
                mkdir($static_folder, 0755, true);
                file_put_contents($this->abspath.'/../static/manifest.json', json_encode([
                    'main.min.css' => 'main.min-fingerprinted.css'
                ]));
            }
            \WP_Mock::wpFunction('get_stylesheet_directory', [
                'args' => [],
                'return' => $this->abspath
            ]);
            \WP_Mock::wpFunction('wp_make_link_relative', [
                'args' => ['http://foo.bar.invalid/cat/dog/../static/'.$asset],
                'return_arg' => 0
            ]);
            \WP_Mock::wpFunction('get_template_directory_uri', [
                'args' => [],
                'return' => 'http://foo.bar.invalid/cat/dog',
            ]);
        };
    });

    afterEach(function () {
        \WP_Mock::tearDown();
    });

    it('is registrable', function () {
        expect($this->scripts)->to->be->an->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers nav scripts', function () {
            \WP_Mock::expectActionAdded('wp_enqueue_scripts', [$this->scripts, 'wpEnqueueScripts']);
            \WP_Mock::expectActionAdded('wp_print_scripts', [$this->scripts, 'wpPrintScripts']);

            $this->scripts->register();
        });
    });

    describe('->getAssetPath()', function () {
        it('gets the path of the asset', function () {
            $this->mockAssetPath('meow');
            expect($this->scripts->getAssetPath('meow'))
                ->to->be->equal('http://foo.bar.invalid/cat/dog/../static/meow');
        });

        context('when a fingerprinted asset exists', function () {
            it('gets the path of the fingerprinted asset', function () {
                \WP_Mock::wpFunction('wp_make_link_relative', [
                    'args' => ['http://foo.bar.invalid/cat/dog/../static/main.min-fingerprinted.css'],
                    'return_arg' => 0
                ]);
                $this->mockAssetPath('main.min.css');
                expect($this->scripts->getAssetPath('main.min.css'))
                    ->to->be->equal('http://foo.bar.invalid/cat/dog/../static/main.min-fingerprinted.css');
            });
        });
    });

    describe('->assetPath()', function () {
        it('echos the path of the assets', function () {
            $this->mockAssetPath('meow');
            ob_start();
            $this->scripts->assetPath('meow');
            $result = ob_get_contents();
            ob_end_clean();
            expect($result)->to->be->equal('_http://foo.bar.invalid/cat/dog/../static/meow_');
        });
    });

    describe('->wpEnqueueScripts()', function () {
        it('enqueues some of the JavaScript files', function () {
            \WP_Mock::wpFunction('wp_make_link_relative', [
                'args' => ['http://foo.bar.invalid/cat/dog/../static/main.min-fingerprinted.css'],
                'return_arg' => 0
            ]);
            $this->mockAssetPath('lib/jquery.min.js');
            $this->mockAssetPath('lib/modernizr.min.js');
            $this->mockAssetPath('main.min.js');
            $this->mockAssetPath('lib/jquery.min.js');

            \WP_Mock::wpFunction('wp_deregister_script', [
                'args' => ['jquery'],
                'times' => 1,
            ]);

            \WP_Mock::wpFunction('wp_enqueue_script', [
                'args' => ['jquery', 'http://foo.bar.invalid/cat/dog/../static/lib/jquery.min.js'],
                'times' => 1,
            ]);

            \WP_Mock::wpFunction('wp_enqueue_script', [
                'args' => ['modernizr', 'http://foo.bar.invalid/cat/dog/../static/lib/modernizr.min.js'],
                'times' => 1,
            ]);

            \WP_Mock::wpFunction('wp_enqueue_script', [
                'args' => ['main', 'http://foo.bar.invalid/cat/dog/../static/main.min.js', ['jquery', 'modernizr'], '', true],
                'times' => 1,
            ]);

            \WP_Mock::wpFunction('wp_enqueue_style', [
                'args' => ['main', 'http://foo.bar.invalid/cat/dog/../static/main.min-fingerprinted.css'],
                'times' => 1,
            ]);

            $this->scripts->wpEnqueueScripts();
        });
    });

    describe('->wpPrintScripts()', function () {
        it('prints some elements tags directly', function () {
            \WP_Mock::wpFunction('wp_make_link_relative', [
                'args' => ['http://foo.bar.invalid/cat/dog/../static/img/shortcut-icon.png'],
                'return_arg' => 0
            ]);
            $this->mockAssetPath('img/apple-touch-icon-precomposed.png');
            ob_start();
            $this->scripts->wpPrintScripts();
            $result = ob_get_contents();
            ob_end_clean();
            expect($result)->to->be->equal(implode("\n", [
                '        <meta name="viewport" content="width=device-width, initial-scale=1.0">',
                '',
                '        <link rel="apple-touch-icon-precomposed" href="_http://foo.bar.invalid/cat/dog/../static/img/apple-touch-icon-precomposed.png_">',
                '',
                '        <link rel="icon" type="image/png" href="_http://foo.bar.invalid/cat/dog/../static/img/shortcut-icon.png_">',
                '        ',
            ]));
        });
    });
});
