<?php $locate="employ";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<script src="./js/bootstrapValidator.js"></script>
<link href="./css/bootstrapValidator.css" rel="stylesheet" />

 <div class="container">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				免费发布
			</div>
			<div class="panel-body">
			
				<form role="form" id="defaultForm" class="form-horizontal" action="/employAddSubmit.php" method="POST">
				  <div class="form-group">
					<label for="leixing" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">类型</span></label>
					<div class="col-md-3">
							<select class="form-control-new" name="leixing" id="leixing">
								<option value="1">全职</option>
								<option value="2">临时工</option>
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="tel" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">手机</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control-new"  id="tel" name="tel" placeholder="招聘负责人电话" value="" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="title" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">标题</span></label>
					<div class="col-md-8">
					  <input type="text" class="form-control-new" id="title" name="title" placeholder="如：**商店招收一名收银员。（30个字以内）"   />
					 
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="yuexin" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">月薪</span></label>
					<div class="col-md-3">
							<select class="form-control-new"  id="yuexin" name="yuexin"  >
								<option value="">请选择--</option>
								<option value="1_2000">2000元以内</option>
								<option value="2000_4000">2000-4000元/月</option>
								<option value="4000_">4000以上</option>

							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="sex" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">性别</span></label>
					<div class="col-md-3">
							<select class="form-control-new"  id="sex" name="sex"  >
								<option value="1">不限性别</option>
								<option value="2">只招男性</option>
								<option value="3">只招女性</option>
							</select>
					</div>
				  </div>
  
				  <div class="form-group">
					<label for="description" class="col-md-2 control-label"><span class="input_label_text">&#12288;描述</span></label>
					<div class="col-md-9">
						<textarea class="form-control" name="description" id="description" rows="6" placeholder="上班地址、职位描述、对应聘者资历要求等内容" ></textarea>
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
				<p>为保证您发布的帖子能停留在靠前的位置，请定期使用手机号登录系统，做<b>刷新</b>操作</p>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
$(document).ready(function(){	
 $('#defaultForm').bootstrapValidator({
        message: '输入格式错误',
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: '请输入标题'
                    },
                    stringLength:{
                        min:1,
                        max:30,
                        message:'标题在30个字以内'
                    }
                }
            },
            yuexin: {
                validators: {
                    notEmpty: {
                        message: '请选择月薪'
                    }
                }
            },
			tel: {
				validators: {
					notEmpty: {
						message: '请输入人力资源部相关负责人的手机号码'
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