<?php

namespace Dxw\MyTheme;

class SuperglobalGet extends Superglobal
{
    public function __construct()
    {
        $this->value = $_GET;
    }
}
