<?php

/*
 * Libraries and support code
 */

require __DIR__ . '/lib/whippet/whippet.php';
require __DIR__ . '/lib/roots_walker_comment.class.php';


/*
 * Media, assets and WordPress core behaviour adjustments
 */

require __DIR__ . '/core_behaviour.php';


/*
 * Theme behaviour and template tags
 */

require __DIR__ . '/scripts.php';
require __DIR__ . '/media.php';
require __DIR__ . '/menus.php';
require __DIR__ . '/widgets.php';
require __DIR__ . '/helpers.php';
require __DIR__ . '/pagination.php';
require __DIR__ . '/titles.php';


/*
 * Post types and additional fields
 */

require __DIR__ . '/post_types.php';
require __DIR__ . '/custom_fields.php';
