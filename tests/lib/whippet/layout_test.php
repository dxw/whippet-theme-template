<?php

class Lib_Whippet_Layout_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();

        $cls = new ReflectionClass(\Dxw\MyTheme\Lib\Whippet\Layout::class);

        $property = $cls->getProperty('wordpress_template');
        $property->setAccessible(true);
        $property->setValue(null);

        $property = $cls->getProperty('base');
        $property->setAccessible(true);
        $property->setValue(null);
    }

    public function testRegister()
    {
        $layout = new \Dxw\MyTheme\Lib\Whippet\Layout();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $layout);

        \WP_Mock::expectFilterAdded('template_include', [$layout, 'apply'], 99);

        $layout->register();
    }

    public function testApply()
    {
        $layout = new \Dxw\MyTheme\Lib\Whippet\Layout();

        $this->assertInstanceOf(
            \Dxw\MyTheme\Lib\Whippet\Layout::class,
            $layout->apply('x/y/z.php')
        );

        $this->assertEquals(
            'x/y/z.php',
            \Dxw\MyTheme\Lib\Whippet\Layout::$wordpress_template
        );

        $this->assertEquals(
            'z',
            \Dxw\MyTheme\Lib\Whippet\Layout::$base
        );
    }

    public function testToString()
    {
        $layout = new \Dxw\MyTheme\Lib\Whippet\Layout();
        $layout->slug = 'slug';

        \WP_Mock::onFilter('roots_wrap_slug')
        ->with(['layouts/main.php'])
        ->reply(['layouts/my-layout.php']);

        \WP_Mock::wpFunction('locate_template', [
            'args' => [['layouts/my-layout.php']],
            'return' => 'correct output',
        ]);

        $this->assertEquals(
            'correct output',
            $layout->__toString()
        );
    }

    public function testConstructor()
    {
        $this->markTestIncomplete();
    }
}
