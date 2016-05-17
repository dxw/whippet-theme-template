<?php

namespace Dxw\MyTheme\Theme;

class Helpers implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        add_action('wp_footer', [$this, 'wpFooter']);
    }

    public function wpFooter()
    {
        ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'TRACKING_CODE']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
        <?php

    }
}
