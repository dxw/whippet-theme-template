<?php

namespace Dxw\MyTheme;

abstract class Superglobal implements \ArrayAccess
{
    protected $value;

    public function offsetExists($offset)
    {
        return isset($this->value[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->value[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \Exception('cannot modify superglobals');
    }

    public function offsetUnset($offset)
    {
        throw new \Exception('cannot modify superglobals');
    }
}
