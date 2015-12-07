<?php namespace RabbitPHP\Worker;

class User extends Generic {

    public $queue = 'user';

    function fallback($args) {
    }

    function job($args) {
        extract($args);
    }
}
