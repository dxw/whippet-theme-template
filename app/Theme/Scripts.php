<?php

namespace Dxw\MyTheme\Theme;

class Scripts implements \Dxw\Iguana\Registerable
{
    public function __construct(\Dxw\Iguana\Theme\Helpers $helpers)
    {
        $helpers->registerFunction('assetPath', [$this, 'getUri']);
    }

    public function register()
    {
        add_action('wp_enqueue_scripts', [$this, 'wpEnqueueScripts']);
        add_action('wp_print_scripts', [$this, 'wpPrintScripts']);
    }

    public function getUri($path)
    {
        return dirname(get_stylesheet_directory_uri()).'/build/'.$path;
    }

    public function wpEnqueueScripts()
    {
        //
        // Do not add javascript to your theme here, unless you're sure you should.
        //
        // Normally, you should add Javascript to assets/js/main.js or make a file in assets/js/plugins.
        //
        // You can/should enqueue a script here only if it is a widely used library that is required by a plugin (or is likely to be later)
        //

        // We need to register our own jQuery, because WP is on jQuery 2.x which breaks support for IE 6-8.
        // This will not affect admin pages
        // This will break any plugin that requires a feature/behaviour in jQuery 2.x which is missing/different in jQuery 1.10.x
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery',   $this->getUri('lib/jquery.min.js'));

        // Because it's awesome
        wp_enqueue_script('modernizr', $this->getUri('lib/modernizr.min.js'));

        // Pretty much everything else should be compiled by Grunt.
        wp_enqueue_script('main',      $this->getUri('main.min.js'), array('jquery', 'modernizr'), '', true);

        wp_enqueue_style('main',      $this->getUri('main.min.css'));
    }

    public function wpPrintScripts()
    {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Prefetch external asset dns -->
        <link rel="dns-prefetch" href="#">

        <!-- Prefetch internal image assets -->
        <link rel="prefetch" href="#">

        <link rel="apple-touch-icon-precomposed" href="<?php echo esc_attr($this->getUri('img/apple-touch-icon-precomposed.png')) ?>">

        <link rel="icon" type="image/png" href="<?php echo esc_attr($this->getUri('img/shortcut-icon.png')) ?>">
        <?php

    }
}
