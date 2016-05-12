<?php

class SuperglobalGet_Test extends PHPUnit_Framework_TestCase
{
    public function testUsesCorrectGlobalVariable()
    {
        $_GET = [
            'a' => 'b',
            'c' => 'd',
        ];

        $__get = new \Dxw\MyTheme\SuperglobalGet();

        $this->assertEquals('b', $__get['a']);
        $this->assertEquals('d', $__get['c']);
        $this->assertFalse(isset($__get['z']));
    }
}
