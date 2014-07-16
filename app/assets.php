<?php

add_action('init', function () {
  remove_action('wp_enqueue_scripts', 'roots_scripts', 100);
});

add_action('wp_enqueue_scripts', function () {
  
  /**
   *  DO NOT ADD THINGS HERE
   *  Unless they are very commonly used and may also be included by plugins (libraries such as jquery, for example)
   *  Everything else should be included in the gruntfile or in the js directory so that it is compiled into main.min.js
   **/
  wp_enqueue_script('_jquery',   get_template_directory_uri() . '/build/bower_components/jquery/jquery.min.js' );
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/head/modernizr.min.js'             );
  wp_enqueue_script('main',      get_template_directory_uri() . '/build/main.min.js', array('_jquery', 'modernizr'), '', true);

  wp_enqueue_style ('main',      get_stylesheet_directory_uri() . '/build/main.min.css');
});
