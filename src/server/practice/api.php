<?php

namespace Yar\Server\Practice;
/**
 * 测试Yar Api的练习例子
 * User: NeilZeng<zwjzxh520@gmail.com>
 * Date: 2017/4/4
 * Time: 15:52
 */

class Api
{
    /**
     * return request datetime;
     * @return string
     */
    public function date()
    {
        return 'return '.date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    }

    /**
     * echo request datetime;
     */
    public function echoDate()
    {
        echo 'echo '. date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    }

    /**
     * 强制等待1秒
     * @return string
     */
    public function wait()
    {
        sleep(1);
        return 'wait finish';
    }

    /**
     * 将接收到的参数返回
     * @param $params
     * @return mixed
     */
    public function params($params)
    {
        return $params;
    }

    /**
     * 返回数组
     * @return array
     */
    public function returnArr()
    {
        return ['returnArr'];
    }

    /**
     * 让服务器sleep指定时间
     * @param $sleep
     * @return string
     */
    public function sleep($sleep)
    {
        $sleep = (int)$sleep;
        if ($sleep >= 0) {
            sleep($sleep);
        }
        return 'sleep '.$sleep;
    }

    /**
     * 对用户隐藏的方法
     */
    protected function userHide()
    {

    }
}