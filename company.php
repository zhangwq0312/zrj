<?php $locate="company";?>
<?php require dirname(__FILE__) . '/business/header.php';?>

<style>
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
.left_key{
	color:#999;font-size:14px;
}
.left_value{
	font-family:SimHei;
	word-wrap:break-word;word-break:break-all;
}
.right_key {
	font-family:SimHei;
    color: #365899;
    font-weight: 500;
    font-size: 15px;
}
</style>

 <div class="container">
			<div class="col-md-3">
						<div class="panel" style="border: 1px solid #ddd;">
							<div class="panel-body" >
									<div class="carousel-inner">
										<div class="item active">
											<img src="<?php echo $row['main_img']?>" >
										</div>
									</div>
									<div class="panel-body">
										<?php if(!empty($row["address"])){ ?><p><span class="left_key">地址：</span><br/><span class="left_value"><?php echo htmlspecialchars($row["address"])?></span></p><?php } ?>
										<?php if(!empty($row["work_time"])){ ?><p><span class="left_key">营业时间：</span><br/><span class="left_value"><?php echo htmlspecialchars($row["work_time"])?></span></p><?php } ?>
										<?php if(!empty($row["description"])){ ?><p><span class="left_key">简介：</span><br/><span class="left_value"><?php echo htmlspecialchars($row["description"])?></span></p><?php } ?>
										<?php if(!empty($row["wuliu"])&&$row["wuliu"]==1){ ?><p><span class="left_key">特色：</span><br/><span class="left_value">支持送货上门<?php if($row["wuliu_limit"]!=0){ ?>（购满<?php echo $row["wuliu_limit"]?>元）<?php } ?></span></p><?php } ?>
										<?php if(!empty($row["tel"])){ ?><p><i class="glyphicon glyphicon-earphone" style="color:#aaa;font-size:18px"></i>&nbsp;&nbsp;<span style="color:red;margin:0px 2px 0px 0px;font-size:25px;font-family: Times, serif;"><?php echo $row["tel"]?></span></p><?php } ?>
									</div>
							</div>
						</div>
						
						<?php if(!empty($row["img_talk"])&&$row["weixin_talk"]==1){ ?>
							<div class="panel" style="border: 1px solid #ddd;">
								<div class="panel-body" >
										<div class="carousel-inner">
											<div class="item active">
												<img src="<?php echo $row['img_talk']?>" >
											</div>
										</div>
								</div>
							</div>
						<?php } ?>
			</div>

			<div class="col-md-9" >
			
						
					
					
<?php
	$sql2 = "select * from zl_discount  where c_id =".$id." and status !=-1 and born_day_end>date_add(now(), INTERVAL -1 day)";
	$result2 = mysqli_query($conn,$sql2);	
	$rowcount2=mysqli_num_rows($result2);
	if($rowcount2>0){
?>
						<div class="panel panel-default" >
							<div class="panel-heading" style="background-color:#f6f7f9;padding:5px">
								<a class="btn btn-default" href="#" style="font-size:12px;background-color:#ff8888;color:#fff">优惠活动</a>
							</div>
							<div class="panel-body" >
								<?php while($row2 = mysqli_fetch_assoc($result2)){?>
								<div><span class="right_key">生效：</span><?php echo substr($row2["born_day_begin"],0,10);?>&nbsp;到&nbsp;<?php echo substr($row2["born_day_end"],0,10);?></div>
								<div><span class="right_key">标题：</span><?php echo $row2["title"]; ?></div>
								<div><span class="right_key">内容：</span><?php echo $row2["content"]; ?></div>
								<?php } ?>
							</div>
						</div>
<?php } ?>

<?php
	$sql3 = "select * from zl_employ  where c_id =".$id." and status !=-1 ";
	$result3 = mysqli_query($conn,$sql3);	
	$rowcount3=mysqli_num_rows($result3);
	if($rowcount3>0){
?>
						<div class="panel panel-default" >
							<div class="panel-heading" style="background-color:#f6f7f9;padding:5px">
								<a class="btn btn-default" href="#" style="font-size:12px;background-color:#6dc96d;color:#fff">招聘员工</a>
							</div>
	<table class="table table-hover  table-condensed" >
			<?php		
				while($row3 = mysqli_fetch_assoc($result3)){
			?>
			
	<tr><td style="border:0px ;padding:15px">

		<table style="width:100%;background-color:transparent">
			<tr>
				<td style="width:20%">
					<span class="right_key">发布：</span><?php echo date('Y-m-d', strtotime($row3['modify_time'])); ?></span>
				</td>
				<td style="width:20%">
					<span class="right_key">类型：</span><?php if($row3['leixing']==1){echo "全职";} if($row3['leixing']==2){echo "临时工";} ?>
				</td>
				<td style="width:20%">
					<span class="right_key">性别：</span><?php if($row3['sex']==1){echo "不限";} if($row3['sex']==2){echo "男";} if($row3['sex']==3){echo "女";} ?>
				</td>
				<td style="width:20%">
					<span class="right_key">月薪：</span><?php echo str_replace("_","~",$row3['yuexin']);?>
				</td>
				<td style="width:20%">
					<span class="right_key">联系人：</span><span style="color:red"><?php echo $row3['tel']; ?></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<span class="right_key">标题：</span><?php echo htmlspecialchars($row3['title']); ?>
				</td>
			</tr>
			<tr>
				<td  colspan="5">
					<span class="right_key">要求：</span><?php echo htmlspecialchars($row3['description']);?>
				</td>
			</tr>
		</table>
								
	</td></tr>
			<?php
				}	
			?>		
	</table>			
								
						</div>
<?php } ?>


<?php
	if(!empty($row["additional"])){
?>
						<div class="panel panel-default" >
							<div class="panel-heading" style="background-color:#f6f7f9;padding:5px">
								<a class="btn btn-default" href="#" style="font-size:12px;background-color:#26c6da;color:#fff">详细介绍</a>
							</div>
							<div class="panel-body" >
								<div><?php echo $row["additional"]; ?></div>
							</div>
						</div>
<?php } ?>
			
<!--相册-->			
<?php if(!empty($row['img_1'])||!empty($row['img_2'])||!empty($row['img_3'])){?>
						<div class="panel panel-default"  >
							<div class="panel-heading" style="background-color:#f6f7f9;padding:5px">
								<i class="glyphicon glyphicon-picture" style="color:#aaa;font-size:18px"></i>&nbsp;相册
							</div>
							<div class="panel-body row" >
								<?php if(!empty($row['img_1'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row['img_1']?>" >
										</div>
										<div class="text-center">
											<small><?php echo $row['desc_1']?></small>
										</div>
									</div>
								<?php } ?>
								
								<?php if(!empty($row['img_2'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row['img_2']?>" >
										</div>
										<div class="text-center">
											<small><?php echo $row['desc_2']?></small>
										</div>
									</div>
								<?php } ?>
								
								<?php if(!empty($row['img_3'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row['img_3']?>" >
										</div>
										<div class="text-center">
											<small><?php echo $row['desc_3']?></small>
										</div>
									</div>
								<?php } ?>

							</div>
						</div>
					<?php } ?>
						
						
<!--留言-->		
						<div class="panel panel-default" >
							<div class="panel-heading" style="background-color:#f6f7f9;padding:5px">
								<i class="glyphicon glyphicon-hand-right" style="color:#aaa;font-size:18px"></i>&nbsp;&nbsp;向商户发信息
							</div>
							<div class="panel-body" >
								<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  >
<?php if(empty($_SESSION['tel'])){ ?>
				  <div class="form-group">
					<label for="tel" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">发信人手机</span></label>
					<div class="col-md-3">
						<input  type="text" class="form-control"  id="tel" name="tel">
					</div>
					<div class="col-md-7 text-left">
						<input type="button" id="sendcheckcode" class="btn btn-success btn-sm" value="获取验证码"></input>
						<span id="msg" ></span>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="checkcode" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">短信验证码</span></label>
					<div class="col-md-2">
						<input type="text" class="form-control"  id="checkcode" name="checkcode">
						<span id="msg_2"></span>
					</div>
				  </div>
<?php }else{?>
				  <div class="form-group" >
					<label  class="col-md-2 control-label"><span class="input_label_text">发信人</span></label>
					<div class="col-md-3" style="margin-bottom: 0px; padding-top: 6px;">
						<?php echo $_SESSION['tel']?>
					</div>
				  </div>

<?php } ?>
							
				  <div class="form-group">
					<label for="desc" class="col-md-2 control-label" ><span class="input_label_text">内容</span></label>
					<div class="col-md-8">
						<textarea class="form-control" name="desc" id="desc" rows="8"></textarea>
					</div>
				  </div>
	
				<div class="form-group text-center">
				
					<button class="btn btn-success btn-md" id="thesubmit" type="button">点击发送</button>
					<span id="msg_3"></span>
				</div>

							
								</form>
								
							</div>
						</div>
						
						<br/>
						<br/>
			</div>

</div>
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container-fluid" style="color:#fff;padding:10px 8px">
		
	</div>
</nav>

<script type="text/javascript">
$(document).ready(function(){
	$("#thesubmit").click(function(){
		$.post("leaveMsgSubmit.php", {
		<?php if(empty($_SESSION['tel'])){ ?>
			tel:$("#tel").val(),
			checkcode:$("#checkcode").val(),
		<?php }else{?>
			tel:'<?php echo $_SESSION['tel']?>',
		<?php }?>
			type:'leave_msg_company',
			to_tel:<?php echo $row["tel"]?>,
			desc:$("#desc").val()
		},function(data) {
				
			if(data=="000"){
				window.location.href="/companySuccess.php"
			}else if(data=="103"){
				$("#msg_2").html(data);
			}else{
				$("#msg_3").html(data);
			}
		});
	});
});
</script>

<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>