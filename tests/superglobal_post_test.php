<?php

class SuperglobalPost_Test extends PHPUnit_Framework_TestCase
{
    public function testUsesCorrectGlobalVariable()
    {
        $_POST = [
            'e' => 'f',
            'g' => 'h',
        ];

        $__post = new \Dxw\MyTheme\SuperglobalPost();

        $this->assertEquals('f', $__post['e']);
        $this->assertEquals('h', $__post['g']);
        $this->assertFalse(isset($__post['z']));
    }
}
