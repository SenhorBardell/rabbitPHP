<?php namespace RabbitPHP;

interface API {

    function get($path, $params = []);

    function post($path, $params = []);

    function put($path, $params = []);

    function delete($path, $params = []);

}

class Request implements API {

    private $request;

    function __construct() {
        $this->request = curl_init();
        curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->request, CURLOPT_HTTPHEADER, ['Content-type', 'application/json']);
    }

    function get($path, $params = []) {
        $this->init($path, $params);

        return $this->execute();
    }

    function post($path, $params = []) {
        $this->init($path, $params, 'POST');

        return $this->execute();
    }

    function put($path, $params = []) {
        $this->init($path, $params, 'PUT');

        return $this->execute();
    }

    function delete($path, $params = []) {
        $this->init($path, $params, 'DELETE');

        return $this->execute();
    }

    private function init($path, $params = [], $type = 'GET') {
        curl_setopt($this->request, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($this->request, CURLOPT_URL, $path);

        if ($params)
            curl_setopt($this->request, CURLOPT_POSTFIELDS, json_encode($params));
    }

    private function execute() {
        $output = json_decode(curl_exec($this->request));
        curl_close($this->request);

        return $output;
    }
}