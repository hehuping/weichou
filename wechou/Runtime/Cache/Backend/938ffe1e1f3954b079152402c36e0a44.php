<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品信息发布</title>
    <link type="text/css" href="/Public/css/send.css">
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css" />

    <script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
</head>
<style>
    .moneys{
        margin-top: 10px;
    }
    #ss input{
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

    .form-horizontal .form-group{
        margin-left: 0px;
        margin-right: 0px;
    }
    .select{
        width:150px;
        height: 150px;
    }
    .deletes{
        position: absolute;
        top: 0px;
        right: 0px;
        width: 20px;
        height: 20px;
    }
    .form-control-xxx {
        width:80%;
        display:inline;
    }
    .detail{
        padding-top: 10px;
        float: right;
    }
    .pleft{
        margin-left: 10px;
    }



</style>
<body>
<nav class="nav navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-road"></span></a>

        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><h4 style="color: white;line-height: 1.8;">后台管理中心</h4></li>
            </ul>

            <div class="navbar-form navbar-right">
                <a class="navber-link" style="color: white;"><?php echo ($_SESSION['user']['username']); ?></a>&nbsp;
                <a href="/" class="navber-link" style="color: white;">前台首页</a>&nbsp;
                <a href="/login/loginout" class="navber-link" style="color: white;">退出</a>&nbsp;
            </div>
        </div>

    </div>
</nav>
<div style="height: 50px;"></div>

<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
       <!-- <div class="col-md-3">
            <div style="height: 50px;"></div>
            <a href="#" class="list-group-item active">后台管理</a>
            <ul class="list-group">
                <li class="list-group-item"><a href="/user/user">文章发布</a></li>
                <li class="list-group-item"><a href="/user/manager">文章管理</a></li>
                <?php if($_SESSION['user']['type'] == 1){ ?>
                <li class="list-group-item"><a href="/user/usermanager">用户管理</a></li>
                <li class="list-group-item"><a href="/user/catemanager">分类管理</a></li>
                <?php } ?>
            </ul>
        </div> -->
        <div class="col-md-10">
            <div style="height: 50px;"></div>
            <div class="panel panel-primary">
                <div class="panel-heading">规格添加</div>
                <div style="height: 10px;"></div>
                <div class="row pleft">
                    <?php if($spec){ foreach($spec as $k=>$v){ ?>
                    <div class="col-md-3">
                        <div class="list-group">
                            <a class="list-group-item active">
                                规格<?php echo $k+1 ?>
                            </a>
                            <a  class="list-group-item text-center"><span class="label label-success">支助金额</span>&nbsp;<span class="label label-info"><?php echo ($v["money"]); ?>元</span></a>
                            <a class="list-group-item text-center"><span class="label label-success">总数量</span>&nbsp;<span class="label label-info"><?php echo ($v["totlenum"]); ?>件</span></a>
                            <a class="list-group-item text-center"><abbr title="<?php echo ($v["content"]); ?>"><?php echo ($v["contents"]); ?></abbr></a>
                            <a class="list-group-item text-center"><button type="submit" onclick="delspec(<?php echo ($v["sid"]); ?>)"  class="btn btn-danger">删除</button></a>
                        </div>
                    </div>
                    <?php }} ?>
                </div>


                <form class="form-horizontal" onsubmit="return tosend()" action="/Backend/Manager/spacesave" method="post">
                <div class="panel-body">


                    <div class="form-group">

                        <div class="col-md-2"><p class="detail">支助金额：</p></div>
                        <label class="control-label" for="inputError1" style="display: none">请输入支助金额</label>
                        <input type="number" name="money" id="money" class="form-control form-control-xxx col-md-5" style="width: 15%"/>
                    </div>
                    <div class="form-group">

                        <div class="col-md-2"><p class="detail">规格总数量：</p></div>
                        <label class="control-label" for="inputError1" style="display: none">请输入总数量</label>
                        <input type="number" name="totalNum" id="totalNum" class="form-control form-control-xxx col-md-5" style="width: 15%"/>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"><p class="detail">规格描述：</p></div>
                        <label class="control-label" for="inputError1" style="display: none">请输入描述，字数不能超过80</label>
                        <input type="text" name="dis" id="dis" class="form-control form-control-xxx col-md-5" />
                        <input type="hidden" name="gid" value="<?php echo $_GET['goods_id'] ?>" />
                    </div>

                    <div class="text-center">
                        <button type="submit"  class="btn btn-success">保存</button>
                        <a href="/Backend/Manager/expenses/goods_id/<?php echo $_GET['goods_id']; ?>"  class="btn btn-info">下一步</a>
                    </div>
                 </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function tosend(){
        var money = $.trim($('#money').val());
        var totalNum = $.trim($('#totalNum').val());
        var dis = $.trim($('#dis').val());

        if(money==""){
            $('#money').parent().addClass('has-error');
            $('#money'). prev().show();
            return false;
        }

        if(totalNum==""){
            $('#totalNum').parent().addClass('has-error');
            $('#totalNum'). prev().show();
            return false;
        }

        if(dis==""){
            $('#dis').parent().addClass('has-error');
            $('#dis'). prev().show();
            return false;
        }else if(dis.length > 80){
            $('#dis').parent().addClass('has-error');
            $('#dis'). prev().show();
            return false;
        }

        return true;
    }
    $('#totalNum').blur(function(){
        var title = $.trim($('#totalNum').val()) ;
        if(title==""){
            $('#totalNum').parent().addClass('has-error');
            $('#totalNum'). prev().show();
            return false;
        }else{
            $('#totalNum').parent().removeClass('has-error');
            $('#totalNum'). prev().hide();
        }
    });
    $('#money').blur(function(){
        var money = $.trim($('#money').val());
        if(money==""){
            $('#money').parent().addClass('has-error');
            $('#money'). prev().show();
            return false;
        }else{
            $('#money').parent().removeClass('has-error');
            $('#money'). prev().hide();
        }
    });
    $('#dis').blur(function(){
        var dis = $.trim($('#dis').val());
        if(dis=="") {
            $('#dis').parent().addClass('has-error');
            $('#dis'). prev().show();
            return false;
        }else if(dis.length > 80){
            $('#dis').parent().addClass('has-error');
            $('#dis'). prev().show();
            return false;
        }else{

            $('#dis').parent().removeClass('has-error');
            $('#dis'). prev().hide();
        }
    });


    function delspec(id){

        if(confirm("确定删除？")){
            $.ajax({
                type: "POST",
                url: "/Backend/manager/delspec",
                data: {'id':id},
                dataType: "json",
                success: function(data){
                    if(data.s==0){
                        location.href="/Backend/manager/spec/goods_id/<?php echo $_GET['goods_id'] ?>";
                    }else{
                        alert(data.error);
                    }
                }
            });
        }


    }

</script>
</body>
</html>