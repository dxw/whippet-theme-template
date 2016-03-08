<?php

namespace MyTheme\Theme;

class Menus
{
    public static function register()
    {
        register_nav_menu( 'header', 'Header Menu' );
        register_nav_menu( 'footer', 'Footer Menu' );
    }
}
