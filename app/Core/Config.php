<?php

namespace Adduc\Uptime\Core;
use Adduc\Uptime\Exception;

class Config extends Container {

    protected $defaults = array(
        'cookie_name' => '_'
    );

    public function __construct($file = null) {
        $this->data = $this->defaults;
        is_null($file) || $this->loadFile($file);
    }

    public function loadFile($file) {
        $data = @parse_ini_file($file, true);
        if(!$data) {
            $msg = "Config file doesn't exist or is not readable.";
            throw new Exception\ConfigNotFound($msg);
        }
        $this->data = $this->defaults;
        $this->offsetSet(null, $data);
    }

}
