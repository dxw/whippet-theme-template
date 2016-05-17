<?php

class Theme_Pagination_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function getHelpers()
    {
        $helpers = $this->getMockBuilder(\Dxw\Iguana\Theme\Helpers::class)
        ->disableOriginalConstructor()
        ->getMock();

        return $helpers;
    }

    public function testInstantiate()
    {
        $helpers = $this->getHelpers();

        $helpers->expects($this->exactly(1))
        ->method('registerFunction')
        ->will($this->returnCallback(function ($a, $b) {
            $this->assertEquals('pagination', $a);
            $this->assertCount(2, $b);
            $this->assertInstanceOf(\Dxw\MyTheme\Theme\Pagination::class, $b[0]);
            $this->assertEquals('pagination', $b[1]);
        }));

        $pagination = new \Dxw\MyTheme\Theme\Pagination($helpers);
    }

    public function testPagination()
    {
        $pagination = new \Dxw\MyTheme\Theme\Pagination($this->getHelpers());

        $this->markTestIncomplete();

        $pagination->pagination();
    }
}
