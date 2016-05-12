<?php

require __DIR__.'/../vendor.phar';

$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('Dxw\\MyTheme', __DIR__);

$registrar = \Dxw\MyTheme\Registrar::getSingleton();
$registrar->di(__DIR__.'/di.php');

return $registrar;
