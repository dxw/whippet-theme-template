<?php

$registrar->addInstance(new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(new \Dxw\Iguana\Theme\LayoutRegister(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
$registrar->addInstance(new \Dxw\Iguana\Extras\UseAtom());

// Libraries and support code
$registrar->addInstance(new \Dxw\MyTheme\Lib\Whippet\TemplateTags(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

// Theme behaviour, media, assets and template tags
$registrar->addInstance(new \Dxw\MyTheme\Theme\Fingerprint(__DIR__.'/../static/fingerprint.json'));
$registrar->addInstance(new \Dxw\MyTheme\Theme\Scripts(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class),
    $registrar->getInstance(\Dxw\MyTheme\Theme\Fingerprint::class)
));
$registrar->addInstance(new \Dxw\MyTheme\Theme\Media());
$registrar->addInstance(new \Dxw\MyTheme\Theme\Menus());
$registrar->addInstance(new \Dxw\MyTheme\Theme\Widgets());
$registrar->addInstance(new \Dxw\MyTheme\Theme\Analytics());
$registrar->addInstance(new \Dxw\MyTheme\Theme\TitleTag());
$registrar->addInstance(new \Dxw\MyTheme\Theme\Pagination(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

// Post types and additional fields
$registrar->addInstance(new \Dxw\MyTheme\Posts\PostTypes());
$registrar->addInstance(new \Dxw\MyTheme\Posts\CustomFields());

// Plugin dependency check - pass in any required plugins
$registrar->addInstance(new \Dxw\MyTheme\Theme\Plugins([
//    'advanced-custom-fields/acf.php', // Path to main plugin file
]));
