<?php

require __DIR__.'/../vendor.phar';

// Autoload
$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('MyTheme', __DIR__);

//
// Libraries and support code
//

\MyTheme\Lib\Whippet\Layout::register();

\MyTheme\Lib\RootsWalkerComment::register();

//
// WordPress core behaviour adjustments
//

\MyTheme\CoreBehaviour::register();

//
// Theme behaviour, media, assets and template tags
//

\MyTheme\Theme\Scripts::register();
\MyTheme\Theme\Media::register();
\MyTheme\Theme\Menus::register();
\MyTheme\Theme\Widgets::register();

\MyTheme\Theme\Helpers::register();  ## Needs more stuffs

//
// Post types and additional fields
//

\MyTheme\Posts\PostTypes::register();
\MyTheme\Posts\CustomFields::register();
