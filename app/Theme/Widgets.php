<?php

namespace MyTheme\Theme;

class Widgets
{
    /**
     * Register sidebars
     */

    public static function widgets_init() {

      register_sidebar(array(
        'name'          => __('Primary'),
        'id'            => 'sidebar-primary',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
      ));

      register_sidebar(array(
        'name'          => __('Footer'),
        'id'            => 'sidebar-footer',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
      ));
    }

    public static function register()
    {
        add_action('widgets_init', 'widgets_init');
    }
}
