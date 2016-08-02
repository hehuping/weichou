<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 11:33
 */
namespace Home\Controller;
use Org\Util\String;
use Think\Controller;
use Org\Util\Date;
class LoginController extends Controller {

    public function index(){
        $wuser = M('wuser');
        $info = getUserInfo();

        $data = array(
            'openid' => $info->openid,
            'nickname' => $info->nickname,
            'sex' => $info->sex,
            'province' => $info->province,
            'city' => $info->city,
            'country' => $info->country,
            'headimgurl' => $info->headimgurl,
            'reg_time' => date("Y-m-d H:i:s",time()),
        );

        $has = $wuser->where("openid='{$info->openid}'")->find();
        if(!$has){
            $insert = $wuser->add($data);
            $data['wid'] = $insert;
            $_SESSION['user'] = $data;
        }else{
            $wuser->where("openid='{$info->openid}'")->save(['last_time'=>date('Y-m-d H:i:s')]);
            $_SESSION['user'] = $data;
        }

        $action = I('state');

        $this->redirect("Index/{$action}");

    }
}