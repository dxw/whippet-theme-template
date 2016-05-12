<?php

// Libraries and support code
$registrar->addInstance('Dxw\\MyTheme\\Lib\\Whippet\\Layout', new \Dxw\MyTheme\Lib\Whippet\Layout());
$registrar->addInstance('Dxw\\MyTheme\\Lib\\Whippet\\TemplateTags', new \Dxw\MyTheme\Lib\Whippet\TemplateTags(
    $registrar->getInstance('Dxw\\MyTheme\\Helpers')
));
$registrar->addInstance('Dxw\\MyTheme\\Lib\\RootsWalkerComment', new \Dxw\MyTheme\Lib\RootsWalkerComment());

// WordPress core behaviour adjustments
$registrar->addInstance('Dxw\\MyTheme\\CoreBehaviour', new \Dxw\MyTheme\CoreBehaviour());

// Theme behaviour, media, assets and template tags
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Scripts', new \Dxw\MyTheme\Theme\Scripts(
    $registrar->getInstance('Dxw\\MyTheme\\Helpers')
));
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Media', new \Dxw\MyTheme\Theme\Media());
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Menus', new \Dxw\MyTheme\Theme\Menus());
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Widgets', new \Dxw\MyTheme\Theme\Widgets());
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Helpers', new \Dxw\MyTheme\Theme\Helpers());
$registrar->addInstance('Dxw\\MyTheme\\Theme\\TitleTag', new \Dxw\MyTheme\Theme\TitleTag());
$registrar->addInstance('Dxw\\MyTheme\\Theme\\Pagination', new \Dxw\MyTheme\Theme\Pagination(
    $registrar->getInstance('Dxw\\MyTheme\\Helpers')
));

// Post types and additional fields
$registrar->addInstance('Dxw\\MyTheme\\Posts\\PostTypes', new \Dxw\MyTheme\Posts\PostTypes());
$registrar->addInstance('Dxw\\MyTheme\\Posts\\CustomFields', new \Dxw\MyTheme\Posts\CustomFields());
