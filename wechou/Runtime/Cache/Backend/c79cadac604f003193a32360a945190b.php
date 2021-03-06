<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品信息发布</title>
    <link type="text/css" href="/Public/css/send.css">
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css" />

    <script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.js"></script>
    <script type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="/Public/js/moment.js" ></script>
    <script type="text/javascript" src="/Public/js/daterangepicker.js"></script>
    <script src="/Public/js/mobilebugfix.mini.js"></script>
    <script src="/Public/js/localresizeimg.js"></script>


    <link rel="stylesheet" href="/Public/css/daterangepicker-bs3.css" />
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
    .cred{
        color: red;
    }
    .cgreen{
        color: green;
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

        <div class="col-md-12">
            <div style="height: 50px;"></div>
            <div class="panel panel-primary">
                <div class="panel-heading">项目列表</div>
                <table class="table table-hover text-center">
                    <tr>
                        <th class="text-center">编号</th>
                        <th class="text-center">类别</th>
                        <th class="text-center">标题</th>
                        <th class="text-center">发布人</th>
                        <th class="text-center">支助次数</th>
                        <th class="text-center">目标金额</th>
                        <th class="text-center">已筹金额</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    <?php foreach($list as $k=>$v){ ?>
                    <tr>
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo ($v["catename"]); ?></td>
                        <td><abbr title="<?php echo ($v["title"]); ?>"><?php echo (mb_substr($v["title"],0,10)); ?></abbr></td>
                        <td>admin</td>
                        <td><a href="#"><?php echo ($v["support"]); ?></a>次</td>
                        <td><p class="cgreen"><?php echo ($v["target_money"]); ?>元</p></td>
                        <td><p class="cred"><?php echo ($v["finish_money"]); ?>元</p></td>
                        <td><p class="<?php if($v['status']==2){echo 'cgreen';}else{echo 'cred';} ?>"><?php if($v['status']==0){echo '编辑中';}elseif($v['status']==1){echo "审核中"; }elseif($v['status']==2){echo "审核通过";}else{echo "审核未通过";} ?></p></td>
                        <td><a href="/backend/manager/change/goods_id/<?php echo ($v['gid']); ?>">修改</a>&nbsp;|&nbsp;<a onclick="delproject(<?php echo ($v["gid"]); ?>)" href="javascript:void(0)">删除</a></td>
                    </tr>
                    <?php } ?>
                </table>

                </div>
            <nav class="text-center">
                <ul class="pagination">
                     <?php echo $page ?>
                </ul>
            </nav>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function delproject(id){
        if(confirm("确定删除？")){
            $.ajax({
                type: "POST",
                url: "/Backend/manager/delproject",
                data: {'id':id},
                dataType: "json",
                success: function(data){
                    if(data.s==0){
                       location.reload();
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