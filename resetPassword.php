<?php require_once dirname(__FILE__) . '/common/function.php';?>
<?php if(!isMobile()){ ?>
    <?php require dirname(__FILE__) . '/head_login_reg.php';?>    
<?php } else { ?>
    <?php require dirname(__FILE__) . '/include/header.php';?>   
<?php }?>
<?php if(empty($msg)){$msg="";} ?>


<?php if(!isMobile()){ ?>
<div class="banner_color">
<?php }?>

<div class="container">  
	<div class="col-md-4 col-sm-11 col-md-offset-4" <?php if(!isMobile()){ ?>style="border:2px ;  padding-bottom:40px;background-color:#fff;"<?php } ?>>
		<div class="<?php if(!isMobile()){ ?>zhdl<?php }else{ ?>zhdl_mobile<?php } ?>" >重置密码</div>
        <div id="top_msg" style="color:#FD634F;margin-right:5px;font-size:14px;">
        <?php if($msg=="100"){echo "手机号不能为空";} ?>	
		<?php if($msg=="101"){echo "手机号有误，请检查";} ?>	
        <?php if($msg=="200"){echo "您还没有注册本站，请前往&nbsp;<a href='register.php'>注册本站</a>";} ?>	
        <?php if($msg=="203"){echo "您输入的手机验证码有误，请重试";} ?>
        <?php if($msg=="201"){echo "您的密保问题答案错误";} ?>	
        </div>
        <form role="form"  action="/resetPasswordSubmit.php" method="POST">  
		  <input type="hidden" name="refer" value="<?php echo $refer;?>" />
    <?php $tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : ''; ?>
		<div class="form-group">
			<div>
				<input type="text" id="tel" name="tel" class="login-text" placeholder="手机号" value="<?php echo $tel;?>"/>  
			</div>
		</div>
        
		<div class="form-group row">
			<div class="col-md-5" >
				<input class="login-text" id="getQuestion" type="button" style="background-color:#26c6da;border:#f56600;font-size:16px;color:#fff;" value="获取密保问题"></input> 
			</div>
			<div class="col-md-7" <?php if(!isMobile()){?>style="padding-left:0px;"<?php }?>>
				<input type="text" id="pwd_answer" name="pwd_answer" class="login-text " placeholder="请输入答案 " AUTOCOMPLETE="OFF" /><span id="msg2" style="float:left"></span>
			</div>
		</div>
        
		<div class="form-group row">
			<div class="col-md-5" >
				<input class="login-text" id="sendcheckcode" type="button" style="background-color:#26c6da;border:#f56600;font-size:16px;color:#fff;" value="获取验证码"></input> 
			</div>
			<div class="col-md-7" <?php if(!isMobile()){?>style="padding-left:0px;"<?php }?>>
				<input type="text" id="checkcode" name="checkcode" class="login-text " placeholder="请输入手机验证码" required/><span id="msg" style="float:left"></span>
			</div>
		</div>
        
		<div class="form-group">
			<div>
				<input type="text" id="password" name="password" class="login-text " placeholder="输入新密码" required/>
			</div>
		</div>
        
		<div class="form-group">
				<button class="login-text" style="background-color:#26c6da;color:#fff;border:#f56600;" type="submit">确认重置密码</button> 
		</div>	
      </form> 	
	  
	</div>
	<div class="col-md-4 bgc" >
	&nbsp;
	</div>

</div>

<?php if(!isMobile()){ ?>
</div>
<?php }?>

<script type="text/javascript">
$(document).ready(function(){

	$("#getQuestion").click(function(){
		$.post("getQuestion.php", {tel:$("#tel").val()},function(data) {
            if(data=="300"){
                $("#top_msg").html("获取密保问题失败，手机号不能为空");
            }else if(data=="301"){
                $("#top_msg").html("获取密保问题失败，手机号码有误");
            }else if(data=="302"){
                $("#top_msg").html("获取密保问题失败，该手机号未注册");
            }else if(data=="303"){
                $("#msg2").html("该号未设置密保，不需回答");
            }else if(data=="304"){
                $("#msg2").html("未设置问题，直接输入答案");
            }else{
                $("#msg2").html("问题："+data);
                $("#top_msg").html("");
            }
		});
	});

	$("#sendcheckcode").click(function(){
		$.post("sendMsg.php", {tel:$("#tel").val(),type:'resetPassword'},function(data) {
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





















