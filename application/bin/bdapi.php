<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/6/5
 * Time: 1:42
 */

namespace app\bin;
use app\model;

define("CURL_TIMEOUT",   10);
define("URL",            "http://api.fanyi.baidu.com/api/trans/vip/translate");
define("APP_ID",         "20180604000171655"); //替换为您的APPID
define("SEC_KEY",        "qJ_e3_FvOrtjA6j4EJKk");//替换为您的密钥


class bdapi
{
    //翻译入口
    function  aa($q){
        $to='zh';
        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $q)>0){ //如果含中文
            $to='en';
        }
        $salt = rand(10000, 99999);
        $key = 'qJ_e3_FvOrtjA6j4EJKk';
        $appid = '20180604000171655';
        $str = $appid . $q . $salt . $key;
        $sign = md5($str);
        $postdata = http_build_query(
            array(
                'q' => $q,

                'from' => 'auto',

                'to' => $to,

                'appid' => $appid,

                'salt' => $salt,

                'sign' => $sign
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents('https://fanyi-api.baidu.com/api/trans/vip/translate', false, $context);

        return $result;
    }
}