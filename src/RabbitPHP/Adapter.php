<?php namespace RabbitPHP;

interface Queue {

    function push();

    function pull();

    function confirm();

    function listen();

    function close();

}

class Adapter implements Queue {

    function __construct($request) {
        $this->request = $request;
    }

    function push() {
        // TODO: Implement push() method.
    }

    function pull() {
        // TODO: Implement pull() method.
    }

    function confirm() {
        // TODO: Implement confirm() method.
    }

    function listen() {
        // TODO: Implement listen() method.
    }

    function close() {
        // TODO: Implement close() method.
    }
}
