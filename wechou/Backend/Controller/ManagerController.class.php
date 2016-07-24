<?php
/**
 * Created by PhpStorm.
 * User: hehuping
 * Date: 2016/6/12
 * Time: 9:40
 */

namespace Backend\Controller;
use Think\Controller;
use Org\Util\String;
use Think\Model;


class ManagerController extends Controller {

    public function _before_index(){
        if(empty($_SESSION['user'])){
           // $this->error('/index');
        }
    }

    public function index(){

        $goods_model = M('goods'); // 实例化User对象
        $count      = $goods_model->where()->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $goods_model
            ->field("goods.*, cate.catename")
            ->join('LEFT JOIN cate ON cate.cid = goods.cate_id')
            //->fetchSql(true)
            ->order('goods.addtime')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display("list"); // 输出模板
    }

    public function send(){

        $cate_model = M('cate');
        $cate = $cate_model->where('status=1')->select();
        $this->assign('cate', $cate);
        $this->display();
    }

    public function basesave(){
        //print_r($_POST);die;
        if(IS_POST){



            $title = trim(I('title'));
            $content = html_entity_decode(I('editorValue'));
            $money = (int)trim(I('money'));
            $time = (int)trim(I('time'));
            $images = I('img1').','.I('img2').','.I('img3').','.I('img4');

            empty($title) ? $this->error('标题不能为空','send') : '';
            empty($content) ? $this->error('内容不能为空','send') : '';
            empty($money) ? $this->error('目标金额不能为空','send') : '';
            empty($time) ? $this->error('周期不能为空','send') : '';

            $data = array(
                'title' => $title,
                'content' => $content,
                'target_money' => $money,
                'cycle' => $time,
                'cate_id' => I('cate'),
                'images' => $images
            );

            //print_r($data);die;

            $goods_model = M('goods');
            $newid = $goods_model->add($data);

            if($newid){
                $this->redirect('/backend/manager/spec/goods_id/'.$newid, 0);
            }

        }


    }

    //运费说明
    public function expenses(){
        $gid = (int)I('goods_id');
        if(empty($gid)) $this->redirect('index', 0);
        $ex_model = M('expenses');


        $goods_model = M("goods");
        $has = $goods_model->where("gid=".$gid)->count();

        if(!$has){
            $this->error("不存在此ID", '/Backend/Manager', 3);
        }

        $expense = $ex_model->where("gid={$gid}")->find();

        $this->assign('expenses', $expense);
        $this->display();
    }

    public function spec(){
        $gid = I('goods_id');
       if(!$gid){
           $this->redirect('index', 0);
       }
        $goods_model = M("goods");
        $space_model = M("spec");
        $has = $goods_model->where("gid=".$gid)->count();
        if(!$has){
            $this->error("不存在此ID", '/Backend/Manager', 3);
        }

        $space = $space_model->order("money asc")->where("gid=".$gid)->select();
        foreach($space as $k=>$v){
            $space[$k]['contents'] = String::msubstr($v["content"], 0, 10);
        }

        $this->assign("spec", $space);
        $this->display();
    }

    public function saveimg(){
        if(IS_AJAX){
            $rp = array('s' => 0, 'error' => '');
            if(empty($_POST)){
                $rp['s'] = -1;
                $rp['error'] = '参数错误';
                echo json_encode($rp);
                die;
            }

            $data = I('img');

            $arr = array(
                'data:image/jpg;base64,',
                'data:image/png;base64,',
                'data:image/jpeg;base64,',
            );
            $rand = 'abcdefg';
            $file_name = time().str_shuffle($rand);
            $data = str_replace($arr,'',$data);
            $img = base64_decode($data);
            $handle = file_put_contents("./teimg/".$file_name.".jpg",$img);
            if($handle){
                $rp['img'] = $file_name.'.jpg';
                echo json_encode($rp);
                die;
            }

        }
    }

    public function delimg(){
        if(IS_AJAX){
            $rp = array('s'=>0, 'error'=>'');
            $img = I('img');
            $filename  =  './teimg/'.$img;
            if ( file_exists ( $filename )) {
                unlink($filename);
                echo json_encode($rp);
            } else {
                $rp['s'] = 1;
                $rp['error'] = '删除失败';
                echo json_encode($rp);
            }

        }
    }

    public function spacesave(){
        $money = I("money");
        $totalNum = I("totalNum");
        $content = I("dis");
        $goods_id = I("gid");

        $spec_model = M("spec");



        if(empty($money) || empty($totalNum) || empty($content) || empty($goods_id)){
            die;//$this->error("参数错误", '/Backend/Manager',2);
        }

        $data = [
            "gid" => $goods_id,
            "money" => $money,
            "content" => $content,
            "totleNum" => $totalNum,
        ];

       // print_r($data); die;

        if($spec_model->add($data)){
           $this->redirect('/backend/manager/spec/goods_id/'.$goods_id, 0);
        }

    }

    public function delspec(){
        if(IS_AJAX){
            $rsp = ["s" => 0, "error" => ""];
            $sid = I("id");
            if($sid){
                $spec_model = M("spec");
                $re = $spec_model->where("sid=".$sid)->delete();
                if($re){
                    $this->ajaxReturn($rsp);
                }else{
                    $rsp["s"] = -2;
                    $rsp["error"] = "删除失败-数据库原因";
                    $this->ajaxReturn($rsp);
                }
            }else{
                $rsp["s"] = -1;
                $rsp["error"] = "参数错误";
                $this->ajaxReturn($rsp);
            }
        }
    }

    public function check(){
        $goods_id = empty(I("goods_id")) ? false : I("goods_id");
        if($goods_id){
            $goods_model = M("goods");
            $data["gid"] = $goods_id;
            $data["status"] = 1; //提交审核
            if($goods_model->save($data)){
                $this->redirect("/backend/manager", '', 1, "已提交审核，请耐心等待");
            }else{
                $this->redirect("/backend/manager", '', 1, "已提交审核，请耐心等待");
            }

        }
    }

    //删除项目

    public function delproject(){
        if(IS_AJAX){
            $rsp = ['s' => 0, 'error' => ""];
            $goods_id = I("id");
            if(is_int($goods_id)){
                //$goods_model = M("goods");
                //$spec_model = M("spec");
                $model = new Model();
                $model->startTrans();
                $sql1  = "delete from goods where gid= {$goods_id}";
                $sql2 = "delete from spec where gid = {$goods_id}";

                $result1 = $model->query($sql1);
                $result2 = $model->query($sql2);

                if($result1 && $result2){
                    $model->commit();

                    $this->ajaxReturn($rsp);

                }else{
                    $model->rollback();
                    $rsp['s'] = -1;
                    $rsp['error'] = "删除错误";
                    $this->ajaxReturn($rsp);
                }

            }
        }
    }

    //修改项目
    public function change(){

        $goods_id = I('goods_id');
        if(!$goods_id){
            $this->error("参数错误", "/backend/manager");
        }

        $cate_model = M('cate');
        $goods_model = M('goods');
        $cate = $cate_model->where("status != -1")->select();

        $goods = $goods_model->where("gid={$goods_id} && status != -1")->find();

        if(empty($goods)){
            $this->error("不允许操作的项目", "/backend/manager");
        }

        $goods['images'] = explode(',',$goods['images']);


        $now = array();

        //提取当前分类
        foreach($cate as $key=>$value){
            if($value['cid'] == $goods['cate_id']){
                $now = $value;
                unset($cate[$key]);
            }
        }


        $this->assign("now", $now);
        $this->assign('goods', $goods);
        $this->assign('cate', $cate);
        $this->display();



    }

    //保存修改

    public function dochange(){
        if(IS_POST){

           // print_r($_REQUEST);DIE;

            $goods_id = $_REQUEST["goods_id"];
            $title = trim(I('title'));
            $content = html_entity_decode(I('editorValue'));
            $money = (int)trim(I('money'));
            $time = (int)trim(I('time'));
            $images = I('img1').','.I('img2').','.I('img3').','.I('img4');

            empty($goods_id) ? $this->error('参数错误','send') : '';
            empty($title) ? $this->error('标题不能为空','send') : '';
            empty($content) ? $this->error('内容不能为空','send') : '';
            empty($money) ? $this->error('目标金额不能为空','send') : '';
            empty($time) ? $this->error('周期不能为空','send') : '';

            $data = array(
                'gid' => $goods_id,
                'title' => $title,
                'content' => $content,
                'target_money' => $money,
                'cycle' => $time,
                'cate_id' => I('cate'),
                'images' => $images
            );

            //print_r($data);die;

            $goods_model = M('goods');

            if($goods_model->save($data)){
                $this->redirect('/backend/manager/spec/goods_id/'.$goods_id,array(), 0);
            }else{
                $this->redirect('/backend/manager/spec/goods_id/'.$goods_id,'', 1, "项目详情没有修改，跳转到规格修改页面");
            }

        }
    }

    public function expensesave(){
       // print_r($_POST);

        if(empty($goods_id = I('goods_id'))){
            $this->redirect('/backend/manager/spec/expenses/'.$goods_id, 0);
        }

        $data = array(
            'gid' => $goods_id,
            'send_time' => I('sendtime'),
            'desc' => I('desc'),
        );

        $ex_model = M('expenses');
        if(!empty($ex_model->where("gid={$goods_id}")->find())){
            if($ex_model->save($data)){
                $this->redirect('/backend/manager/expenses/goods_id/'.$goods_id,array(), 1, '修改成功');
            }else{
                $this->redirect('/backend/manager/expenses/goods_id/'.$goods_id,array(), 1, '修改失败');
            }
        }

        if($ex_model->add($data)){
            $this->redirect('/backend/manager/expenses/goods_id/'.$goods_id,array(), 1, '添加成功');
        }else{
            $this->redirect('/backend/manager/expenses/goods_id/'.$goods_id,array(), 1, '添加失败');
        }









    }



}