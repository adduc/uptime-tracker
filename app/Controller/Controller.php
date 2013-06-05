<?php

namespace Adduc\Uptime\Controller;
use Adduc\Uptime\Exception;
use Adduc\Uptime\Core;

abstract class Controller {

    protected
        $url_segments,
        $view = array(
            'class' => null,
            'view' => null,
            'layout' => null,
            'vars' => array()
        ),
        $config;

    public function run($url_segments) {
        $this->url_segments = $url_segments;
        $action = $this->identifyMethod();
        $action();
        $this->view['class'] = is_object($this->view['class'])
            ? $this->view['class'] : new Core\View();
        $this->config = $this->config instanceof Core\Config ? $this->config
            : new Core\Config(dirname(__DIR__) . '/Config/config.ini');
    }

    function identifyMethod() {
        $method = isset($url_segments[1]) && $url_segments[1]
            ? "{$url_segments[1]}Action" : 'indexAction';
        if(!method_exists($this, $method)) {
            throw new Exception\MethodNotFound();
        }
        return array($this, $method);
    }

    function set(array $data) {
        $this->viewVars = array_merge_recursive($this->viewVars, $data);
    }

}
