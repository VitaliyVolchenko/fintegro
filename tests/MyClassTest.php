<?php
require_once 'PHPUnit/Framework.php';
require_once 'MyClass.php';

class MyClassTest extends PHPUnit_Framework_TestCase {
    public function testPower()
    {
        $my = new MyClass();
        $this->assertEquals(8, $my->power(2, 3));
    }
}