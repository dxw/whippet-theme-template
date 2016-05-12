<?php

class Helpers_Test extends PHPUnit_Framework_TestCase
{
    public function testRegisterFunction()
    {
        $helpers = new \Dxw\MyTheme\Helpers();

        $helpers->registerFunction('myFunc', function () {
            return 42;
        });

        $this->assertEquals(42, $helpers->myFunc());
    }

    public function testFunctionArguments()
    {
        $helpers = new \Dxw\MyTheme\Helpers();

        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });

        $this->assertEquals(48, $helpers->anotherFunc(1, 5));
    }
}
