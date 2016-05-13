<?php

namespace Dxw\MyTheme\Value;

class Post extends ArrayBase
{
    public function __construct()
    {
        $this->value = $_POST;
    }
}
