<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="marriage_info";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-user"></i>&nbsp;个人信息
			</div>
			<div class="panel-body row">
<?php
	$m_sql = "select * from zl_marriage where  tel=".$_SESSION['tel'];
	$m_result = mysqli_query($conn,$m_sql);	
	$m_row = mysqli_fetch_assoc($m_result);
?>
			<br/>
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST">
				  <div class="form-group">
					<label for="tel" class="col-md-3 control-label"><span class="input_label_text">联系手机</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="tel" name="tel"  value="<?php echo $_SESSION['tel']; ?>"  disabled>
					</div>
				  </div>

				  <div class="form-group">
					<label for="fullname" class="col-md-3 control-label"><span class="input_label_text">姓名</span></label>
					<div class="col-md-3">
							<input type="text" class="form-control"  id="fullname" name="fullname" value="<?php echo $m_row['fullname']; ?>" disabled>
					</div>
				  </div>
				
				  <div class="form-group">
					<label for="sex" class="col-md-3 control-label"><span class="input_label_text">性别</span></label>
					<div class="col-md-3">
							<input type="text" class="form-control  "  id="sex" name="sex" value="<?php if($m_row['sex']==1){echo "男";} if($m_row['sex']==2) {echo "女";} ?>" disabled>
					</div>
				  </div>
				
				  <div class="form-group">
					<label for="age" class="col-md-3 control-label"><span class="input_label_text">出生</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="born_time" name="born_time" value="<?php echo substr($m_row['born_time'],0,4); ?>年" disabled>
					</div>
				  </div>
				 		
				  <div class="form-group">
					<label for="email" class="col-md-3 control-label"><span class="input_label_text">邮箱</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="email" name="email" value="<?php echo $m_row['email']; ?>" >
					</div>
				  </div>
                        
				  <div class="form-group">
					<label for="education" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">学历</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="education" name="education" value="<?php echo $m_row['education']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="job" class="col-md-3 control-label"><span class="input_label_text">职业</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="job" name="job" value="<?php echo $m_row['job']; ?>">
					</div>
				  </div>

				  <div class="form-group">
					<label for="address" class="col-md-3 control-label"><span class="input_label_text">约会地址</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control"  id="address" name="address" value="<?php echo $m_row['address']; ?>" placeholder="如：政府楼南广场">
					</div>
				  </div>
                  
				  <div class="form-group">
					<label for="message" class="col-md-3 control-label"><span class="input_label_text">情感心语</span></label>
					<div class="col-md-8">
						<textarea class="form-control" name="message" id="message" rows="6"   ><?php echo $m_row['message']; ?></textarea>
					</div>
				  </div>
		  

				  
				<div class="form-group">
                    <div class="col-md-3"></div>
					<div class="col-md-9">
						<input type="button" id="save" class="btn btn-success btn-lg" value="保存婚恋信息"></input>
						<span id='savemsg' style='color:red'>&#12288;&#12288;&#12288;&#12288;&#12288;</span>
					</div>
				</div>
						
				</form>
			
			</div>
		</div>
	</div>
			
</div> 

<script type="text/javascript">
$(document).ready(function(){
	$("#save").click(function(){
		$.post("marriageSaveSubmit.php", $("form").serialize(),function(data) {
			$("#savemsg").remove();
			$("#save").after("<span id='savemsg' style='color:red'>"+data+"</span>");
			$("#savemsg").fadeTo(2000,0);
			
		});
	});
});
</script>
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















