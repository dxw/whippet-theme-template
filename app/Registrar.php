<?php

namespace Dxw\MyTheme;

class Registrar
{
    protected static $singleton;

    public function __construct()
    {
        $this->di = [];

        # Superglobals
        $this->di['POST'] = stripslashes_deep($_POST);
        $this->di['GET'] = stripslashes_deep($_GET);

        // Libraries and support code
        $this->di['Dxw\\MyTheme\\Lib\\Whippet\\Layout'] = new \Dxw\MyTheme\Lib\Whippet\Layout();
        $this->di['Dxw\\MyTheme\\Lib\\RootsWalkerComment'] = new \Dxw\MyTheme\Lib\RootsWalkerComment();

        // WordPress core behaviour adjustments
        $this->di['Dxw\\MyTheme\\CoreBehaviour'] = new \Dxw\MyTheme\CoreBehaviour();

        // Theme behaviour, media, assets and template tags
        $this->di['Dxw\\MyTheme\\Theme\\Scripts'] = new \Dxw\MyTheme\Theme\Scripts();
        $this->di['Dxw\\MyTheme\\Theme\\Media'] = new \Dxw\MyTheme\Theme\Media();
        $this->di['Dxw\\MyTheme\\Theme\\Menus'] = new \Dxw\MyTheme\Theme\Menus();
        $this->di['Dxw\\MyTheme\\Theme\\Widgets'] = new \Dxw\MyTheme\Theme\Widgets();
        $this->di['Dxw\\MyTheme\\Theme\\Helpers'] = new \Dxw\MyTheme\Theme\Helpers();

        // Post types and additional fields
        $this->di['Dxw\\MyTheme\\Posts\\PostTypes'] = new \Dxw\MyTheme\Posts\PostTypes();
        $this->di['Dxw\\MyTheme\\Posts\\CustomFields'] = new \Dxw\MyTheme\Posts\CustomFields();
    }

    public function register()
    {
        // Libraries and support code
        $this->di['Dxw\\MyTheme\\Lib\\Whippet\\Layout']->register();
        $this->di['Dxw\\MyTheme\\Lib\\RootsWalkerComment']->register();

        // WordPress core behaviour adjustments
        $this->di['Dxw\\MyTheme\\CoreBehaviour']->register();

        // Theme behaviour, media, assets and template tags
        $this->di['Dxw\\MyTheme\\Theme\\Scripts']->register();
        $this->di['Dxw\\MyTheme\\Theme\\Media']->register();
        $this->di['Dxw\\MyTheme\\Theme\\Menus']->register();
        $this->di['Dxw\\MyTheme\\Theme\\Widgets']->register();
        $this->di['Dxw\\MyTheme\\Theme\\Helpers']->register();

        // Post types and additional fields
        $this->di['Dxw\\MyTheme\\Posts\\PostTypes']->register();
        $this->di['Dxw\\MyTheme\\Posts\\CustomFields']->register();
    }

    public static function getInstance()
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}
