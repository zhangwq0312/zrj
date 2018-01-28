<?php $locate="marriage";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php if(empty($_SESSION['tel'])||isNotAdmin($_SESSION['tel'])){ return;}   ?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<script type="text/javascript" src="./js/bootstrap-datetimepicker.min.js" ></script>
<script src="./js/bootstrapValidator.js"></script>
<link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="./css/bootstrapValidator.css" rel="stylesheet" />

 <div class="container">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				免费发布
			</div>
			<div class="panel-body row">
			
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  action="/marriageAddSubmit.php" method="POST">

				  <div class="form-group">
					<label for="tel" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">联系手机</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="tel" name="tel" placeholder="">
					</div>
				  </div>
				
				  <div class="form-group">
					<label for="email" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">联系邮箱</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="email" name="email" placeholder="">
					</div>
				  </div>
                  
				  <div class="form-group">
					<label for="fullname" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">姓名</span></label>
					<div class="col-md-3">
							<input type="text" class="form-control"  id="fullname" name="fullname" placeholder="">
					</div>
				  </div>
				
				  <div class="form-group">
					<label for="sex" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">性别</span></label>
					<div class="col-md-3">
							<select class="form-control"  id="sex" name="sex"  >
								<option value="1">男</option>
								<option value="2">女</option>
							</select>
					</div>
				  </div>
				
				  <div class="form-group">
					<label for="born_time" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">出生年份</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="born_time" name="born_time" placeholder="" >
					</div>
				  </div>
				 		  
				  <div class="form-group">
					<label for="education" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">学历</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="education" name="education" placeholder="">
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="job" class="col-md-3 control-label"><span class="input_label_text">职业</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="job" name="job" placeholder="">
					</div>
				  </div>
				  
				  
				  
				  <div class="form-group">
					<label for="identity" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">认证</span></label>
					<div class="col-md-3">
							<select class="form-control"  id="identity" name="identity"  >
								<option value="-1">否</option>
								<option value="0">是</option>
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="photo" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">个人相片</span></label>
					<div class="col-md-3">
							<select class="form-control"  id="photo" name="photo"  >
								<option value="2">否</option>
								<option value="1">是</option>
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="address" class="col-md-3 control-label"><span class="input_label_text">希望约会地址</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control"  id="address" name="address" placeholder="如：梧桐政府楼南广场">
					</div>
				  </div>
				    
				  <div class="form-group">
					<label for="message" class="col-md-3 control-label"><span class="input_label_text">情感心语</span></label>
					<div class="col-md-8">
						<textarea class="form-control" name="message" id="message" rows="6" placeholder=""  ></textarea>
					</div>
				  </div>
  
				<div class="form-group text-center">
					<button class="btn btn-success btn-lg" type="submit">立即发布</button>
				</div>
							
				</form>
			
			</div>
		</div>
	</div>
	
	
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				提示
			</div>
			<div class="panel-body">
				<p>客服专用模块</p>
			</div>
		</div>
		<!--
		<div class="panel panel-default">
			<div class="panel-heading">
				
			</div>
			<div class="panel-body">
				<p style="text-indent: 2em;"></span></p>	
			</div>
		</div>
		-->
	</div>
	
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	
$('#born_time').datetimepicker({
        format: 'yyyy',  
         weekStart: 1,  
         autoclose: true,  
         startView: 4,  
         minView: 4,  
         forceParse: false,  
         language: 'zh-CN'  
}).on('changeDate', function(ev){
       $(this).trigger('blur');
});

 $('#defaultForm').bootstrapValidator({
        message: '输入格式错误',
        fields: {
            fullname: {
                validators: {
                    notEmpty: {
                        message: '姓名不能为空'
                    }
                }
            },
			born_time: {
             trigger:'blur',
				validators: {
					notEmpty: {
						message: '请输入出生年份'
					},
					regexp: {
						regexp: /^[0-9_\.]+$/,
						message: '年龄格式有误'
					}
				}
			},
			education: {
				validators: {
					notEmpty: {
						message: '请填写学历'
					}
				}
			},

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
			}
        }
    });

});
</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>