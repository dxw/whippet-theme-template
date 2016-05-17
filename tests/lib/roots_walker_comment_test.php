<?php

class Walker_Comment
{
}

class Lib_RootsWalkerComment_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testExtends()
    {
        $rootsWalkerComment = new \Dxw\MyTheme\Lib\RootsWalkerComment();

        $this->assertInstanceOf(\Walker_Comment::class, $rootsWalkerComment);
    }

    public function testRegister()
    {
        $rootsWalkerComment = new \Dxw\MyTheme\Lib\RootsWalkerComment();

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $rootsWalkerComment);

        \WP_Mock::expectFilterAdded('get_avatar', [$rootsWalkerComment, 'rootsGetAvatar'], 10, 2);

        $rootsWalkerComment->register();
    }

    public function testRootsGetAvatarNotObject()
    {
        $rootsWalkerComment = new \Dxw\MyTheme\Lib\RootsWalkerComment();

        $this->assertEquals(
            'a',
            $rootsWalkerComment->rootsGetAvatar('a', 'b')
        );
    }

    public function testRootsGetAvatarUseObject()
    {
        $rootsWalkerComment = new \Dxw\MyTheme\Lib\RootsWalkerComment();

        $this->assertEquals(
            "AAAclass='avatar pull-left media-objectBBB",
            $rootsWalkerComment->rootsGetAvatar("AAAclass='avatarBBB", (object) [])
        );
    }

    // public function start_lvl(&$output, $depth = 0, $args = array())
    public function testStartLvl()
    {
        $this->markTestIncomplete();
    }

    // public function end_lvl(&$output, $depth = 0, $args = array())
    public function testEndLvl()
    {
        $this->markTestIncomplete();
    }

    // public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
    public function testStartEl()
    {
        $this->markTestIncomplete();
    }

    // public function end_el(&$output, $comment, $depth = 0, $args = array())
    public function testEndEl()
    {
        $this->markTestIncomplete();
    }
}
