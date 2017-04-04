<?php

namespace Yar\Client;
/**
 * 练习Yar客户端的调用
 * User: NeilZeng<zwjzxh520@gmail.com>
 * Date: 2017/4/4
 * Time: 16:21
 */

define('IN_SERVER', 1);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

define('YAR_SERVER', 'http://yar.localhost.dev/src/server/?m=');

$methods = [
    'Practice\api' => [
        'date' => [],
        'echoDate' => [],
        'wait' => [],
        'params' => ['白天不懂夜的黑'],
        'returnArr' => [],
        'sleep' => [1],
    ],
];

$types = [
    'sync',
    'rsync',
];

foreach ($types as $type) {
    echo 'start run [' . $type . ']<br />';
    $startTime = microtime(1);
    $clsName = 'Yar\\Client\\' . $type;
    $c = new $clsName;
    $c->go(YAR_SERVER, $methods);
    echo "run [{$type}] done! cost time: " . (microtime(1) - $startTime) . '<br /><br />';
}

