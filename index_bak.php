<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<style>
.img {width:700px;height:300px;}
.cut {
	overflow:hidden;
	text-overflow:ellipsis;
	white-space: nowrap; 
}
.table{
    margin-bottom: 0px;
}
.table>tbody>tr>td {
    padding: 10px;
    line-height: 1.5;
    vertical-align: top;
    border-bottom: 1px solid #ddd;
    border-top: 0px;
}
</style>

 <div class="container">
			<div class="col-md-4" >

				<div class="panel" >
					<div class="panel-body" style="padding:5px" >
						<div id="myCarousel" class="carousel slide">
							<!-- 轮播（Carousel）指标 -->
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
								<li data-target="#myCarousel" data-slide-to="2"></li>
							</ol>   
							<!-- 轮播（Carousel）项目 -->
							<div class="carousel-inner">
								<div class="item active">
									<a href="/contView.php?type=my&id=1"><img src="/img/zhaosheng_3.jpg" alt="走进互联网技术的世界" class="img-rounded">
									</a>
								</div>
								<div class="item">
									<a href="/contView.php?type=my&id=6"><img src="/img/will_shangxiang.jpg" alt="胜溪互联上线啦！" class="img-rounded">
									</a>	
								</div>
								<div class="item">
									<a href="/contView.php?type=my&id=7"><img src="/img/zhaoshang.jpg" alt="Third slide" class="img-rounded" >
									</a>	
								</div>
							</div>
							<!-- 轮播（Carousel）导航 -->
							<a class="carousel-control left" style="background-image:none" href="#myCarousel" 
								data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control right" style="background-image:none" href="#myCarousel" 
								data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading-blue" >
						通知
							<?php if(!empty($_SESSION['tel'])&&isAdmin($_SESSION['tel'])){?><a  id="add_my" class="btn btn-sm">+</a><?php }   ?>	
						<a href="contList.php?type=my" class="text-muted pull-right"><small>更多>>></small></a>
					</div>
					<div class="panel-body" style=" padding: 0px;">
						<?php		
							$sql = "select id, title,build_time,flag from  (select * from zl_cont where type ='my' and  status!=-1 ";
							$sql = $sql." order by order_num,build_time desc) a limit 0,9";
							//echo $sql;
							$result = mysqli_query($conn,$sql);	
						?>
				<table class="table table-hover">
						<?php
						while($row = mysqli_fetch_assoc($result)){
							?>
												<tr><td style="padding: 5px 3px 5px 15px;">
													<?php 
														if(!empty($row['flag'])){
													?>
														
														<i class="glyphicon glyphicon-volume-up red_color"></i>
													<?php
														}
													?>
													
													
														<a href="contView.php?type=my&id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['title']; ?></a>
<?php if(!empty($_SESSION['tel'])&&isAdmin($_SESSION['tel'])){?><a  href="contEdit.php?type=my&id=<?php echo $row['id'];?>" ><i class='glyphicon glyphicon-pencil'></i></a><?php }   ?>	
													</td></tr>
						<?php }?>
						</table>
					</div>
				</div>

			</div>

	<div class="col-md-4">

				<div class="panel panel-default" >
					<div class="panel-heading" >
<script language=Javascript type=text/Javascript> 
									var day=""; 
									var month=""; 
									var ampm=""; 
									var ampmhour=""; 
									var myweekday=""; 
									var year=""; 
									mydate=new Date(); 
									myweekday=mydate.getDay(); 
									mymonth=mydate.getMonth()+1; 
									myday= mydate.getDate(); 
									myyear= mydate.getYear(); 
									year=(myyear > 200) ? myyear : 1900 + myyear; 
									if(myweekday == 0) 
									weekday=" 星期日 "; 
									else if(myweekday == 1) 
									weekday=" 星期一 "; 
									else if(myweekday == 2) 
									weekday=" 星期二 "; 
									else if(myweekday == 3) 
									weekday=" 星期三 "; 
									else if(myweekday == 4) 
									weekday=" 星期四 "; 
									else if(myweekday == 5) 
									weekday=" 星期五 "; 
									else if(myweekday == 6) 
									weekday=" 星期六 "; 
									document.write(year+"年"+mymonth+"月"+myday+"日 "+weekday); 
									</script>
					</div>
					<div class="panel-body" >
									<?php 
try{
									$ch = curl_init();

									//设置选项，包括URL
									curl_setopt($ch, CURLOPT_URL, "http://flash.weather.com.cn/wmaps/xml/lvliang.xml");
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_HEADER, 0);
									//执行并获取HTML文档内容
									$output = curl_exec($ch);
									curl_close($ch);
									//打印获得的数据 
									$xml = simplexml_load_string($output);  

									if(!$xml==false){
										foreach($xml->children() as $city){ 
										
											foreach($city->attributes() as $a => $b){ 
												
												 if($a=="cityname"&&$b=="孝义市"){
													echo "&nbsp;<b><span  style='font-size:20px;'>".$city->attributes()->stateDetailed."</span></b>";
										//			echo "&nbsp;".$city->attributes()->windState."";
													if(!$city->attributes()->temNow=="暂无实况"){
														echo "&nbsp;当前：<b><font style='font-size:18px'>".$city->attributes()->temNow."</font></b>℃";
													}	
													echo "&nbsp;全天".$city->attributes()->tem1."℃"."~".$city->attributes()->tem2."℃";
													break;
												 }
											} 
										} 
									}
}
catch(Exception $e)
{
	
}
									?>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading-orange">
						商家优惠活动
						<a href="discountList.php" class="text-muted pull-right"><small>更多>>></small></a>
					</div>
					<div class="panel-body" style=" padding: 0px;">
							<table class="table table-hover">
								<?php		
									$sql = "select * from  (select a.c_id id,a.title ,b.short_name short_name,a.born_day_end born_day_end,a.born_day_begin from zl_discount a,zl_company b where  a.c_id=b.id and a.status!=-1 and b.status!=-1 and b.main_img !='' and a.born_day_end>date_add(now(), INTERVAL -1 day)  order by a.born_day_end desc,a.born_day_begin desc) a limit 0,7";
									//echo $sql;
									$result = mysqli_query($conn,$sql);	
									while($row = mysqli_fetch_assoc($result)){
									?>
									<tr><td style="padding: 5px 3px 5px 15px;">
											<div><a href="company.php?id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['short_name'];?>&nbsp;:&nbsp;<?php echo $row['title']; ?></a></div>
											<div class="text-right" style="color:#999"><small>起：<?php echo substr($row["born_day_begin"],0,10);?>&#12288;止：<?php echo substr($row["born_day_end"],0,10);?></small></div>
									</td></tr>
								<?php }?>
							</table>
					</div>
				</div>
				
			</div>	

	<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						政府新闻
						<a href="index_net_list.php?type=gov" class="text-muted pull-right"><small>更多>>></small></a>
					</div>
					<div class="panel-body">
						<?php		

							$sql = "select id, title,source_url,build_time from  (select * from index_net where status!=-1 and type ='gov'";
							$sql = $sql." order by order_num,build_time desc) a limit 0,9";

							$result = mysqli_query($conn,$sql);	
							while($row = mysqli_fetch_assoc($result)){
                        ?>
                                    <div class="">
                                        <a href="<?php echo $row['source_url'];?>" target="_blank"><?php echo $row['title']; ?></a>
                                    </div>
						<?php }?>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						网络链接
                        <a href="index_net_list.php?type=base" class="text-muted pull-right"><small>更多>>></small></a>
					</div>
					<div class="panel-body">
						<?php		
							$sql = "select id, title,source_url,build_time from  (select * from index_net where status!=-1 and type ='base'";
							$sql = $sql." order by order_num,build_time desc) a limit 0,9";
							//echo $sql;
							$result = mysqli_query($conn,$sql);	
							while($row = mysqli_fetch_assoc($result)){
                        ?>
                                    <div class="">
                                        <a href="<?php echo $row['source_url'];?>" target="_blank"><?php echo $row['title']; ?></a>
                                    </div>
						<?php }?>
					</div>
				</div>
	</div>
	

</div>

<?php if(!isMobile()){?>
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container-fluid" style="color:#D2D2D2;padding:10px 8px">
		<div class="col-md-3 col-sm-3" >
			<address>
				<strong><small>运营方</small></strong><Br/>
				<small>凤凰鸣工作室</small>
                &nbsp;<a href="/site.php"><span style="color:#f0ad4e"><small>概况</small></span></a>
                &nbsp;<a href="/contact.php"><span style="color:#f0ad4e"><small>联系本站</small></span></a>
            </address>
		</div>
		<div class="col-md-3 col-sm-3" >
			<address>
				<strong><small>地址</small></strong><Br/>
				<small>孝义市梧桐新区西区教师公寓楼</small>
			</address>
		</div>
		<div class="col-md-3 col-sm-3" >
			<div><strong><small>联系</small></strong></div>
			<div><small>手机：<?php echo SITE_TEL;?></small></div>
			<div><small>qq：<?php echo SITE_QQ;?></small></div>
		</div>


		<div class="col-md-3 col-sm-3 " >
				<table style="background:transparent"><tr>
					<td style="vertical-align:top;">
						<strong><small>手机端：请关注微信公众号&nbsp;</small></strong>
					</td>
					<td>
						<img style="width:76px;height:76px" src="img/weixin_gzh.jpg" >
					</td>
				</tr></table>
		</div>

	</div>
</nav>
<?php } else {?>
	<?php require dirname(__FILE__) . '/include/footer.php';?>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#add_xinwen").click(function(){
		window.open("/contAdd.php?type=xinwen");
	});
	$("#add_my").click(function(){
		window.open("/contAdd.php?type=my");
	});
});
</script>
<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>
