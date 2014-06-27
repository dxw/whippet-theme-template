<?php

add_action('init', function () {
  remove_action('wp_enqueue_scripts', 'roots_scripts', 100); // TODO: roots_scripts?
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('_jquery', get_template_directory_uri().'/assets/js/jquery.min.js'); // TODO: How do we handle jQuery and because we can't compile it with everything else
  wp_enqueue_script('main', get_template_directory_uri().'/assets/js/main.min.js', array(), false, true);
  wp_enqueue_style('main', get_stylesheet_directory_uri().'/assets/css/main.min.css');
});
