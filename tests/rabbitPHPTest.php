<?php

class rabbitPHPTest extends \PHPUnit_Framework_TestCase {

    function setUp() {
        $userWorker = new RabbitPHP\Worker\User();
        var_dump($userWorker);
        die();
    }

    function testSomething() {

    }

}