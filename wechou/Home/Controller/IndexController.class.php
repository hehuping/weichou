<?php
namespace Home\Controller;
use Org\Util\String;
use Think\Controller;
use Org\Util\Date;
class IndexController extends Controller {

  public function _initialize(){

      //$user['openid'] = 'oxkais_9JC_if17Vv0fQgI4rZ7-k';
     // $_SESSION['user'] = $user;

      if(empty($_SESSION['user'])){
          $action_name = ACTION_NAME;
          $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb096e505f9556191&redirect_uri=http://www.zhuanson.com/Login/index&scope=snsapi_userinfo&response_type=code&state={$action_name}#wechat_redirect";
        // echo $url;die;
          redirect($url);
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
        $addr_id = I('aid');
        $gid = I('goods_id');
        $spec_model = M('spec');
        $addr_model = M('addr');
        //获取规格
        $spec = $spec_model->where('gid='.$gid)->order('money asc')->select();
        //获取收货地址
        if($addr_id){
            $addr = $addr_model->where("aid={$addr_id} && openid='{$_SESSION['user']['openid']}'")->find();
        }
        $addr_id = empty($addr) ? false : $addr_id;


        //$addr = $addr_model->where("uid=1")->find();

        $this->assign('addr_id', $addr_id);
        $this->assign('addr', $addr);
        $this->assign('spec', $spec);
        $this->display('check');
    }

    public function addr(){

        $addr_model = M('addr');
        //获取收货地址
        $addr = $addr_model->where("openid='{$_SESSION['user']['openid']}'")->select();
        //$addr = $addr_model->where("uid=1")->select();

        //print_r($addr);die;

        $this->assign('addr', $addr);

        $this->display('addr');
    }

    public function saveaddr(){
        $openid = session('user.openid');
        if(IS_AJAX){
            $rep = ['s' => -1, 'error' => '数据缺省'];
            $data = [
                'openid'      =>  $openid,
                'province' => (string)I('province','false'),
                'city'     => (string)I('city','false'),
                'area'     => (string)I('area','false'),
                'detail'   => (string)I('detail','false'),
                'phone'   => (string)I('phones','false'),
                'receive'  => (string)I('recive','false')
            ];

            $value = array_values($data);
            in_array('false',$value) ? $this->ajaxReturn($rep): true;

            $addr_model = M('addr');
            if($insert = $addr_model->add($data)){
                $rep['s'] = 0;
                $rep['error'] = '';
                $rep['id'] = $insert;
                $this->ajaxReturn($rep);
            }else if($addr_model->save($data)){
                $rep['s'] = 0;
                $rep['error'] = '';
                $this->ajaxReturn($rep);
            }
            else {
                $rep['s'] = -2;
                $rep['error'] = '数据有误';
                $this->ajaxReturn($rep);
            }
        }

    }

    public function addrchange(){
        $addr_model = M('addr');
        //获取收货地址
        $addr = $addr_model->where("openid='{$_SESSION['user']['openid']}'")->find();
       // $addr = $addr_model->where("uid=1")->find();

        $this->assign('addr', $addr);
        $this->display('addr');
    }

    public function deleteaddr(){
        $rep = ['s'=>0, 'error'=>''];
        $aid = (int)I('aid',0);
        $aid == 0 ?  $this->error('参数错误') : true;
        $addr_model = M('addr');

        if($addr_model->where("aid={$aid}")->delete())
            $this->ajaxReturn($rep);



            $rep['s'] = -1;
            $rep['error'] = '数据错误';
            $this->ajaxReturn($rep);



    }
}