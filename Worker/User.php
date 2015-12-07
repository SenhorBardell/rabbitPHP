<?php

class User extends Worker {

    public $queue = 'user';

    function fallback($args) {
    }

    function job($args) {
        extract($args);
    }
}
