<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="my_coupon";?>
<?php $rowcount=0;?>
<style>
table td{padding:7px 15px;font-size:14px}
table th{padding:7px 15px;font-size:14px;color:#365899;font-weight:normal}
.my-modal{position: absolute;top:25%; } 
.tixing{color:#365899;background-color:#fff;padding:10px 15px;font-size:15px}
</style>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-duplicate"></i>&nbsp;赠品
			</div>
			<?php		
				$sql = "select * from  z_coupon_user where  userid=".$_SESSION['tel']." order by create_time desc";
				$result = mysqli_query($conn,$sql);	
				$rowcount=mysqli_num_rows($result);
				if($rowcount>0){
			?>
            
            <?php if(!isMobile()){?>
					<table class="table table-hover " style="width:100%;" >
                      <thead>
                        <tr>
                          <th style="width:15%;" >领券时间</th>
                          <th style="width:20%;" >券有效期</th>
                          <th style="width:10%;"  >验证码</th>
                          <th style="width:15%;" >名称</th>
                          <th style="width:30%;" >备注</th>
                          <th style="width:10%;" >状态</th>
                        </tr>
                      </thead>
                        <?php while($row = mysqli_fetch_assoc($result)){?>
						<tr>
							<td>
								<?php echo date('Y-m-d', strtotime($row['create_time'])); ?>
							</td>
							<td>
								<?php echo date('Y-m-d', strtotime($row['start_time'])); ?>~<?php echo date('Y-m-d', strtotime($row['end_time'])); ?>
							</td>
							<td>
								<?php echo $row['coupon_code'];?>
							</td>
							<td>
								<?php echo $row['big'];?>
							</td>
							<td>
                                <?php echo $row['small'];?>
							</td>
							<td>
                                <?php if("0"==$row['status']){
                                    echo "未使用";
                                }else if ("-1"==$row['status']){
                                    echo "已使用";
                                }?>
							</td>
                            
                        </tr>
                        <?php }?>
                    </table>
                <?php }else{ ?> 
                
                
					<table class="table table-hover " style="width:100%;" >
                        <?php while($row = mysqli_fetch_assoc($result)){?>
						<tr>
							<td>
								领券时间:&nbsp;<?php echo date('Y-m-d', strtotime($row['create_time'])); ?>
                                <br/>
								券有效期:&nbsp;<?php echo date('Y-m-d', strtotime($row['start_time'])); ?>~<?php echo date('Y-m-d', strtotime($row['end_time'])); ?>
                                <br/>
								验证码:&nbsp;<?php echo $row['coupon_code'];?>
                                <br/>
								名称:&nbsp;<?php echo $row['big'];?>
                                <br/>
                                备注:&nbsp;<?php echo $row['small'];?>
                                <br/>
                                状态:&nbsp;
                                <?php if("0"==$row['status']){
                                    echo "未使用";
                                }else if ("-1"==$row['status']){
                                    echo "已使用";
                                }?>
							</td>
                            
                        </tr>
                        <?php }?>
                    </table>
                
                
                <?php } ?>    

                
			<?php } else {?>
					<div class="panel-body" style="padding:20px 50px 20px 50px">
                        <p style="color:#999"> 您还没有领券记录。</p>
                    </div>
            <?php }?>
        </div>

        <?php if($rowcount>0){ ?>

                <div class="panel-body tixing">
                    使用说明：
                    <br/>&nbsp;1：告知店员您的手机号码和验证码，即可获得免费赠品。另外，目前不要求发券商户在平台确认是否已为您发放赠品，所以上述状态列表仅供参考。
                    <br/>&nbsp;2：在您不确定商户地址时，可以通过备注中的“商户名称”，在本站商户页的搜索栏输入“商户名称”查询。
                    <br/>&nbsp;3：赠品一律免费，如遇到商户收费的情况，请通知本站，谢谢！
                    <br/>&nbsp;4：请注意券的有效期。及时领取，过期无效哦。
                    </div>

        <?php } ?>

	</div>
			
</div> 

<script type="text/javascript">
$(document).ready(function(){
	$("[id^='flush_']").click(function(){
	var id = $(this).attr("id");
	var title_id = id+"_title";
	var title = $("#"+title_id).val();
		//bootbox.alert("Hello world!", function() {});
		bootbox.dialog({
		  // dialog的内容
		  message: "你确定刷新帖子 “"+title+"” 吗？",

		  // 退出dialog时的回调函数，包括用户使用ESC键及点击关闭
		  onEscape: function() {},
		   
		  // 是否显示此dialog，默认true
		  show: true,
		   
		  // 是否显示body的遮罩，默认true
		  backdrop: true,
		   
		  // 是否显示关闭按钮，默认true
		  closeButton: true,
		   
		  // 是否动画弹出dialog，IE10以下版本不支持
		  animate: true,
		   
		  // dialog的类名
		  className: "my-modal",
		   
		  // dialog底端按钮配置
		  buttons: {
			 
			// 其中一个按钮配置
			success: {   
			  // 按钮显示的名称
			  label: "刷新",
			   
			  // 按钮的类名
			  className: "btn-success",
			   
			  // 点击按钮时的回调函数
			  callback: function() {
					var value =id.substr(6);
					$.post("myPublish_ajax.php", {operate:"fresh",msg:value},function(data) {
							//alert(data);
							setTimeout(function(){window.location.reload();},1000);
					});
			  }
			},
			 
			// 另一个按钮配置
			"取消": {
			  className: "btn-default",
			  callback: function() {}
			}
		  }
		});
	});
});
</script>

<?php require dirname(__FILE__) . '/../include/footer.php';?>



















