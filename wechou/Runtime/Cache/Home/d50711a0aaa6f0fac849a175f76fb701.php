<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo ($goods["title"]); ?></title>
		<link rel="stylesheet" href="/Public/css/home/example.css" />
		<link rel="stylesheet" href="/Public/css/home/weui.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/home/content.css"/>
	</head>
	<body>
		<div class=container>
			<div class="header" style="height: 210px;">

				<div class="weui_navbar">
					<div class="top">
						<img src="/Public/images/3-15022G14221.jpg" />
					</div>
				</div>
				<div class="weui_navbar">
					<ul class="weui_navbar" style="top:100px; background-color: #04BE02; z-index: 2;" id="bar2">
						<li class="weui_navbar_item" id="bar_left"><a href="#">&lt; &nbsp;首页</a></li>
						<li class="weui_navbar_item"><a href="#">LOGO</a></li>
						<li class="weui_navbar_item" id="bar_right"><a href="#">举报</a></li>
						
					</ul>
				</div>

			</div>
			<div class="info1">
				<div class="weui_cells">
			        <div class="weui_cell">
			            <div class="weui_cell_bd weui_cell_primary">
			                <img src="/Public/images/img12.jpg" /><p>&nbsp;何虎平<small>&nbsp;&nbsp;3周前</small></p>
			            </div>
			            <div class="weui_cell_ft"><p><small>还剩&nbsp;<strong>6</strong>&nbsp;天</small></p></div>
			        </div>
		    	</div>
			</div>
			<div class="info3">
				<div class="weui_cells">
				        <div class="weui_cell">
				            <div class="weui_cell_bd weui_cell_primary">
				               <h1 class="big_h1"><?php echo ($goods["title"]); ?></h1>
				            </div>
				        </div>
			    	</div>
		    </div>
		    <div class="info2">
			    <div class="weui_cells">
			        <div class="weui_cell">
			            <div class="weui_cell_bd weui_cell_primary">
			                <div class="money">
			                	<p><strong><?php echo (intval($goods["target_money"])); ?>元</strong></p>
			                	<p>目标金额</p>
			                </div>
			                <div class="money">
			                	<p><strong><?php echo (intval($goods["finish_money"])); ?>元</strong></p>
			                	<p>已筹金额</p>
			                </div>
			                <div class="money" id="money">
			                	<p><strong><?php echo ($goods["support"]); ?>次</strong></p>
			                	<p>支持次数</p>
			                </div>
			            </div>
			         
			        </div>
			    </div>
			</div>
			
			<div class="info4">
				<div class="bd">
				    <article class="weui_article">
				           <!-- <p>长白山，素有“千年积雪万年松，直上人间第一峰”的美誉，
				            	因其独特的地理环境和自然条件，成为世界上少有的“物种基因库”和“天然博物馆”。
				            	<img src="/Public/images/0703b1a2f98f_1.jpg" />
				            	据统计，长白山共生存着1800多种高等植物，栖息着50多种兽类，280多种鸟类，50种鱼类。这里保留着东北纯净极致的生态环境，生物腐蚀物积淀的千百年有机土壤、终年最高零上25度到最低零下70度的低温环境给了这些“宝物”最适宜的成长环境。
								也只有在长白山才会有如此具有灵性的生物，这也是大自然给予我们人类最无私的馈赠，其中当属长白山木耳、蘑菇最为知名，并已获得“农产品地理标志”认证，广受消费者认可。
								<img src="/Public/images/img12.jpg" />
								众筹产品
								本次众筹中吉集团为全国人民献上东北原生态健康大礼——长白山特级段木秋耳、野生蘑菇，不进行商业包装将原生态的极品山珍送上您的餐桌！
				            </p>-->
						<?php echo ($goods["content"]); ?>
	
				    </article>
				</div>
			</div>
			
			<div class="bj"></div>
			
			<div class="info5">
				<div class="weui_cells" id="in1">
				        <div class="weui_cell">
				            <div class="weui_cell_bd weui_cell_primary">
				               <p class="yun">运费和发货时间</p>
				            </div>
				        </div>
			    	</div>
			    	
			    	<div class="weui_cells" id="in2">
				        <div class="weui_cell">
				            <div class="c_left">
				            	<p>运费：</p>
				            	<p>发货时间：</p>
				            </div>
				            <div class="c_right">
				            	<p><?php echo ($expenses["desc"]); ?></p>
				            	<p><?php echo ($expenses["send_time"]); ?></p>
				            </div>
				        </div>
			    	</div>
			</div>
			
			
			<div class="info6">
				<div class="weui_cells">
			        <div class="weui_cell">
			            <div class="weui_cell_bd weui_cell_primary">
			                <p>支助规格</p>
			            </div>
			        </div>
			    </div>
			</div>
			    <div class="info7">
					<?php foreach($spec as $k=>$v){ ?>
			        <div class="weui_cells">
				        <div class="weui_cell">
				        	<div class="info7_left">
				        		<img src="/Public/images/img11.jpg" alt="" style="position:absolute;width:100px;margin-right:5px;display:block;top:0px;">
				        	</div>
				        	<div class="info7_right">
				        		<div class="r_top">
				        			<p class="r_size">规格<?php echo ($k+1); ?>：</p><p class="r_size2">支助<strong>&nbsp;<?php echo ($v["money"]); ?>&nbsp;</strong>元</p>
				        			<p class="top_right">剩余<strong>&nbsp;<?php echo ($v["totlenum"]); ?>&nbsp;</strong>件</p>
				        		</div>
				        		<div class="r_bottom">
				        			<p><?php echo ($v["content"]); ?></p>
				        		</div>
				        	</div>
				          
				        </div>
			        </div>
					<?php } ?>
			        

			        
			    </div>
			    
			    <div class="bj"></div>
			
					<div class="info6">
						<div class="weui_cells">
					        <div class="weui_cell">
					            <div class="weui_cell_bd weui_cell_primary">
					                <p>TA&nbsp;的支持者</p>
					            </div>
					        </div>
					    </div>
					</div>
					
					<div class="info8">
						<div class="weui_cells">
					        <div class="weui_cell">
					           <div class="info8_left">
					           		<img src="/Public/images/img15.jpg" alt="" style="">
					           </div>
					           <div class="info8_right">
					           		<p class="p1">奔跑的老虎&nbsp;<p class="p2">支持了&nbsp;<strong>88</strong>&nbsp;元</p></p>
					           		<p class="p3"><small>24秒前</small></p>
					           		<p class="p1">支持，加油</p>
					           </div>
					            
					        </div>
					    </div>
					    
					    <div class="weui_cells">
					        <div class="weui_cell">
					           <div class="info8_left">
					           		<img src="/Public/images/img11.jpg" alt="" style="">
					           </div>
					           <div class="info8_right">
					           		<p class="p1">奔跑的老虎&nbsp;<p class="p2">支持了&nbsp;<strong>88</strong>&nbsp;元</p></p>
					           		<p class="p3"><small>24秒前</small></p>
					           		<p class="p1">支持，加油</p>
					           </div>
					            
					        </div>
					    </div>
					    
					    <div class="weui_cells">
					        <div class="weui_cell">
					           <div class="info8_left">
					           		<img src="/Public/images/img5.jpg" alt="" style="">
					           </div>
					           <div class="info8_right">
					           		<p class="p1">奔跑的老虎&nbsp;<p class="p2">支持了&nbsp;<strong>88</strong>&nbsp;元</p></p>
					           		<p class="p3"><small>24秒前</small></p>
					           		<p class="p1">支持，加油</p>
					           </div>
					            
					        </div>
					    </div>
					    
					</div>
					
					<div class="info9">
						<div class="info9_left">
							<img src="/Public/images/star_256px_1164900_easyicon.net.png" />
							<p>关注&nbsp;<small>456</small></p>
						</div>
						<div class="info9_center"><a href="/Index/check/goods_id/<?php echo $_GET['goods_id']; ?>" class="weui_btn weui_btn_primary">我要支助</a></div>
						<div class="info9_right">
							<img src="/Public/images/share.png" />
							<p>分享</p>
						</div>
					</div>
			    	
			    	<div style="height: 150px;"></div>
			    
			</div>	
			
			
		</div>
	</body>
</html>