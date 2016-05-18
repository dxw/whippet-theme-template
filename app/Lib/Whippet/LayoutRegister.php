<?php

namespace Dxw\MyTheme\Lib\Whippet;

class LayoutRegister implements \Dxw\Iguana\Registerable
{
    public function __construct(\Dxw\Iguana\Theme\Helpers $helpers)
    {
        $helpers->registerFunction('w_requested_template', [$this, 'wRequestedTemplate']);
    }

    public function register()
    {
        add_filter('template_include', array(\Dxw\MyTheme\Lib\Whippet\Layout::class, 'apply'), 99);
    }

    public function wRequestedTemplate()
    {
        require \Dxw\MyTheme\Lib\Whippet\Layout::$wordpress_template;
    }
}
