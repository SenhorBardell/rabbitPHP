<?php namespace Queue;

class User extends Generic {

    const JOB = 'job';

    function job($param1, $param2) {
        $this->toQueue($this::JOB, ['param1' => $param1, 'param2' => $param2]);
    }

}