<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="user";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-user"></i>&nbsp;个人信息
			</div>
			<div class="panel-body row">
<?php
	$sql_user = "select * from t_user where  tel=".$_SESSION['tel'];
	$result_user = mysqli_query($conn,$sql_user);	
	$row_user = mysqli_fetch_assoc($result_user);
?>
			<br/>
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST">
				 
				<div class="form-group">
					<label for="user" class="col-md-3 control-label"><span class="input_label_text">登录</span></label>
					<div class="col-md-9">
						<input type="mail" class="form-control" id="user" name="user" value="<?php echo $_SESSION['tel']; ?>" style="width:250px" disabled="true"/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="pwd_question" class="col-md-3 control-label"><span class="input_label_text">密码保护问题</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="pwd_question" name="pwd_question" value="<?php echo $row_user["pwd_question"]; ?>" style="width:250px"/>
                        &nbsp;<small style="color:#337ab7">该问题是答案的提醒文字信息。</small>
                    </div>
				</div>
                
				<div class="form-group">
					<label for="pwd_answer" class="col-md-3 control-label"><span class="input_label_text">密码保护答案</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="pwd_answer" name="pwd_answer" value="<?php echo $row_user["pwd_answer"]; ?>" style="width:250px"/>
                        &nbsp;<small style="color:#337ab7">为避免他人使用您的手机重置密码，并修改您的各种数据，建议您设置以上两项。答案越意外，安全性越高。</small>
					</div>
				</div>
                
                
				<div class="form-group">
					<label for="mail" class="col-md-3 control-label"><span class="input_label_text">邮箱</span></label>
					<div class="col-md-9">
						<input type="mail" class="form-control" id="mail" name="mail" value="<?php echo $row_user["mail"]; ?>" style="width:250px"/>
					</div>
				</div>
		  
				<div class="form-group">
					<label for="ni" class="col-md-3 control-label"><span class="input_label_text">昵称</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control"  id="ni" name="ni" value="<?php echo $row_user["ni"]; ?>" style="width:250px"/>
                        &nbsp;<small style="color:#337ab7">不能用于登录，只能用于代替手机号显示。比如用户139********显示为“美丽心情”</small>
					</div>
				</div>
				
				<div class="form-group">
					<label for="username" class="col-md-3 control-label"><span class="input_label_text">姓名</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control"  id="username" name="username" value="<?php echo $row_user["username"]; ?>" style="width:250px"/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="sex" class="col-md-3 control-label"><span class="input_label_text">性别</span></label>
					<div class="col-md-9">
						<select class="form-control"  id="sex" name="sex" style="width:80px">
							<option value="1" <?php if($row_user["sex"]==1){ ?>selected = "selected" <?php } ?>>男</option>
							<option value="2" <?php if($row_user["sex"]==2){ ?>selected = "selected" <?php } ?>>女</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="born_day" class="col-md-3 control-label"><span class="input_label_text">生日</span></label>
					<div class="col-md-9">
						<input type="date" class="form-control"  id="born_day" name="born_day" value="<?php echo $row_user["born_day"]; ?>" style="width:200px"/>
                        &nbsp;<small style="color:#337ab7">达到一定消费额，某一天可能会收到本站奉送的蛋糕哦！</small>
                    </div>
				</div>
				
				<div class="form-group">
					<label for="address" class="col-md-3 control-label"><span class="input_label_text">住址</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control"  id="address" name="address"  value="<?php echo $row_user["address"]; ?>"/>
					</div>
				</div>

				<div class="form-group">
                    <div class="col-md-3">
                    </div>
					<div class="col-md-8">
						<input type="button" id="save" class="btn btn-success btn-lg" value="保存个人信息"></input>
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
		$.post("userSaveSubmit.php", $("form").serialize(),function(data) {
			$("#savemsg").remove();
			$("#save").after("<span id='savemsg' style='color:red'>"+data+"</span>");
			$("#savemsg").fadeTo(2000,0);
			window.location.reload(); 
		});
	});
});
</script>
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















