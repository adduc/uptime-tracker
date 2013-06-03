<?php

namespace Adduc\Uptime\Controller;

class Exception extends Controller {

    protected $exception;

    public function setException() {

    }

    public function identifyMethod() {
        return array($this, "errorAction");
    }

    public function errorAction() {

    }

}
