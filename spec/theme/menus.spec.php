<?php

describe(\Dxw\MyTheme\Theme\Menus::class, function () {
    beforeEach(function () {
        \WP_Mock::setUp();
        $this->menus = new \Dxw\MyTheme\Theme\Menus();
    });

    afterEach(function () {
        \WP_Mock::tearDown();
    });

    it('is registrable', function () {
        expect($this->menus)->to->be->an->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers nav menus', function () {
            \WP_Mock::wpFunction('register_nav_menu', [
                'args' => ['header', 'Header Menu'],
                'times' => 1
            ]);

            \WP_Mock::wpFunction('register_nav_menu', [
                'args' => ['footer', 'Footer Menu'],
                'times' => 1
            ]);

            $this->menus->register();
        });
    });
});
