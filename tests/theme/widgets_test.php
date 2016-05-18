<?php

class Theme_Widgets_Test extends PHPUnit_Framework_TestCase
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
        $widgets = new \Dxw\MyTheme\Theme\Widgets();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $widgets);

        \WP_Mock::expectActionAdded('widgets_init', [$widgets, 'widgetsInit']);

        $widgets->register();
    }

    public function testWidgetsInit()
    {
        $widgets = new \Dxw\MyTheme\Theme\Widgets();

        \WP_Mock::wpFunction('__', [
            'return' => function ($a) { return $a; },
        ]);

        \WP_Mock::wpFunction('register_sidebar', [
            'args' => [[
                'name' => __('Primary'),
                'id' => 'sidebar-primary',
                'before_widget' => '<section class="widget %1$s %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            ]],
            'times' => 1,
        ]);

        \WP_Mock::wpFunction('register_sidebar', [
            'args' => [[
                'name' => __('Footer'),
                'id' => 'sidebar-footer',
                'before_widget' => '<section class="widget %1$s %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            ]],
            'times' => 1,
        ]);

        $widgets->widgetsInit();
    }
}
