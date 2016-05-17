<?php

class CoreBehaviour_Test extends PHPUnit_Framework_TestCase
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
        $coreBehaviour = new \Dxw\MyTheme\CoreBehaviour();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $coreBehaviour);

        \WP_Mock::expectActionAdded('init', [$coreBehaviour, 'init']);
        \WP_Mock::expectActionAdded('wp_head', [$coreBehaviour, 'wpHead']);

        $coreBehaviour->register();
    }

    public function testInit()
    {
        $coreBehaviour = new \Dxw\MyTheme\CoreBehaviour();

        \WP_Mock::expectFilterAdded('default_feed', [$coreBehaviour, 'defaultFeed']);

        \WP_Mock::wpFunction('remove_action', [
            'args' => ['do_feed_rdf', 'do_feed_rdf', 10, 1],
            'times' => 1,
        ]);
        \WP_Mock::wpFunction('remove_action', [
            'args' => ['do_feed_rss', 'do_feed_rss', 10, 1],
            'times' => 1,
        ]);
        \WP_Mock::wpFunction('remove_action', [
            'args' => ['do_feed_rss2', 'do_feed_rss2', 10, 1],
            'times' => 1,
        ]);

        $coreBehaviour->init();
    }

    public function testDefaultFeed()
    {
        $coreBehaviour = new \Dxw\MyTheme\CoreBehaviour();

        $this->assertEquals('atom', $coreBehaviour->defaultFeed());
    }

    public function testWpHead()
    {
        $coreBehaviour = new \Dxw\MyTheme\CoreBehaviour();

        \WP_Mock::wpFunction('get_bloginfo', [
            'args' => ['name'],
            'return' => 'Xyz',
        ]);

        \WP_Mock::wpFunction('esc_attr', [
            'return' => function ($a) { return '_'.$a.'_'; },
        ]);

        \WP_Mock::wpFunction('get_feed_link', [
            'args' => ['atom'],
            'return' => 'xyz',
        ]);

        $this->expectOutputString('        <link rel="alternate" type="application/atom+xml" title="_Xyz_ Feed" href="_xyz_">'."\n        ");

        $coreBehaviour->wpHead();
    }
}
