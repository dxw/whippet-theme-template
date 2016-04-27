<?php

require __DIR__.'/../vendor.phar';

// Autoload
$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('MyTheme', __DIR__);

return \MyTheme\Registrar::getInstance();
