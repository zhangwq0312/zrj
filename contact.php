<?php $locate="contact";?>
<?php require dirname(__FILE__) . '/user_center/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 	
    $leixing = empty($_REQUEST['leixing'])|| !is_numeric($_REQUEST['leixing'])?'':$_REQUEST['leixing'];
?>
<script src="./js/bootstrapValidator.js"></script>
<link href="./css/bootstrapValidator.css" rel="stylesheet" />
 <div class="container">
	<div class="col-md-9 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				我要留言
			</div>
			<div class="panel-body row">
			
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?> >
				  

				  <div class="form-group">
					<label for="person" class="col-md-2 control-label"><span class="input_label_text">联系</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control" id="person"  name="person" placeholder="如：王先生" value="<?php if(!empty($_SESSION['username'])){ echo $_SESSION['username']; } ?>">
					</div>
				  </div>

	  
<?php if(empty($_SESSION['tel'])){ ?>
				  <div class="form-group">
					<label for="tel" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">手机</span></label>
					<div class="col-md-3">
						<input  type="text" class="form-control"  id="tel" name="tel">
					</div>
					<div class="col-md-7 text-left">
						<input type="button" id="sendcheckcode" class="btn btn-success btn-sm" value="获取验证码"></input>
						<span id="msg" ></span>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="checkcode" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">验证码</span></label>
					<div class="col-md-2">
						<input type="text" class="form-control"  id="checkcode" name="checkcode">
						<span id="msg_2"></span>
					</div>
				  </div>
<?php }else{?>
				  <div class="form-group" >
					<label  class="col-md-2 control-label"><span class="input_label_text">手机</span></label>
					<div class="col-md-3" style="padding-top: 6px;">
						<input  type="hidden" class="form-control"  id="tel" name="tel" value="<?php echo $_SESSION['tel']?>">
						<?php echo $_SESSION['tel']?>
					</div>
				  </div>

<?php } ?>
 
				  <div class="form-group">
					<label for="desc" class="col-md-2 control-label" ><span class="red_star">*</span><span class="input_label_text">内容</span></label>
					<div class="col-md-8">
						<textarea class="form-control" name="desc" id="desc" rows="8"><?php if($leixing=="1"){echo "我要申请商家管理平台";} ?><?php if($leixing=="2"){echo "我要申请超市管理平台";} ?></textarea>
					</div>
				  </div>
	
				<div class="form-group text-center">
					<button class="btn btn-success btn-lg" id="thesubmit" type="button">确认留言</button>
					<span id="msg_3"></span>
				</div>
							
				</form>
			
			</div>
		</div>
	</div>
	
	
	<div class="col-md-3 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading-blue">
				提示
			</div>
			<div class="panel-body">
				<?php if(empty($_SESSION['tel'])){ ?><p>如果收不到验证码，请检查您的手机是否欠费。登录用户可以直接留言，不需验证码。</p><?php } ?>
				<p>一般情况下，客服将在工作日24小时内给您回复。在此期间内，请您保持手机畅通。</p>
			</div>
		</div>
	</div>
	
	
</div>

		<div class="col-md-12 text-center " style="margin-top:20px;margin-bottom:20px;">
			<span class="N-nav-bottom-copyright"><span class="N-nav-bottom-copyright-icon">&copy;</span> 凤凰鸣工作室</span> 
			<a href="/site.php">概况</a> 
   	  	</div>
        
        
<script type="text/javascript">
$(document).ready(function(){
 $('#defaultForm').bootstrapValidator({
        message: '输入格式错误',
        fields: {
			tel: {
				validators: {
					notEmpty: {
						message: '为方便联系，需要记录手机号'
					}
				},
				regexp: {
					regexp: /^[0-9_\.]+$/,
					message: '请检查格式'
				}
			},
			checkcode: {
				validators: {
					notEmpty: {
						message: '请输入验证码'
					}
				}
			},
			desc: {
				validators: {
					notEmpty: {
						message: '请输入内容'
					}
				}
			}	
        }
    });
	$("#sendcheckcode").click(function(){
		$.post("sendMsg.php", {tel:$("#tel").val(),type:'leave_msg_sys'},function(data) {
			$("#msg").html(data);
		});
		var btn = $(this);
		var count = 60;
		var resend = setInterval(function(){
			count--;
			if (count > 0){
				btn.val(count+"秒后可重新获取");
				$.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
			}else {
				clearInterval(resend);
				btn.val("获取验证码").removeAttr('disabled style');
			}
		}, 1000);
		btn.attr('disabled',true).css('cursor','not-allowed');
	});
	$("#thesubmit").click(function(){
    
            $('#defaultForm').data('bootstrapValidator').validate();  
            if($('#defaultForm').data('bootstrapValidator').isValid()){  
                $.post("leaveMsgSubmit.php", {
                    tel:$("#tel").val(),
                    checkcode:$("#checkcode").val(),
                    person:$("#person").val(),
                    type:'leave_msg_sys',
                    qq:$("#qq").val(),
                    desc:$("#desc").val()
                },function(data) {
                    if(data=="000"){
                        window.location.href="/contactSuccess.php"
                    }else if(data=="103"){
                        $("#msg_2").html(data);
                    }else{
                        $("#msg_3").html(data);
                    }
                });
            }  


	});
});
</script>
	</body>
</html>

<?php
//if(isset($result)){
	//mysqli_free_result($result);
//}
if(isset($conn)){
	mysqli_close($conn);
}
?>
