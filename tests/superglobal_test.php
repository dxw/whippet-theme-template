<?php

class MySuperglobal extends \Dxw\MyTheme\Superglobal
{
    public function __construct(array $value)
    {
        $this->value = $value;
    }
}

class Superglobal_Test extends PHPUnit_Framework_TestCase
{
    public function testOffsetExists()
    {
        $superglobal = new MySuperglobal([
            'a' => 'b',
        ]);

        $this->assertArrayHasKey('a', $superglobal);
        $this->assertFalse(isset($superglobal['b']));
    }

    public function testOffsetGet()
    {
        $superglobal = new MySuperglobal([
            'a' => 'b',
        ]);

        $this->assertEquals('b', $superglobal['a']);
    }

    public function testOffsetSet()
    {
        $superglobal = new MySuperglobal([]);

        try {
            $superglobal['a'] = 'b';
        } catch (\Exception $e) {
            $this->assertEquals('cannot modify superglobals', $e->getMessage());

            return;
        }

        $this->fail('Expected \\Exception to be thrown.');
    }

    public function testOffsetUnset()
    {
        $superglobal = new MySuperglobal([]);

        try {
            unset($superglobal['a']);
        } catch (\Exception $e) {
            $this->assertEquals('cannot modify superglobals', $e->getMessage());

            return;
        }

        $this->fail('Expected \\Exception to be thrown.');
    }
}
