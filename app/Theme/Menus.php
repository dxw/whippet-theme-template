<?php

namespace Dxw\MyTheme\Theme;

class Menus implements \Dxw\MyTheme\Registerable
{
    public function register()
    {
        register_nav_menu('header', 'Header Menu');
        register_nav_menu('footer', 'Footer Menu');
    }
}
