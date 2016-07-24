<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/24
 * Time: 19:53
 */

/**
 * 发起HTTP请求
 * @param $url
 * @param string $post_data
 * @param int $timeout
 * @return mixed
 */

function post($url, $post_data = '', $timeout = 5){//curl
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    if($post_data != ''){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    return $file_contents;
}

function getAccessToken($code){
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb096e505f9556191&secret=d4624c36b6795d1d99dcf0547af5443d&code={$code}&grant_type=authorization_code";
    return json_decode(post($url));
}

function getUserInfo($accessToken, $openId){
    $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openId}&lang=zh_CN";
    return json_decode(post($url));
}