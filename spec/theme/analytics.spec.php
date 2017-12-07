<?php

describe(\Dxw\MyTheme\Theme\Analytics::class, function () {
    beforeEach(function () {
        \WP_Mock::setUp();
        $this->analytics = new \Dxw\MyTheme\Theme\Analytics();
    });

    afterEach(function () {
        \WP_Mock::tearDown();
    });

    it('is registrable', function () {
        expect($this->analytics)->to->be->an->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers actions', function () {
            WP_Mock::expectActionAdded('wp_footer', [$this->analytics, 'wpFooter']);
            $this->analytics->register();
        });
    });

    describe('->wpFooter()', function () {
        it('adds HTML to the footer', function () {
            ob_start();
            $this->analytics->wpFooter();
            $result = ob_get_contents();
            ob_end_clean();
            expect($result)->to->be->equal(implode("\n", [
                '        <script>',
                "            var TRACKING_CODE = ''; //Put the Google Analytics tracking code here",
                '            if (!TRACKING_CODE.length) {',
                "                console.warn('Google Analytics requires a tracking code to function correctly');",
                "            }",
                '            (function() {',
                "                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;",
                "                ga.src = 'https://www.googletagmanager.com/gtag/js?id=' + TRACKING_CODE;",
                "                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);",
                "            })();",
                '            window.dataLayer = window.dataLayer || [];',
                '            function gtag(){dataLayer.push(arguments)};',
                "            gtag('js', new Date());",
                "            gtag('config', TRACKING_CODE);",
                "        </script>",
                '        ',
            ]));
        });
    });
});
