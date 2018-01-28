<?php require_once dirname(__FILE__) . '/common/function.php';?>
<?php if(!isMobile()){ ?>
    <?php require dirname(__FILE__) . '/head_login_reg.php';?>    
<?php } else { ?>
    <?php require dirname(__FILE__) . '/include/header.php';?>   
<?php }?>
<?php if(empty($msg)){$msg="";} ?>


<?php if(!isMobile()){ ?>
<div class="banner_color">
<?php } ?>

<div class="container">  
	<div class="col-md-4 col-sm-11 col-md-offset-4" <?php if(!isMobile()){ ?>style="border:2px ;  padding-bottom:40px;background-color:#fff;"<?php } ?>>
		<div class="<?php if(!isMobile()){ ?>zhdl<?php }else{ ?>zhdl_mobile<?php } ?>" >注册帐号</div>
		<?php if($msg=="200"){echo "<div>手机号不能为空</div>";} ?>	
		<?php if($msg=="201"){echo "<div>手机号有误，请检查</div>";} ?>	
		<?php if($msg=="101"){echo "<div>系统已经有该用户名,不需要重新注册。请<a href='/login.php'>前往登录</a></div>";} ?>	
		<?php if($msg=="102"){echo "<div>您两次输入的密码不一样，请重新填写</div>";} ?>	
		<?php if($msg=="103"){echo "<div>您输入的手机验证码有误，请重试</div>";} ?>
        <form role="form"  action="/registerSubmit.php" method="POST">  
		  <input type="hidden" name="refer" value="<?php echo $refer;?>" />
		<div class="form-group">
			<div>
				
				<input type="text" id="tel" name="tel" class="login-text" placeholder="手机号" />  
			</div>
		</div>
		<div class="form-group">
			<div>
			
				<input type="password" id="password" name="password" class="login-text " placeholder="密码" required/>
			</div>
		</div>
		<div class="form-group">
			<div>
				 
				<input type="password" id="password2" name="password2" class="login-text " placeholder="再输入一次密码" required/>
			</div>
		</div>
		<div class="form-group row">

			<div class="col-md-5" >
				<input class="login-text" id="sendcheckcode" type="button" style="background-color:#26c6da;border:#f56600;font-size:16px;color:#fff;" value="获取验证码"></input> 
			</div>
			
			<div class="col-md-7" <?php if(!isMobile()){?>style="padding-left:0px;"<?php }?>>
				<input type="password" id="checkcode" name="checkcode" class="login-text " placeholder="请输入手机验证码" required/><span id="msg" style="float:left"></span>
			</div>
		</div>
		<div class="form-group">
				<button class="login-text" style="background-color:#26c6da;color:#fff;border:#f56600;" type="submit">立即注册</button> 
		</div>	
      </form> 	
	  
	</div>
	</div>
<?php if(!isMobile()){ ?>
	</div>
<?php } ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#sendcheckcode").click(function(){

		$.post("sendMsg.php", {tel:$("#tel").val(),type:'reg'},function(data) {
			$("#msg").html(data);
			if(data=="验证码已发送"){
					var btn = $(this);
					var count = 60;
					var resend = setInterval(function(){
						count--;
						if (count > 0){
							btn.val(count+"秒后可重新获取");
							$.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
						}else {
							clearInterval(resend);
							btn.val("获取验证码").removeAttr('disabled');
						}
					}, 1000);
					btn.attr('disabled',true).css('cursor','not-allowed');
			}
		});

	});
});
</script>

</br>
<?php if(!isMobile()){ ?>
    <?php require dirname(__FILE__) . '/include/footer.php';?>
<?php } ?>





















