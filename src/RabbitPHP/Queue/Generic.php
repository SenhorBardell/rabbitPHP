<?php namespace Queue;

abstract class Generic {

    public $name;

    function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Pushes the job onto the queue
     *
     * @param $job
     * @param $params
     */
    protected function toQueue($job, $params) {
        $this->adapter->push($this->name, [
            'job' => $job,
            'params' => $params
        ]);
    }

}