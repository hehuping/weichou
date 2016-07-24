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
                <div class="panel-heading">详情编辑</div>
                <form class="form-horizontal" onsubmit="return tosend()" action="basesave" method="post">
                <div class="panel-body">
                    <select class="form-control" id="cate" name="cate">
                        <?php foreach($cate as $v){ ?>
                        <option value="<?php echo ($v['cid']); ?>"><?php echo ($v['catename']); ?></option>
                        <?php } ?>
                    </select>
                    <div style="height: 10px;"></div>
                        <div class="form-group">
                            <label class="control-label" for="inputError1" style="display: none">请输入项目标题</label>
                            <input type="text" id="title" name="title" placeholder="请输入标题..." class="form-control" />
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputError1" style="display: none">请输入目标金额</label>
                                <input type="number" id="money" name="money" placeholder="请输入目标金额..." class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3"><p class="moneys">元</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputError1" style="display: none">请输入展示周期</label>
                                <input type="number" id="times" name="time" placeholder="请输入项目展示周期..." class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3"><p class="moneys">天</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-2" id="ss">

                            <img class="select img-rounded" id="select" src="/Public/images/jia.png" class="" alt="image">
                            <input type="file" name="img" id="checkimg"/>
                            <input type="hidden" name="re" id="ready" value="0" />
                        </div>

                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <script type="text/plain" id="myEditor" style="width:100%;height:240px;"></script>
                            </div>

                        </div>


                    <div class="well">

                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
														<span class="add-on input-group-addon">
															<i class="glyphicon glyphicon-calendar fa fa-calendar">
                                                            </i>
														</span>
                                            <input type="text" style="width: 200px" name="sendtime" id="sendtime"
                                                   class="form-control" value="<?php echo date('m/d/Y',time()); ?>" />


                                        </div>

                                    </div>
                                </div>
                            </fieldset>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#sendtime').daterangepicker({
                                            singleDatePicker: true,
                                        },
                                        function(start, end, label) {
                                            console.log(start.toISOString(), end.toISOString(), label);
                                        });
                            });
                        </script>
                    </div>
                    <div class="text-center"><button type="submit"  class="btn btn-success">下一步</button></div>
                 </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');

    function tosend(){
       var content = $.trim(UM.getEditor('myEditor').getContent());
        var cate = $('#cate').val();
        var title = $.trim($('#title').val()) ;
        var money = parseInt($.trim($('#money').val()));
        var time = parseInt($.trim($('#times').val()));
        var ready = parseInt($('#ready').val());
        if(ready != 4){
            alert('请上传4张封面');
            return false;
        }
        //var sendtime = $('#sendtime').val();

        if(title==""){
            $('#title').parent().addClass('has-error');
            $('#title'). prev().show();
            return false;
        }
        if(money==""){
            $('#money').parent().addClass('has-error');
            $('#money'). prev().show();
            return false;
        }
        if(time==""){
            $('#times').parent().addClass('has-error');
            $('#times'). prev().show();
            return false;
        }
        if(content==''){
            alert('项目内容不能为空！');
            return false;
        }

        return true;

        /*$.ajax({
            type: "POST",
            url: "/user/send",
            data: {'cid':cate, 'title':title, 'content':content, 'setsend':setsend, 'sendtime':sendtime},
            dataType: "json",
            success: function(data){
                if(data.s==1){
                    location.href='/user/user';
                }else{
                    alert(data.error);
                }
            }
        });*/
    }
    $('#title').blur(function(){
        var title = $.trim($('#title').val()) ;
        if(title==""){
            $('#title').parent().addClass('has-error');
            $('#title'). prev().show();
            return false;
        }else{
            $('#title').parent().removeClass('has-error');
            $('#title'). prev().hide();
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
    $('#times').blur(function(){
        var time = $.trim($('#times').val());
        if(time==""){
            $('#times').parent().addClass('has-error');
            $('#times'). prev().show();
            return false;
        }else{

            $('#times').parent().removeClass('has-error');
            $('#times'). prev().hide();
        }
    });


    $('.select').click(function(){

    });


    $('#checkimg').localResizeIMG({
        width: 1200,
        quality: 0.8,
        success: function (result) {
            var img = new Image();
            //img.src = result.base64;
            var ready = parseInt($('#ready').val());
            if(ready >= 4){
                alert('只能上传4张封面');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "saveimg",
                data: {'img':result.base64},
                dataType: "json",
                success: function(data){
                    if(data.s==0){
                        var dom = ' <div class="col-md-2" id="s'+(ready+1)+'">'+
                                '<img src="/Public/images/delete_512px_1175751_easyicon.net.png" class="deletes" onclick="del('+(ready+1)+','+'\''+data.img+'\''+')" />'+
                                '<img class="select img-rounded"  src="'+result.base64+'" class="" alt="image">'+
                                '<input type="hidden" name="img'+(ready+1)+'" value="'+data.img+'" />'+
                                '</div>';
                        $('#ss').after(dom);
                        $('#ready').val((ready+1));
                    }else{
                        alert(data.error);
                    }
                }
            });



            //alert(result.base64);


        }
    });


    function check(){
        var check = $('#setsend').val();
        if(check == "false"){
            $('#setsend').val('true');
        }else{
            $('#setsend').val('false');
        }
    }
    function del(id,img){
        img = img.toString();

        $.ajax({
            type: "POST",
            url: "delimg",
            data: {'img':img},
            dataType: "json",
            success: function(data){
                if(data.s==0){
                    $('#s'+id).remove();
                    var ready = parseInt($('#ready').val());
                    $('#ready').val(ready-1);
                }else{
                    alert(data.error);
                }
            }
        });

    }

</script>
</body>
</html>