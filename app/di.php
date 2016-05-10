<?php

require __DIR__.'/../vendor.phar';

// Autoload
$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('Dxw\\MyTheme', __DIR__);

return \Dxw\MyTheme\Registrar::getInstance();
