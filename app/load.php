<?php

require __DIR__.'/../vendor.phar';

$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('Dxw\\MyTheme', __DIR__);

$registrar = \Dxw\MyTheme\Registrar::getSingleton();
$registrar->di(__DIR__.'/di.php');

function h()
{
    return \Dxw\MyTheme\Registrar::getSingleton()->getInstance('Dxw\\MyTheme\\Helpers');
}

return $registrar;
