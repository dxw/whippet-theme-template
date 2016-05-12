<?php

namespace Dxw\MyTheme;

class SuperglobalPost extends Superglobal
{
    public function __construct()
    {
        $this->value = $_POST;
    }
}
