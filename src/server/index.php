<?php

namespace Yar\Server;

define('IN_SERVER', 1);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class Index
{
    public static function router()
    {
        $method = $_GET['m']?:'';
        return 'Yar\\Server\\'.ucfirst($method);
    }

    /**
     * 显示所有的方法
     */
    public function allMehtod()
    {

    }
}

$class = Index::router();
if ($class != 'Yar\\Server\\Index' && class_exists($class)) {
    $service = new \Yar_Server(new $class);
    $service->handle();
} else {
    header('HTTP/1.1 404 Not Found');
}
