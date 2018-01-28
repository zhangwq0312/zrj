<?php $locate="house";?>
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
			
				<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?> action="/houseAddSubmit.php" method="POST">
				  <div class="form-group">
					<label for="leixing" class="col-md-2  control-label"><span class="red_star">*</span><span class="input_label_text">类型</span></label>
					<div class="col-md-2 col-sm-10">
							<select class="form-control-new" name="leixing" id="leixing" >
								<option value="chushou">出售</option>
								<option value="chuzu">出租</option>
							</select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="tel" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">手机</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control-new"  id="tel" name="tel" value="<?php echo $_SESSION['tel']?>" onkeyup="value=value.replace(/[^\d]/g,'')"/>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="title" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">标题</span></label>
					<div class="col-md-9">
					  <input type="text" class="form-control-new" id="title" name="title" placeholder="如：梧桐新区 2室 1厅 1卫 100平米(个人)"  />
					 
					</div>
				  </div>
				 
				  <div class="form-group">
					<label for="region" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">小区</span></label>
					<div class="col-md-9">
						<select class="form-control-new" id="region" name="region" <?php if(!isMobile()){?>style="width:200px;"<?php }?>>

						<?php 
						$sql = "select id, name,code from t_region where status !=-1 order by id ";
						$result = mysqli_query($conn,$sql);
						?>
						<?php			
							while($row = mysqli_fetch_assoc($result)){
						?>
							<option value="<?php echo $row["code"]; ?>"><?php echo $row["name"]; ?></option>
						<?php
							}	
						?>	
						</select>
					</div>
				  </div>
				 
				  <div class="form-group">
					<label for="address" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">地址</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control-new" id="address" name="address" placeholder="如：梧桐新区西区100号楼1单元1层">
					</div>
				  </div>

				  <div class="form-group">
					<label for="floor_1" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">楼层</span></label>
					<div class="col-md-1">
						<div class="input-group">
							<div class="input-group-addon">第</div>
							<select class="form-control-new" id="floor_1" name="floor_1" <?php if(!isMobile()){?>style="width:70px;"<?php } ?>>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
							</select>
							<div class="input-group-addon">层</div>
						</div>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-2">
						<div class="input-group">
							<div class="input-group-addon">共</div>
							<select class="form-control-new" id="floor_2" name="floor_2" <?php if(!isMobile()){?>style="width:70px;"<?php } ?>>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
							</select>
							<div class="input-group-addon">层</div>
						</div>
					</div>
					
					
				  </div>
				  
				  <div class="form-group">
					<label for="huxing_1" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">户型</span></label>
	<?php if(isMobile()){?>
		<div class="col-sm-12">
	<?php }else{ ?>
					<div class="col-md-3">
	<?php }?>
						<div class="input-group">
							<select class="form-control-new" id="huxing_1" name="huxing_1"   <?php if(!isMobile()){?>style="width:60px;"<?php } ?>>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div class="input-group-addon">室</div>
	<?php if(isMobile()){?>
			</div>
		</div>	
		<div class="col-sm-12">
			<div class="input-group">
	<?php } ?>
							<select class="form-control-new"  id="huxing_2" name="huxing_2"   <?php if(!isMobile()){?>style="width:60px;"<?php } ?>>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div class="input-group-addon">厅</div>
	<?php if(isMobile()){?>
			</div>
		</div>	
		<div class="col-sm-12">
			<div class="input-group">
	<?php } ?>

							<select class="form-control-new"  id="huxing_3" name="huxing_3"   <?php if(!isMobile()){?>style="width:60px;"<?php } ?>>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div class="input-group-addon">卫</div>
						</div>
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<label for="jiage" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">价格</span></label>
					<div class="col-md-3 col-sm-12">
						<div class="input-group">
							<input type="text" class="form-control-new" id="jiage" name="jiage" onkeyup="value=value.replace(/[^\d]/g,'')"><div class="input-group-addon" id="jiage_danwei" >万</div>
						</div>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="square_metre" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">面积</span></label>
					<div class="col-md-3 col-sm-12">
						<div class="input-group">
							<input type="text" class="form-control-new" id="square_metre" name="square_metre" onkeyup="value=value.replace(/[^\d]/g,'')"><div class="input-group-addon" id="jiage_danwei">平方米</div>
						</div>
					</div>
				  </div>
	  
				  <div class="form-group">
					<label for="decoration" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">装修</span></label>
					<div class="col-md-2">
							<select class="form-control-new" id="decoration" name="decoration">
								<option value="0">请选择</option>
								<option value="1">毛坯</option>
								<option value="2">简装</option>
								<option value="3">精装</option>
								<option value="4">在建</option>
							</select>
					</div>
				  </div>
	  

		<div class="text-left col-md-2">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#collapseTwo">
					补充细节
				</a>
		</div>
		
		<div id="collapseTwo" class="panel-collapse collapse  col-md-12">

				  <div class="form-group">
					<label for="seller" class="col-md-2 control-label"><span class="input_label_text">联系人</span></label>
					<div class="col-md-3">
							<input type="text" class="form-control-new" id="seller"  name="seller" placeholder="如：王女士">
					</div>
				  </div>
		
				  <div class="form-group">
					<label for="qq" class="col-md-2 control-label"><span class="input_label_text">QQ</span></label>
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" class="form-control-new" id="qq" name="qq"><div class="input-group-addon">@qq.com</div>
						</div>
					</div>
				  </div> 
	  
				  <div class="form-group">
					<label for="desc" class="col-md-2 control-label"><span class="input_label_text">描述</span></label>
					<div class="col-md-9">
							<textarea class="form-control" name="desc" id="desc" rows="5" ></textarea>
					</div>
				  </div>
				  
				<!--<div class="form-group">
					<label class="col-md-1 control-label" for="img">图片</label>
					<div class="col-md-8">
						<input type="file" id="img"/>
					</div>
				</div>-->
				<!--
				  <div class="form-group">
					<label for="desc" class="col-md-4 control-label" >是否购买置顶服务（前5位，10元起价，30天保证），还需要付费协议界面和提供托管服务（需要钥匙）</label>
				  </div>
				  -->

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
				<p>如果小区选项中没有您的房产所在的小区名称，请在描述中注明小区名称，并选择离您的房产距离近的小区选项。后期客服会根据您的备注说明，新增正确小区。为避免客服遗漏，您也可以在留言板提醒客服进行操作。</p>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				购买自动刷新服务
			</div>
			<div class="panel-body">
				<p>购买<b>自动刷新服务</b>,可免去每日手动刷新的繁琐。价格：30元/月</p>
			</div>
		</div>
		
	</div>
	
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#leixing").change(function(){
		var selectValue = $("#leixing").val();
		if(selectValue=="chushou"){
			$("#jiage_danwei").html("万");
		}
        if(selectValue=="chuzu"){
			$("#jiage_danwei").html("元/月");
		}
	});
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
			jiage: {
				validators: {
					notEmpty: {
						message: '请输入价格'
					},
					regexp: {
						regexp: /^[0-9_\.]+$/,
						message: '请检查输入格式'
					}
				}
			},
			address: {
				validators: {
					notEmpty: {
						message: '请输入房产位置'
					}
				}
			},
			square_metre: {
				validators: {
					notEmpty: {
						message: '请输入房产面积信息'
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
						message: '请输入手机号'
					}
				},
				regexp: {
					regexp: /^[0-9_\.]+$/,
					message: '请检查格式'
				}
			},
			decoration: {
				validators: {
					regexp: {
						 regexp: /^[1-9]+$/ ,
						message: '请选择装修情况'
					}
				}
			}
        }
    });

});
</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>