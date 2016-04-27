<?php

namespace Dxw\MyTheme\Theme;

class Menus
{
    public function register()
    {
        register_nav_menu('header', 'Header Menu');
        register_nav_menu('footer', 'Footer Menu');
    }
}
