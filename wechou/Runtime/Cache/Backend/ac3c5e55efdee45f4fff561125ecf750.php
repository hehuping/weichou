<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>运费说明-商品信息</title>
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
                <div class="panel-heading">运费说明</div>
                <div style="height: 10px;"></div>


                <form class="form-horizontal" onsubmit="return tosend()" action="/Backend/Manager/expensesave" method="post">
                <div class="panel-body">


                    <div class="form-group">

                        <div class="col-md-2"><p class="detail">运费说明：</p></div>
                        <label class="control-label" for="inputError1" style="display: none">请输入运费说明</label>
                        <input type="text" name="desc" id="desc" value="<?php echo ($expenses["desc"]); ?>" class="form-control form-control-xxx col-md-5" style="width: 15%"/>
                        <input name="goods_id" type="hidden" value="<?php echo $_GET['goods_id']; ?>" />
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"><p class="detail">发货时间：</p></div>
                        <label class="control-label" for="inputError1" style="display: none">请输入发货时间，字数不能超过20</label>
                        <input type="text" name="sendtime" id="sendtime" value="<?php echo ($expenses["send_time"]); ?>" class="form-control form-control-xxx col-md-5" />
                    </div>

                    <div class="text-center">
                        <button type="submit"  class="btn btn-success">保存</button>
                        <a href="/Backend/Manager/check/goods_id/<?php echo $_GET['goods_id']; ?>"  class="btn btn-info">提交审核</a>
                    </div>
                 </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function tosend(){
        var desc = $.trim($('#desc').val());
        var sendtime = $.trim($('#sendtime').val());

        if(desc==""){
            $('#desc').parent().addClass('has-error');
            $('#desc'). prev().show();
            return false;
        }


        if(sendtime==""){
            $('#sendtime').parent().addClass('has-error');
            $('#sendtime'). prev().show();
            return false;
        }else if(dis.length > 20){
            $('#sendtime').parent().addClass('has-error');
            $('#sendtime'). prev().show();
            return false;
        }

        return true;
    }

    $('#desc').blur(function(){
        var money = $.trim($('#desc').val());
        if(money==""){
            $('#desc').parent().addClass('has-error');
            $('#desc'). prev().show();
            return false;
        }else{
            $('#desc').parent().removeClass('has-error');
            $('#desc'). prev().hide();
        }
    });
    $('#sendtime').blur(function(){
        var dis = $.trim($('#sendtime').val());
       // alert(dis.length);
        if(dis=="") {
            $('#sendtime').parent().addClass('has-error');
            $('#sendtime'). prev().show();
            return false;
        }else if(dis.length > 20){
            $('#sendtime').parent().addClass('has-error');
            $('#sendtime'). prev().show();
            return false;
        }else{

            $('#sendtime').parent().removeClass('has-error');
            $('#sendtime'). prev().hide();
        }
    });


</script>
</body>
</html>