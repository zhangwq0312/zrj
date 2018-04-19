<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="password";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-edit"></i>&nbsp;修改密码
			</div>
			<div class="panel-body row" >
			
			<br/>
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST">
				  
				<div class="form-group">
					<label for="pwd_old" class="col-md-3 control-label" style="color:#000;"><span class="red_star">*</span><span class="input_label_text">当前密码</span></label>
					<div class="col-md-3">
						<input type="password" class="form-control" id="pwd_old" name="pwd_old" />
					</div>
				</div>
		  
				<div class="form-group">
					<label for="pwd_new" class="col-md-3 control-label" style="color:#000;"><span class="red_star">*</span><span class="input_label_text">新密码</span></label>
					<div class="col-md-3">
						<input type="password" class="form-control"  id="pwd_new" name="pwd_new" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="pwd_new2" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">再次输入新密码</span></label>
					<div class="col-md-3">
						<input type="password" class="form-control"  id="pwd_new2" name="pwd_new2" />
					</div>
				</div>
				
				<div class="form-group">
                    <div class="col-md-3"></div>
					<div class="col-md-8">
						<input type="button" id="save" class="btn btn-success" value="修改为新密码"></input>
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
		var time = 50000;
		$.post("passwordSaveSubmit.php", $("form").serialize(),function(data) {
			$("#savemsg").remove();
			$("#save").after("<span id='savemsg' style='color:red'>"+data+"</span>");
			if(data=="密码修改成功"){
				$("#savemsg").fadeTo(2000,0);
			}
		});
	});
});
</script>
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















