<?php

$registrar->addInstance(\Dxw\Iguana\Theme\Helpers::class, new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(\Dxw\Iguana\Theme\LayoutRegister::class, new \Dxw\Iguana\Theme\LayoutRegister(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
$registrar->addInstance(\Dxw\Iguana\Extras\UseAtom::class, new \Dxw\Iguana\Extras\UseAtom());

// Libraries and support code
$registrar->addInstance(\Dxw\MyTheme\Lib\Whippet\TemplateTags::class, new \Dxw\MyTheme\Lib\Whippet\TemplateTags(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

// Theme behaviour, media, assets and template tags
$registrar->addInstance(\Dxw\MyTheme\Theme\Scripts::class, new \Dxw\MyTheme\Theme\Scripts(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
$registrar->addInstance(\Dxw\MyTheme\Theme\Media::class, new \Dxw\MyTheme\Theme\Media());
$registrar->addInstance(\Dxw\MyTheme\Theme\Menus::class, new \Dxw\MyTheme\Theme\Menus());
$registrar->addInstance(\Dxw\MyTheme\Theme\Widgets::class, new \Dxw\MyTheme\Theme\Widgets());
$registrar->addInstance(\Dxw\MyTheme\Theme\Helpers::class, new \Dxw\MyTheme\Theme\Helpers());
$registrar->addInstance(\Dxw\MyTheme\Theme\TitleTag::class, new \Dxw\MyTheme\Theme\TitleTag());
$registrar->addInstance(\Dxw\MyTheme\Theme\Pagination::class, new \Dxw\MyTheme\Theme\Pagination(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

// Post types and additional fields
$registrar->addInstance(\Dxw\MyTheme\Posts\PostTypes::class, new \Dxw\MyTheme\Posts\PostTypes());
$registrar->addInstance(\Dxw\MyTheme\Posts\CustomFields::class, new \Dxw\MyTheme\Posts\CustomFields());

// Plugin dependency check - pass in any required plugins
$registrar->addInstance(\Dxw\MyTheme\Theme\Plugins::class, new \Dxw\MyTheme\Theme\Plugins([
//    'advanced-custom-fields/acf.php', // Path to main plugin file
]));
