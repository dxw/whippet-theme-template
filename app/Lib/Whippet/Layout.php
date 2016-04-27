<?php

namespace MyTheme\Lib\Whippet;

//
// Theme wrapper, lifted from Roots, with some modifications. Thanks, Roots! (See: roots.io).
//
class Layout
{
    // Stores the full path to the template file WordPress says we should use
    public static $wordpress_template;

    // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
    public static $base;

    public function __construct($template = 'layouts/main.php')
    {
        $this->slug = basename($template, '.php');
        $this->templates = array($template);

        if (self::$base) {
            $str = substr($template, 0, -4);
            array_unshift($this->templates, sprintf($str.'-%s.php', self::$base));
        }
    }

    public function __toString()
    {
        $this->templates = apply_filters('roots_wrap_'.$this->slug, $this->templates);

        return locate_template($this->templates);
    }

    public function apply($wordpress_template)
    {
        self::$wordpress_template = dirname($wordpress_template).'/'.basename($wordpress_template);
        self::$base = basename(self::$wordpress_template, '.php');

        if (self::$base === 'index') {
            self::$base = false;
        }

        return new self();
    }

    public function register()
    {
        add_filter('template_include', array($this, 'apply'), 99);
    }
}
