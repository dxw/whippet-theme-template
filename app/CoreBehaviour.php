<?php

namespace Dxw\MyTheme;

//
// Make Atom the default feed format, and remove other formats from <head>
//

class CoreBehaviour implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        add_action('init', [$this, 'init']);
        add_action('wp_head', [$this, 'wpHead']);
    }

    public function init()
    {
        add_filter('default_feed', [$this, 'defaultFeed']);

        remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
        remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
        remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
    }

    public function defaultFeed()
    {
        return 'atom';
    }

    public function wpHead()
    {
        ?>
        <link rel="alternate" type="application/atom+xml" title="<?php echo esc_attr(get_bloginfo('name')) ?> Feed" href="<?php echo esc_attr(get_feed_link('atom')) ?>">
        <?php

    }
}
