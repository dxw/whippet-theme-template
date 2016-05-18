<?php

class Theme_Helpers_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testRegister()
    {
        $helpers = new \Dxw\MyTheme\Theme\Helpers();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $helpers);

        \WP_Mock::expectActionAdded('wp_footer', [$helpers, 'wpFooter']);

        $helpers->register();
    }

    public function testWpFooter()
    {
        $helpers = new \Dxw\MyTheme\Theme\Helpers();

        $this->expectOutputString(implode("\n", [
            '        <script type="text/javascript">',
            '            var _gaq = _gaq || [];',
            "            _gaq.push(['_setAccount', 'TRACKING_CODE']);",
            "            _gaq.push(['_trackPageview']);",
            '',
            '            (function() {',
            "                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;",
            "                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';",
            "                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);",
            '            })();',
            '        </script>',
            '        ',
        ]));

        $helpers->wpFooter();
    }
}
