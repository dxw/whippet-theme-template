<?php

require __DIR__.'/../vendor.phar';

$loader = new \Aura\Autoload\Loader();
$loader->register();
$loader->addPrefix('Dxw\\MyTheme', __DIR__);

$registrar = \Dxw\Iguana\Registrar::getSingleton();
$registrar->di(__DIR__.'/di.php');

function h()
{
    return \Dxw\Iguana\Registrar::getSingleton()->getInstance('Dxw\\Iguana\\Helpers');
}

return $registrar;
