<?php

namespace Adduc\Uptime;

include(dirname(__DIR__) . '/Vendor/autoload.php');

$ic = function($segments) {

    switch($segments[0]) {
        case '': return new Controller\Index();
        default: throw new Exception\ControllerNotFound();
    }

};

try {

    $segments = isset($_GET['p']) ? $_GET['p'] : '/';
    $segments = explode("/", ltrim($segments, '/'));

    $c = $ic($segments);
    $c->run($segments);

} catch(\Exception $e) {
    $c = new Controller\Exception();
    $c->run($segments, $e);
}
