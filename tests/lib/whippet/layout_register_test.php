<?php

class Lib_Whippet_LayoutRegister_Test extends PHPUnit_Framework_TestCase
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
    }

    public function testRegister()
    {
        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister($this->getHelpers());

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $layoutRegister);

        \WP_Mock::expectFilterAdded('template_include', [\Dxw\MyTheme\Lib\Whippet\Layout::class, 'apply'], 99);

        $layoutRegister->register();
    }

    private function getHelpers()
    {
        $helpers = $this->getMockBuilder(\Dxw\Iguana\Theme\Helpers::class)
        ->disableOriginalConstructor()
        ->getMock();

        return $helpers;
    }

    public function testConstruct()
    {
        $helpers = $this->getHelpers();

        $helpers->expects($this->exactly(1))
        ->method('registerFunction')
        ->will($this->returnCallback(function ($a, $b) {
            $this->assertEquals('w_requested_template', $a);
            $this->assertCount(2, $b);
            $this->assertInstanceOf(\Dxw\MyTheme\Lib\Whippet\LayoutRegister::class, $b[0]);
            $this->assertEquals('wRequestedTemplate', $b[1]);
        }));

        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister($helpers);
    }

    public function testWRequestedTemplate()
    {
        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister($this->getHelpers());

        $file = \org\bovigo\vfs\vfsStream::setup()->url().'/file.php';
        file_put_contents($file, '<?php global $called; $called++;');
        \Dxw\MyTheme\Lib\Whippet\Layout::$wordpress_template = $file;

        global $called;
        $called = 0;

        $layoutRegister->wRequestedTemplate();

        $this->assertEquals(1, $called);
    }
}
