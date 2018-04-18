<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<?php
	$id= empty($_REQUEST['id'])|| !is_numeric($_REQUEST['id'])||$_REQUEST['id']<1 ? '':$_REQUEST['id'];
	if(empty($id)){ return;}
    //if(empty($_SESSION['tel']){return;} //已经在header.php中处理
	$menu_active="company_".$id;
	if(isAdmin($_SESSION['tel'])){
		$sql_company = "select *,build_time>now() isbefore from zl_company where  id=".$id;
	}else{
		$sql_company = "select *,build_time>now() isbefore from zl_company where  id=".$id." and userid=".$_SESSION['tel'];
	}
	$result_company = mysqli_query($conn,$sql_company);	
	$row_company = mysqli_fetch_assoc($result_company);
	//echo $row_company["name"];exit;
?>


<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
	
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-edit"></i>&nbsp;基本信息__<?php echo $row_company["short_name"]; ?>
				&#12288;
				<?php
					if($row_company["isbefore"]==1){
						echo "（至".$row_company["build_time"]."有效）";
					}else{
						echo "（您的商家已过有效期，续费后可正常使用）";
					}
				?>
			</div>
			<div class="panel-body row">
			<br/>
				<form role="form" id="form_txt" <?php if(!isMobile()){?>class="form-horizontal"<?php }?> >
				<input type="hidden" name="company_id" id="company_id" value="<?php echo $row_company["id"]; ?>" />
					
					<div class="form-group">
						<label for="company_name" class="col-md-2 control-label"><span class="input_label_text">商家名称</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control"  id="company_name" name="company_name" value="<?php echo htmlspecialchars($row_company["name"]); ?>" style="width:250px" disabled="true"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="company_name" class="col-md-2 control-label"><span class="input_label_text">商家申请人</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control"  id="company_name" name="company_name" value="<?php echo $row_company["userid"]; ?>" style="width:250px" disabled="true"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="address" class="col-md-2 control-label"><span class="input_label_text">商家地址</span></label>
						<div class="col-md-7">
							<input type="text" class="form-control"  id="address" name="address"  value="<?php echo htmlspecialchars($row_company["address"])?>"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="work_time" class="col-md-2 control-label"><span class="input_label_text">营业时间</span></label>
						<div class="col-md-5">
							<input placeholder="如：6：30-12：30 周一到周五营业" type="text" class="form-control"  id="work_time" name="work_time" value="<?php echo htmlspecialchars($row_company["work_time"])?>" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="tel" class="col-md-2 control-label"><span class="input_label_text">营业电话</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control"  id="tel" name="tel" value="<?php echo $row_company["tel"]?>" style="width:250px"/>
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-md-2 control-label"><span class="input_label_text">简单介绍</span></label>
						<div class="col-md-9">
								<textarea class="form-control" name="description" id="description" rows="2"><?php echo htmlspecialchars($row_company["description"])?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label for="additional" class="col-md-2 control-label"><span class="input_label_text">详细介绍</span></label>
						<div class="col-md-9">
							<textarea class="form-control" name="additional" id="additional" rows="5"><?php echo htmlspecialchars($row_company["additional"])?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label for="additional" class="col-md-2 control-label"><span class="input_label_text">特色1:</span></label>
						<div class="col-md-9">
							<input name="wuliu" id="wuliu" type="checkbox" value="1" <?php if($row_company["wuliu"]==1){ ?>checked="checked"<?php } ?>>&nbsp;支持送货上门，选择该项时，可输入起送金额&nbsp;<input class="text-right" type="text" id="wuliu_limit" name="wuliu_limit" value="<?php echo $row_company["wuliu_limit"]?>" style="width:60px"/>元&nbsp;（0表示不限制金额，均可送货）
						</div>
					</div>
				
					<div class="form-group">
						<label for="weixin_talk" class="col-md-2 control-label"><span class="input_label_text">特色2:</span></label>
						<div class="col-md-9">
							<input name="weixin_talk" id="weixin_talk" type="checkbox" value="1" <?php if($row_company["weixin_talk"]==1){ ?>checked="checked"<?php } ?><?php if(empty($row_company["img_talk"])){ ?>disabled<?php } ?>>&nbsp;支持微信聊天。当设置本页下方“图片信息”中的微信二维码时，系统将自动选择该项。<Br/>&#12288;当您取消该选项时，二维码会自动从您的商户界面隐藏不可见。
						</div>
					</div>

					<div class="form-group text-center">
						<div class="col-md-11 text-right">
							<input type="button" id="save_txt" name="save_txt"  class="btn btn-info btn-sm" value="保存基本信息"></input>
							&nbsp;<a target="_blank" class="btn btn-default btn-sm" title="预览" href="/company.php?id=<?php echo $id; ?>">预览</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-edit"></i>&nbsp;招聘信息__<?php echo $row_company["short_name"]; ?>&#12288;<span style="color:red">您可以选择在此处，或在《工作》栏目下的“免费发布”中发布您的招聘信息。提醒您定期刷新发帖。</span>
			</div>
			<div class="panel-body row">
			
			<br/>
				<form role="form" id="form_zhaopin" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST" >
				<input type="hidden" name="company_id" id="company_id" value="<?php echo $row_company["id"]; ?>" />
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
					  <input type="text" class="form-control-new" id="title" name="title" placeholder="如：**公司招收五名仪表工"   />
					 
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
					<label for="description" class="col-md-2 control-label"><span class="input_label_text">描述</span></label>
					<div class="col-md-9">
						<textarea class="form-control" name="description" id="description" rows="6" placeholder="上班地址、职位描述、对应聘者资历要求等内容" ></textarea>
					</div>
				  </div>
				  
					<div class="form-group text-center">
						<div class="col-md-11 text-right">
							<input type="button" id="save_zhaopin" name="save_zhaopin"  class="btn btn-info btn-sm" value="发布新的招聘信息"></input>
							&nbsp;<a target="_blank" class="btn btn-default btn-sm" title="预览" href="/company.php?id=<?php echo $id; ?>">预览</a>
						</div>
					</div>
				</form>
			</div>
		</div>
<?php 
	$sql_discount = "select * from zl_discount where  c_id=".$id;
	$result_discount = mysqli_query($conn,$sql_discount);	
	$row_discount = mysqli_fetch_assoc($result_discount);
?>
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-edit"></i>优惠活动__<?php echo $row_company["short_name"]; ?>&#12288;<span style="color:red">活动时间过期后，下面显示遗留信息，但该活动在《首页-优惠活动》和“商家展示页”不显示。为避免恶意重复发布，只支持一个活动。</span>
			</div>
			<div class="panel-body row">
			
			<br/>
				<form role="form" id="form_youhui" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST">
					<input type="hidden" name="company_id" id="company_id" value="<?php echo $row_company["id"]; ?>" />
					<div class="form-group">
						<label for="born_day_begin" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">活动时间</span></label>
						<div class="col-md-9">
							开始：<input type="date"  id="born_day_begin" name="born_day_begin" value="<?php echo substr($row_discount["born_day_begin"],0,10);?>" style="width:200px"/>
							结束：<input type="date"  id="born_day_end" name="born_day_end" value="<?php echo substr($row_discount["born_day_end"],0,10);?>" style="width:200px"/>
						</div>
					</div>
	
					<div class="form-group">
						<label for="mail" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">简略标题</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control"  id="discount_title" name="discount_title" value="<?php echo $row_discount["title"];?>" style="width:250px" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="mail" class="col-md-2 control-label"><span class="red_star">*</span><span class="input_label_text">详细内容</span></label>
						<div class="col-md-9">
							<textarea class="form-control" name="discount" id="discount" rows="5"><?php echo $row_discount["content"];?></textarea>
						</div>
					</div>
					
					<div class="form-group text-center">
						<div class="col-md-11 text-right">
							<input type="button" id="save_youhui" name="save_youhui"  class="btn btn-info btn-sm" value="保存优惠活动"></input>
							&nbsp;<a target="_blank" class="btn btn-default btn-sm" title="预览" href="/company.php?id=<?php echo $id; ?>">预览</a>
						</div>
					</div>
				</form>
			</div>
		</div>
			
		<!--相册-->	
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-edit"></i>&nbsp;图片信息__<?php echo $row_company["short_name"]; ?>&#12288;<span style="color:red">支持jpg、jpeg、png、gif格式，大小不超过2M。图片接近正方形，显示效果更佳。</span>
			</div>
			<div class="panel-body row">
			<br/>
				<form role="form" action="upload_img.php" id="form_img" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>   method="POST" enctype="multipart/form-data">
				<input type="hidden" name="company_id" id="company_id" value="<?php echo $row_company["id"]; ?>" />
			
					<div class="form-group">
						<label class="col-md-2 control-label" for="main"><span class="input_label_text">商家头图</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control"  value="<?php if(!empty($row_company["main_img"])){; ?>店面照。如需更换，请联系客服。<?php }else{ ?>必填项。由于缺乏头图，导致您的商家尚未生效。请及时给客服发送头图。<?php } ?>"  disabled="true"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label" for="img_1"><span class="input_label_text">当前相册</span></label>
						<div class="col-md-9 row">
								<?php if(!empty($row_company['img_1'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row_company['img_1']?>" >
										</div>
										<div class="text-center">
											<small>图片1</small>
										</div>
									</div>
								<?php } ?>
								
								<?php if(!empty($row_company['img_2'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row_company['img_2']?>" >
										</div>
										<div class="text-center">
											<small>图片2</small>
										</div>
									</div>
								<?php } ?>
								
								<?php if(!empty($row_company['img_3'])){?>
									<div class="col-md-4" >
										<div class="thumbnail">
											<img src="<?php echo $row_company['img_3']?>" >
										</div>
										<div class="text-center">
											<small>图片3</small>
										</div>
									</div>
								<?php } ?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label" for="img_1"><span class="input_label_text">更换图片1</span></label>
						<div class="col-md-9">
							<input id="img_1" name="img_1" type="file" class="file" />
						</div>
					</div>
					  
					<div class="form-group">
						<label class="col-md-2 control-label" for="img_2"><span class="input_label_text">更换图片2</span></label>
						<div class="col-md-9">
							<input id="img_2" name="img_2" type="file" class="file">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label" for="img_3"><span class="input_label_text">更换图片3</span></label>
						<div class="col-md-9">
							<input id="img_3" name="img_3" type="file" class="file">
						</div>
					</div>
					
				<?php if(!empty($row_company['img_talk'])){?>		
					<div class="form-group">
						<label class="col-md-2 control-label" ><span class="input_label_text">微信聊天二维码</span></label>
						<div class="col-md-9 row">
							<div class="col-md-4" >
								<div class="thumbnail">
									<img src="<?php echo $row_company['img_talk']?>" >
								</div>
							</div>	
						</div>
					</div>
				<?php } ?>	
				
					<div class="form-group">
						<label class="col-md-2 control-label" for="img_talk"><span class="input_label_text">
							<?php if(!empty($row_company['img_talk'])){?>更换二维码<?php }else{?>微信聊天二维码<?php } ?>	
						</span></label>
						<div class="col-md-9">
							<input id="img_talk" name="img_talk" type="file" class="file">
						</div>
					</div>
					
					<div class="form-group text-center">
						<div class="col-md-11 text-right">
							<input type="submit" id="save_img" name="save_img"  class="btn btn-info btn-sm" value="保存图片信息"></input>
							&nbsp;<a target="_blank" class="btn btn-default btn-sm" title="预览" href="/company.php?id=<?php echo $id; ?>">预览</a>
						</div>
					</div>
					
				</form>

			</div>
		</div>
			
			
			
</div> 

<script type="text/javascript">
$(document).ready(function(){

	$("#save_txt").click(function(){
		$.post("company_txt_ajax.php", $("#form_txt").serialize(),function(data) {
			bootbox.alert(data);
		});
	});
	$("#save_youhui").click(function(){
		$.post("company_youhui_ajax.php", $("#form_youhui").serialize(),function(data) {
			bootbox.alert(data);
		});
	});
	$("#save_zhaopin").click(function(){
		$.post("company_zhaopin_ajax.php", $("#form_zhaopin").serialize(),function(data) {
			bootbox.alert(data);
		});
	});
});
</script>
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















