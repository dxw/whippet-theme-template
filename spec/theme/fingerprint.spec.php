<?php

namespace Dxw\MyTheme\Theme;

use \phpmock\mockery\PHPMockery;

describe(Fingerprint::class, function () {
    beforeEach(function () {
        $this->root = \org\bovigo\vfs\vfsStream::setup()->url();
        mkdir($this->root.'/static');
        file_put_contents($this->root.'/static/fingerprint.json', json_encode([
            'rewrittenFiles' => [
                'static/foo.bar' => 'static/foo-123.bar',
            ],
        ]));
        $this->fingerprint = new Fingerprint($this->root.'/static/fingerprint.json');
    });

    afterEach(function () {
        \Mockery::close();
    });

    describe('->get()', function () {
        it('fetches file path', function () {
            $file = $this->fingerprint->get('static/foo.bar');
            expect($file)->to->equal('static/foo-123.bar');
        });
    });
});
