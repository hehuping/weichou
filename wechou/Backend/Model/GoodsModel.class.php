<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/3
 * Time: 10:29
 */
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model {
    protected $tableName = 'goods';


    public function getGoodsList(){
        $goods_model = M('goods'); // 实例化User对象
        $count      = $goods_model->where()->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $goods_model->where()->order('addtime')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

}