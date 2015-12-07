<?php

class Queue {

    /**
     * @var \PhpAmqpLib\Channel\AMQPChannel
     */
    public $channel;
    /**
     * @var \PhpAmqpLib\Connection\AMQPStreamConnection
     */
    private $connection;
    /**
     * @var \PhpAmqpLib\Message\AMQPMessage
     */
    private $message;

    function __construct($connection) {
        $this->connection = $connection;
        $this->channel = $this->connection->channel();
    }

    /**
     * Send a job to a queue
     *
     * @param $queue
     * @param $data [] $job
     * @param $data [] $params
     */
    function push($queue, array $data) {
        $this->message = new \PhpAmqpLib\Message\AMQPMessage();
        $this->message->setBody(json_encode($data));
        $this->message->set('delivery_mode', 2);
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->basic_publish($this->message, '', $queue);
    }

    /**
     * Get a job from queue
     * AMQPMessage in $callback
     *
     * @param $queue
     * @param \Closure $callback
     */
    function pull($queue, $callback) {
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->basic_consume($queue, '', false, false, false, false, $callback);
    }

    function get($queue) {
        return $this->channel->basic_get($queue);
    }

    function confirm($tag) {
        $this->channel->basic_ack($tag);
    }

    function listen() {
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    function close() {
        $this->channel->close();
        $this->connection->close();
    }

}