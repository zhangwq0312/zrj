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
<?php if(!isMobile()){ ?>
	<div class="col-md-8" >
        <div class="thumbnail" style="height:363px;">
            <img src="img/bg.jpg" style="height:100%;width:100%;"/>
        </div>
	</div>
<?php } ?>

	<div class="col-md-4 " <?php if(!isMobile()){ ?>style="border:2px ;padding-bottom:40px; background-color:#fff"<?php } ?>>
		<div class="<?php if(!isMobile()){ ?>zhdl<?php }else{ ?>zhdl_mobile<?php } ?>">帐号登录</div>
		<?php if($msg=="001"){echo "<div>系统没有该用户名,请注册</div>";} ?>	
		<?php if($msg=="002"){echo "<div>密码错误</div>";} ?>		
        <form role="form"  action="/loginSubmit.php" method="POST">  
		  <input type="hidden" name="refer" value="<?php echo $refer;?>" />
		<div class="form-group">
			<div>
				<label for="tel" class="control-label"></label>  
				<input type="text" id="tel"  name="tel"  class="login-text" placeholder="手机号" />  
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="password" class="control-label"></label>  
				<input type="password" id="password" name="password" class="login-text " placeholder="密码" required/>
			</div>
		</div>
		<div class="form-group">
				<button class="login-text" style="background-color:#26c6da;color: #ffffff;" type="submit">立即登录</button> 
		</div>	
		<div class=" n_a text-right">
				<a href="/register.php<?php if(!empty($refer)){echo "?refer=".$refer;}?>" >注册帐号</a> &nbsp;|&nbsp; <a href="/resetPassword.php<?php if(!empty($refer)){echo "?refer=".$refer;}?>" >忘记密码</a> 
		</div>
		
      </form> 	
	  
	</div>

</div>
<?php if(!isMobile()){ ?>
</div>
<?php } ?>

</br>
<?php if(!isMobile()){ ?>
    <?php require dirname(__FILE__) . '/include/footer.php';?>
<?php } ?>





















