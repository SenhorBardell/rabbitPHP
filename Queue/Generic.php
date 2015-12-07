<?php


abstract class Generic {

    /** @var Queue */
    public $queue;

    public $name;

    function __construct($queue) {
        $this->queue = $queue;
    }

    /**
     * Pushes the job onto the queue
     *
     * @param $job
     * @param $params
     */
    protected function toQueue($job, $params) {
        $this->queue->push($this->queue, [
            'job' => $job,
            'params' => $params
        ]);
    }

}