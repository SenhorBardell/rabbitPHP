<?php namespace Worker;

abstract class Worker {

    public $queue;

    function __construct($queue) {
        $this->queue = $queue;
    }

    function resolveJob() {
        $this->queue->pull($this->queue, function ($message) {
            $body = json_decode($message->body, true);
            if (isset($body['job'])) {
                if (method_exists($this, $body['job'])) {
                    $this->$body['job']($body['params']);
                }
            } else {
                if (method_exists($this, 'default')) {
                    $this->fallback($body['params']);
                }
            }
            $this->queue->confirm($message->delivery_info['delivery_tag']);
        });
        $this->queue->listen();
    }

    abstract function fallback($args);

}
