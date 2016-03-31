
<?php

class Theme_WpHead_Test extends PHPUnit_Framework_TestCase
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
        $wpHead = new \Dxw\MyTheme\Theme\WpHead();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $wpHead);

        \WP_Mock::expectActionAdded('init', [$wpHead, 'init']);

        $wpHead->register();
    }

    public function testInit()
    {
        $wpHead = new \Dxw\MyTheme\Theme\WpHead();

        $actions = [
            ['wp_head', 'print_emoji_detection_script', 7],
            ['wp_print_styles', 'print_emoji_styles'],
            ['admin_print_styles', 'print_emoji_styles'],
            ['admin_print_scripts', 'print_emoji_detection_script'],
            ['wp_head', 'rsd_link'],
            ['wp_head', 'wp_generator'],
            ['wp_head', 'wlwmanifest_link'],
            ['wp_head', 'feed_links_extra', 3],
            ['wp_head', 'start_post_rel_link', 10, 0],
            ['wp_head', 'parent_post_rel_link', 10, 0],
            ['wp_head', 'adjacent_posts_rel_link', 10, 0],
        ];

        foreach ($actions as $args) {
            \WP_Mock::wpFunction('remove_action', [
                'args' => $args,
                'times' => 1,
            ]);
        }

        $wpHead->init();
    }
}
