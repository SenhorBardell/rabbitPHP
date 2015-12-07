<?php namespace RabbitPHP\Worker;

use RabbitPHP\Adapter;

abstract class Generic {

    private $adapter;

    function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    function resolveJob() {
        // pull
        // if exists fire else fallback
        // confirm
    }

    abstract function fallback($args);

}
