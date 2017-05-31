<?php

class Walker_Comment
{
}

describe(\Dxw\MyTheme\Lib\RootsWalkerComment::class, function () {
    beforeEach(function () {
        \WP_Mock::setUp();
        $this->rootsWalkerComment = new \Dxw\MyTheme\Lib\RootsWalkerComment();
    });

    afterEach(function () {
        \WP_Mock::tearDown();
    });

    it('extends the comment walker', function () {
        expect($this->rootsWalkerComment)->to->be->an->instanceof(Walker_Comment::class);
    });

    it('is registrable', function () {
        expect($this->rootsWalkerComment)->to->be->an->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers filters', function () {
            \WP_Mock::expectFilterAdded('get_avatar', [$this->rootsWalkerComment, 'rootsGetAvatar'], 10, 2);
            $this->rootsWalkerComment->register();
        });
    });

    describe('->rootsGetAvatar()', function () {
        it('gets the avatar', function () {
            $result = $this->rootsWalkerComment->rootsGetAvatar('a', 'b');
            expect($result)->to->be->equal('a');
        });
    });

    describe('->rootsGetAvatar()', function () {
        it('gets the avatar', function () {
            $result = $this->rootsWalkerComment->rootsGetAvatar('a', 'b');
            expect($result)->to->be->equal('a');
        });

        context('when given an object', function () {
            it('displays a media object', function () {
                $result = $this->rootsWalkerComment->rootsGetAvatar("AAAclass='avatarBBB", (object)[]);
                expect($result)->to->be->equal("AAAclass='avatar pull-left media-objectBBB");
            });
        });
    });

    describe('->start_lvl()', function () {
        xit('displays the html at the start of the comment level', function () {
            $this->rootsWalkerComment->start_lvl();
        });
    });

    describe('->end_lvl()', function () {
        xit('displays the html at the end of the comment level', function () {
            $this->rootsWalkerComment->start_lvl();
        });
    });

    describe('->start_el()', function () {
        xit('displays the html at the start of the element', function () {
            $this->rootsWalkerComment->start_lvl();
        });
    });

    describe('->end_el()', function () {
        xit('displays the html at the end of the element', function () {
            $this->rootsWalkerComment->start_lvl();
        });
    });
});
