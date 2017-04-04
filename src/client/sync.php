<?php

namespace Yar\Client;
/**
 * 串行调用练习
 * User: NeilZeng<zwjzxh520@gmail.com>
 * Date: 2017/4/4
 * Time: 16:33
 */


class Sync
{
    public function go($server, $methods)
    {
        foreach($methods as $api  =>  $m) {
            $client = new \Yar_Client($server.urlencode($api));
            $client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 10000);
            foreach( $m as $method => $params) {
                $result = call_user_func_array([$client, $method], $params);

                echo "$method(".implode(',', $params).") result: ".var_export($result, 1). '<br />';
            }
        }
    }
}

