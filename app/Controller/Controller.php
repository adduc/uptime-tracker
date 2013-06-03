<?php

namespace Adduc\Uptime\Controller;
use Adduc\Uptime\Exception;

abstract class Controller {

    protected $url_segments;

    public function run($url_segments) {
        $this->url_segments = $url_segments;
        $action = $this->identifyMethod();
        $action();
    }

    function identifyMethod() {
        $method = isset($url_segments[1])
            ? $url_segments[1] : 'indexAction';
        if(!method_exists($this, $method)) {
            throw new Exception\MethodNotFound();
        }
        return array($this, $method);
    }

}
