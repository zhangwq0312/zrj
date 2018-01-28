<?php $locate="company";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<script src="./js/bootstrapValidator.js"></script>
<link href="./css/bootstrapValidator.css" rel="stylesheet" />
	
 <div class="container">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				客服发布
			</div>
			<div class="panel-body">
			
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  action="/businessAddSubmit.php" method="POST">
				  <div class="form-group">
					<label for="leixing" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">类型</span></label>
					<div class="col-md-3">
							<select class="form-control" name="leixing" id="leixing">
								<option value="">请选择</option>
							<?php	
				$sql = "select id,name,value from t_type where group_name='company' and status =0 order by order_num";
				$result = mysqli_query($conn,$sql);	
				while($row = mysqli_fetch_assoc($result)){
?>			
							<option value="<?php echo $row['value'];?>"><?php echo $row['name'];?></option>
<?php }?>	
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="tel" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">申请人手机号</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="tel" name="tel" value="<?php echo $_SESSION['tel']?>"/>
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<label for="title" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">商家名称</span></label>
					<div class="col-md-5">
					  <input type="text" class="form-control" id="title" name="title" />
					 
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="short_name" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">短名称</span></label>
					<div class="col-md-3">
					  <input type="text" class="form-control" id="short_name" name="short_name" />
					 
					</div>
				  </div>
				  
				  <!--商家头图需要商家把外景图传给客服，或者客服去实地拍照，然后手工上传到服务器，再在数据库手工设置对应的图片路径。未来可以给拍照客服提供相应的界面。
					<div class="form-group">
						<label class="col-md-2 control-label" for="main"><span class="input_label_text">商家头图</span></label>
						<div class="col-md-9">
							<input id="main" type="file" class="file" >
							<p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过2.0M</p>
						</div>
					</div>
				-->
				<div class="form-group text-center">
					<button class="btn btn-success btn-lg" type="submit">为申请人创建商家</button>
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
				
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				购买置顶服务
			</div>
			<div class="panel-body">
				<!--<p>
				根据您所提供的费用做“<B>竞价排名</B>”，以便决定在搜索页显示的靠前位号。
				付费事宜目前只支持<B>微信或支付宝</B>支付。</p>-->
			</div>
		</div>
		
	</div>
	
	
</div>
<script type="text/javascript">
$(document).ready(function(){	
 $('#defaultForm').bootstrapValidator({
        message: '输入格式错误',
		excluded : [':disabled'],//[':disabled', ':hidden', ':not(:visible)']
        fields: {
            leixing: {
                validators: {
                    notEmpty: {
                        message: '请选择类型'
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
			},
            title: {
                validators: {
                    notEmpty: {
                        message: '必填'
                    }
                }
            },
            short_name: {
                validators: {
                    notEmpty: {
                        message: '必填'
                    }
                }
            }
        }
    });

});
</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>