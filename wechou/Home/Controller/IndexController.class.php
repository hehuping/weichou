<?php
namespace Home\Controller;
use Org\Util\String;
use Think\Controller;
use Org\Util\Date;
class IndexController extends Controller {

  public function _initialize(){

      if(empty($_SESSION['user'])){
          $action_name = __ACTION__;
          $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb096e505f9556191&redirect_uri=http://www.zhuanson.com/Login/index&scope=snsapi_userinfo&response_type=code&state={$action_name}#wechat_redirect";
          $this->redirect($url);
      }

     /* $wuser = M('wuser');
      $info = getUserInfo();

      $has = $wuser->where("openid='{$info->openid}'")->find();
      if(!$has){
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
          $wuser->add($data);
          $_SESSION['user'] = $data;
      }else{
          $wuser->save(['last_time'=>date('Y-m-d H:i:s')]);
          $_SESSION['user'] = $data;
      }*/

  }

    public function index(){

        $goods_model = M('goods');
        $data = $goods_model->where('status != -1')->select();
        foreach($data as $k=>$v){
            $data[$k]['img'] = explode(',', $v['images']);
            $data[$k]['content'] = String::msubstr(strip_tags($v['content']), 0, 150);
            $data[$k]['diffday'] = $v['cycle']-Date::dateDiff(strtotime($v['addtime']));
            //$data[$k]['afterday'] = Date::dateDiff(strtotime($v['addtime']), 'w') <1 ? Date::dateDiff(strtotime($v['addtime'])) :Date::dateDiff(strtotime($v['addtime']), 'w');
            if(Date::dateDiff(strtotime($v['addtime']), 'w') <=0 && $data[$k]['aftertime'] = Date::dateDiff(strtotime($v['addtime']))>0){
                $data[$k]['aftertime'] = Date::dateDiff(strtotime($v['addtime']))."天前";
            }else if(Date::dateDiff(strtotime($v['addtime']), 'w') >=1){
                $data[$k]['aftertime'] = Date::dateDiff(strtotime($v['addtime']), 'w')."周前";
            }elseif($data[$k]['aftertime'] = Date::dateDiff(strtotime($v['addtime']))<=0){
                $data[$k]['aftertime'] = Date::dateDiff(strtotime($v['addtime']), 'h')."小时前";
            }
        }

       // print_r($data);

       // $this->assign('img', $img);

        $this->assign('data', $data);
        $this->display();
    }


    public function content(){
        $goods_id = I('goods_id');
        if(empty($goods_id)){
            $this->redirect('/');
        }

        $goods_model = M('goods');
        $spec_model = M('spec');
        $ex_model = M('expenses');
        $goods = $goods_model
                //->field("")
               // ->join('left join spec on goods.gid=spec.gid')
                ->where("goods.gid=$goods_id && status=2 ")
                ->find();
        if(!empty($goods)){
            $spec = $spec_model->where("gid={$goods_id}")->order('money asc')->select();
            $expenses = $ex_model->where("gid={$goods_id}")->find();
        }else{
            $this->redirect('/');
        }

        $this->assign('goods', $goods);
        $this->assign('spec', $spec);
        $this->assign('expenses', $expenses);
        $this->display();

    }

    public function check(){
        $gid = I('goods_id');
        $spec_model = M('spec');
        $spec = $spec_model->where('gid='.$gid)->order('money asc')->select();
        $this->assign('spec', $spec);
        $this->display('check');
    }

    public function addr(){
        $this->display('addr');
    }
}