<?php

set_post_thumbnail_size( 150, 150, true );
add_image_size( 'medium', 200, 200, true );
add_image_size( 'large', 800, 300, true );

add_theme_support( 'post-thumbnails' );

// Removes width and height from images so the scale nicely
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );