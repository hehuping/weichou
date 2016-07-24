<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
			<metaname="viewport"content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
		<title>这就是你想要的“杏福”东北大杏子熟了！</title>
		<link rel="stylesheet" href="/Public/css/home/example.css" />
		<link rel="stylesheet" href="/Public/css/home/weui.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/home/check.css"/>
		<script type="text/javascript" src="/Public/js/jquery1.7.2.min.js" ></script>
	</head>
	<body>
		<div class=container>
			<div class="header" style="height: 100px;">

				<div class="weui_navbar">
					<div class="top">
						<img src="/Public/images/3-15022G14221.jpg" />
					</div>
				</div>
			</div>
			<div class="cell">
				<div class="info1">
					<div class="weui_cells">
				        <div class="weui_cell">
				            <div class="weui_cell_bd weui_cell_primary">
				                <p>选择规格</p>
				            </div>
				        </div>
				    </div>
				</div>
				
				<div class="info2">
					<div class="weui_cells weui_cells_radio">
						<?php foreach($spec as $k=>$v){ ?>
				        <label class="weui_cell weui_check_label" for="x<?php echo ($k); ?>">
				            <div class="weui_cell_bd weui_cell_primary">
				            	<div class="pic">
				            		<img src="/Public/images/img10.jpg" />
				            	</div>
				                <div class="content">
				                	<p class="p1"><?php echo ($v["money"]); ?></p><p class="p2">&nbsp;元</p><p class="p3">&nbsp;&nbsp;剩余&nbsp;<?php echo ($v["totlenum"]); ?>&nbsp;份</p>
				               		<p><?php echo ($v["content"]); ?></p>
				              	</div>
				            </div>
				            <div class="p_right">
				            	<div class="weui_cell_ft">
					                <input type="radio" name="radio1" class="weui_check" id="x<?php echo ($k); ?>" <?php if($k==0)echo 'checked'; ?>>
					                <span class="weui_icon_checked"></span>
				            	</div>
				            </div>
				        </label>
				       <?php } ?>
				    </div>
				</div>
				<div class="bj"></div>
				
				<div class="info3">
					<div class="weui_cells">
				        <div class="weui_cell">
				            <p>数量</p>
				            <div class="many">
				            	<div class="m_left"><a href="javascript:void(0)" onclick="reduce()"><img src="/Public/images/arrows_circle_minus_266px_1182470_easyicon.net.png" /></a></div>
				            	<div class="m_center"><input type="number" name="count" value="1" id="count"/></div>
				            	<div class="m_right"><a href="javascript:void(0)" onclick="add()"><img src="/Public/images/arrows_circle_plus_266px_1182471_easyicon.net.png" /></a></div>
				            </div>
				        </div>
				    </div>
				</div>
				<div class="bj"></div>
				<div class="info4">
					<div class="weui_cells weui_cells_radio">
				        <label class="weui_cell weui_check_label" for="x13">
				
				            <div class="weui_cell_bd weui_cell_primary">
				               <img src="/Public/images/895746a075537da.png" />
				               <p>微信支付</p>
				            </div>
				            <div class="weui_cell_ft">
				                <input type="radio" name="radio2" class="weui_check" id="x13" checked="checked">
				                <span class="weui_icon_checked"></span>
				            </div>
				        </label>
				    </div>
				</div>
				
				<div class="bj"></div>
				
				<div class="info5">
					<a href="/Index/addr.html" class="weui_cells">
				        <div class="weui_cell">
				            <div class="info5_left">
				            	<img src="/Public/images/Location_568px_1141916_easyicon.net.png" />
				            </div>
				            <div class="info5_center">
				            	<p class="p1">何虎平（18397410470）</p>
				            	<p class="p2">湖南衡阳雁峰区衡阳师范学院南岳学院</p>
				            </div>
				            <div class="info5_right">
				            	<img src="/Public/images/arrow_right_89px_1189144_easyicon.net.png" />
				            </div>
				        </div>
				    </a>
				</div>
				
				<div class="bj"></div>
				
				<div class="info6">
					<div class="weui_cells">
						<div class="weui_cell">
				            <div class="weui_cell_bd weui_cell_primary">
				                <textarea class="weui_textarea" placeholder="给他说句鼓励的话吧~ （默认：支持）" rows="3"></textarea>
				               
				            </div>
				        </div>
			        </div>
				</div>
				
				<div class="info9">
						<div class="info9_left">
							<p>合计：&nbsp;<strong>100</strong>&nbsp;元</p>
						</div>
						<div class="info9_center"></div>
						<div class="info9_right">
							<a href="javascript:;" class="weui_btn weui_btn_primary">立即支助</a>
						</div>
					</div>
					
					<div style="height: 150px;"></div>
			    
				
			</div>
			
			
		</div>
		
		<script>
			function add(){
				var count = $("#count").val();
				
				$("#count").val(parseInt(count)+1);
			}
			
			function reduce(){
				var count = parseInt($("#count").val());
				if(count > 1){
					count-=1;
				}else{
					count =1
				}
				$("#count").val(count);
			}
		</script>
	
	</body>
</html>