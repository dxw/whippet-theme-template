<?php

namespace MyTheme;

class Registrar
{
    public function __construct()
    {
        $this->di = [];

        # Superglobals
        $this->di['POST'] = stripslashes_deep($_POST);
        $this->di['GET'] = stripslashes_deep($_GET);

        // Libraries and support code
        $this->di['MyTheme\\Lib\\Whippet\\Layout'] = new \MyTheme\Lib\Whippet\Layout();
        $this->di['MyTheme\\Lib\\RootsWalkerComment'] = new \MyTheme\Lib\RootsWalkerComment();

        // WordPress core behaviour adjustments
        $this->di['MyTheme\\CoreBehaviour'] = new \MyTheme\CoreBehaviour();

        // Theme behaviour, media, assets and template tags
        $this->di['MyTheme\\Theme\\Scripts'] = new \MyTheme\Theme\Scripts();
        $this->di['MyTheme\\Theme\\Media'] = new \MyTheme\Theme\Media();
        $this->di['MyTheme\\Theme\\Menus'] = new \MyTheme\Theme\Menus();
        $this->di['MyTheme\\Theme\\Widgets'] = new \MyTheme\Theme\Widgets();
        $this->di['MyTheme\\Theme\\Helpers'] = new \MyTheme\Theme\Helpers();

        // Post types and additional fields
        $this->di['MyTheme\\Posts\\PostTypes'] = new \MyTheme\Posts\PostTypes();
        $this->di['MyTheme\\Posts\\CustomFields'] = new \MyTheme\Posts\CustomFields();
    }

    public function register()
    {
        // Libraries and support code
        $this->di['MyTheme\\Lib\\Whippet\\Layout']->register();
        $this->di['MyTheme\\Lib\\RootsWalkerComment']->register();

        // WordPress core behaviour adjustments
        $this->di['MyTheme\\CoreBehaviour']->register();

        // Theme behaviour, media, assets and template tags
        $this->di['MyTheme\\Theme\\Scripts']->register();
        $this->di['MyTheme\\Theme\\Media']->register();
        $this->di['MyTheme\\Theme\\Menus']->register();
        $this->di['MyTheme\\Theme\\Widgets']->register();
        $this->di['MyTheme\\Theme\\Helpers']->register();

        // Post types and additional fields
        $this->di['MyTheme\\Posts\\PostTypes']->register();
        $this->di['MyTheme\\Posts\\CustomFields']->register();
    }

    public static function getInstance()
    {
        global $dxw_eventbritesync_registrar;
        if (!isset($dxw_eventbritesync_registrar)) {
            $dxw_eventbritesync_registrar = new self();
        }

        return $dxw_eventbritesync_registrar;
    }
}
