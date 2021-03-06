<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>农家梦想</title>
		<link rel="stylesheet" href="/Public/css/home/example.css" />
		<link rel="stylesheet" href="/Public/css/home/weui.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/home/index.css" />
	</head>

	<body>
		<div class=container>
			<div class="header" style="height: 150px;">

				<div class="weui_navbar">
					<div class="top">
						<img src="/Public/images/3-15022G14221.jpg" />
					</div>
				</div>
				<div class="weui_navbar">
					<ul class="weui_navbar" style="top:100px; background-color: #04BE02; z-index: 2;">
						<li class="weui_navbar_item"><strong><a href="#">精选项目</a></strong></li>
						<li class="weui_navbar_item"><a href="#">农家急售</a></li>
						<li class="weui_navbar_item"><a href="#">农家尝鲜</a></li>
						<li class="weui_navbar_item"><a href="#">农民梦</a></li>
					</ul>
				</div>

			</div>

			<div class="weui_cells weui_cells_access">
				<?php foreach($data as $k => $v){ ?>
				<a class="weui_cell" href="/Index/content?goods_id=<?php echo ($v["gid"]); ?>">
					<div class="weui_cell_bd weui_cell_primary">
						<div class="send">
							<div class="s_left"><img src="img/img1.jpg" /></div>
							<div class="s_right">
								<p>何虎平<small>&nbsp;&nbsp;&nbsp;<?php echo $v['aftertime']; ?></small></p>
							</div>
						</div>
						<h1><?php echo ($v['title']); ?></h1>
						<p><?php echo ($v['content']); ?></p>
						<div class="img">
							<?php foreach($v['img'] as $vs){ ?>
								<img src="/teimg/<?php echo ($vs); ?>" />
							<?php } ?>
						</div>

						<div class="u_header">
							<div class="h_left">
								<img src="img/img12.jpg" />
								<img src="img/img10.jpg" />
								<img src="img/img11.jpg" />
								<img src="img/img9.jpg" />
								<img src="img/img8.jpg" />
								<img src="img/img7.jpg" />
								<img src="img/img6.jpg" />
								<img src="img/img5.jpg" />
								<img src="img/img4.jpg" />
								<img src="img/img3.jpg" />
								<img src="img/img2.jpg" />
							</div>
							

							<p>已有<strong><?php echo $v['support']; ?></strong>人支持</p>
						</div>
						<div class="foot">
							<div class="foot_con">
								<p><i class="weui_icon_success"></i>目标金额&nbsp;<?php echo $v['target_money']; ?>&nbsp;元</p>
							</div>
							<div class="foot_con">
								<p><i class="weui_icon_info"></i>已完成&nbsp;<?php echo $v['finish_money']; ?>&nbsp;元</p>
							</div>
							<div class="foot_con">
								<p><i class="weui_icon_waiting"></i>剩余时间&nbsp;<?php echo $v['diffday']; ?>&nbsp;天</p>
							</div>
						</div>
					</div>
				</a>
				<?php } ?>
			</div>
			
			<div style="height: 200px;"></div>
		
            <div class="buttoms">
				<div class="b_left">
					<div class="weui_search_bar" id="search_bar">
						<form class="weui_search_outer">
							<div class="weui_search_inner">
								<i class="weui_icon_search" style="top: 40px;left: 420px;"></i>
								<input type="search" class="weui_search_input" id="search_input" placeholder="搜索项目" required="" style="font-size: 25px; text-align: center;height: 100px;">
								<a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
							</div>
							
						</form>
						&nbsp;<a href="javascript:;" class="weui_btn weui_btn_plain_primary">确定</a>
					</div>
				</div>
				<div class="b_right">
					<a href="#"><img src="img/user_avatar_704px_1195968_easyicon.net.png" /></a>
					<p>用户中心</p>
				</div>
			</div>

		</div>

	</body>

</html>