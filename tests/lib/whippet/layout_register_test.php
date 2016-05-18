<?php

class Lib_Whippet_LayoutRegister_Test extends PHPUnit_Framework_TestCase
{
    use \Dxw\Iguana\Theme\Testing;

    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();

        \Dxw\MyTheme\Lib\Whippet\Layout::$wordpress_template = null;
    }

    public function testRegister()
    {
        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister($this->getHelpers());

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $layoutRegister);

        \WP_Mock::expectFilterAdded('template_include', [\Dxw\MyTheme\Lib\Whippet\Layout::class, 'apply'], 99);

        $layoutRegister->register();
    }

    public function testConstruct()
    {
        $helpers = $this->getHelpers(\Dxw\MyTheme\Lib\Whippet\LayoutRegister::class, [
            'w_requested_template' => 'wRequestedTemplate',
        ]);

        $layoutRegister = new \Dxw\MyTheme\Lib\Whippet\LayoutRegister($helpers);

        $this->assertFunctionsRegistered();
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
