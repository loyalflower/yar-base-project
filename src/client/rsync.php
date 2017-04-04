<?php

namespace Yar\Client;
    /**
     * 并行调用测试
     * User: NeilZeng<zwjzxh520@gmail.com>
     * Date: 2017/4/4
     * Time: 16:33
     */


    /**
     * Yar_Concurrent_Client::call 参数说明
     * 1. $api url
     * 2. $method 方法
     * 3. $params 方法参数
     * 4. $callBack 执行完毕后无错误时的回调函数
     * 5. $errorCallBack    执行完毕后，有错误发生时的回调函数
     * 6. $options  设置此次Api请求的相关选项。
     *
     * $options 列表：
     * YAR_OPT_PACKAGER     数据打包方式。有三种：php, json, msgpack。默认方式可以通过yar.packager配置查看
     * YAR_OPT_PERSISTENT   是否长连接。默认: off。相应配置：yar.allow_persistent
     * YAR_OPT_TIMEOUT      请求超时时间，单位：ms。默认：5000 ms。对应配置：yar.timeout
     * YAR_OPT_CONNECT_TIMEOUT  请求建立连接超时时间，单位：ms。默认：1000 ms。对应配置：yar.connect_timeout
     */


/**
 * Class Rsync
 * @package Yar\client
 */
class Rsync
{
    public function go($server, $methods)
    {
        foreach ($methods as $api => $m) {
            foreach ($m as $method => $params) {
                \Yar_Concurrent_Client::call($server . $api,
                    $method,
                    $params,
                    [__CLASS__, "callback"],
                    [__CLASS__, "error_callback"],
                    array(YAR_OPT_TIMEOUT => 1)
                );
            }
        }
        \Yar_Concurrent_Client::loop([__CLASS__, "waitForCallBack"], [__CLASS__, "error_callback"]);
    }

    public function waitForCallBack($retval, $callinfo)
    {
        echo '网络正在处理，我先做点别的事情<br />';
        for ($i = 0; $i < 100; $i++) {
            usleep(10000);
        }
        echo '干了比较久的活。期间有没有闲下来做点别的呢<br />';
    }

    public function callback($retval, $callinfo)
    {
        echo "sequence: {$callinfo['sequence']} method: {$callinfo['method']} ";
        var_export($retval);
        echo '<br />';
    }

    public function error_callback($type, $error, $callinfo)
    {
        echo json_encode($callinfo, JSON_UNESCAPED_UNICODE);
        echo "error type: $type, msg: $error. <br />";
    }
}

