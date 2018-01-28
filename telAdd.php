<?php $locate="tel";?>
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
			
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  action="/telAddSubmit.php" method="POST">
				  <div class="form-group">
					<label for="leixing" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">类型</span></label>
					<div class="col-md-3">
							<select class="form-control" name="leixing" id="leixing">
								<option value="">请选择</option>
							<?php	
				$sql = "select id,name,value from t_type where group_name='tel' and status =0 order by order_num";
				$result = mysqli_query($conn,$sql);	
				while($row = mysqli_fetch_assoc($result)){
?>			
							<option value="<?php echo $row['value'];?>"><?php echo $row['name'];?></option>
<?php }?>	
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="tel" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">手机</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control"  id="tel" name="tel" value="<?php echo $_SESSION['tel']?>"/>
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<label for="title" class="col-md-3 control-label"><span class="red_star">*</span><span class="input_label_text">标题</span></label>
					<div class="col-md-8">
					  <input type="text" class="form-control" id="title" name="title" placeholder="简明扼要，如：梧桐新区30号楼一层商铺，理发美容店"  />
					 
					</div>
				  </div>

				  <div class="form-group">
					<label for="description" class="col-md-3 control-label"><span class="input_label_text">描述</span></label>
					<div class="col-md-8">
						<textarea class="form-control" name="description" id="description" rows="6" placeholder="可根据需要填写，比如地址、联系人姓名、服务支持哪些小区、是否送货上门等信息"  ></textarea>
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
				<p>请确认所填信息真实有效。</p>
				<p>如果在类型选项中，没有您所要的类型，请在描述中注明或者联系本站，以便后期客服帮您添加相应类型。</p>
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
            title: {
                validators: {
                    notEmpty: {
                        message: '请输入标题'
                    }
                },
                stringLength:{
                    min:1,
                    max:30,
                    message:'标题在30个字以内'
                }
            },
            leixing: {
                validators: {
                    notEmpty: {
                        message: '请选择类型'
                    }
                }
            },
			jiage: {
				validators: {
					notEmpty: {
						message: '价格不能为空'
					},
					regexp: {
						regexp: /^[0-9_\.]+$/,
						message: '请检查格式'
					}
				}
			},
			address: {
				validators: {
					notEmpty: {
						message: '缺少位置信息'
					}
				}
			},
			square_metre: {
				validators: {
					notEmpty: {
						message: '缺少房屋大小信息'
					},
				regexp: {
						regexp: /^[0-9_\.]+$/,
						message: '请检查格式'
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