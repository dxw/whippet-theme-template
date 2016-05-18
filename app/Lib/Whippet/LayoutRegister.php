<?php

namespace Dxw\MyTheme\Lib\Whippet;

class LayoutRegister implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        add_filter('template_include', array(\Dxw\MyTheme\Lib\Whippet\Layout::class, 'apply'), 99);
    }
}
