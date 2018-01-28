<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="myPublish_list";?>
<style>
table td{padding:7px 15px}
table th{padding:7px 15px}
.my-modal{position: absolute;top:25%; } 
</style>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<?php $menu_active="myPublish_list";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
			<!--住房-->
			<?php		
				$sql0 = "select id,build_time, title from  zl_house where status!=-1 and userid=".$_SESSION['tel']." order by build_time desc";
				$result0 = mysqli_query($conn,$sql0);	
				$rowcount0=mysqli_num_rows($result0);
				if($rowcount0>0){
			?>
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-home"></i>&nbsp;住房
			</div>
			<table class="table-hover" style="width:100%" >
				<?php while($row0 = mysqli_fetch_assoc($result0)){?>
				<tr>
					<td style="width:15%;" >
						<?php echo date('Y-m-d', strtotime($row0['build_time'])); ?>
					</td>
					<td style="width:70%;" >
						<?php echo htmlspecialchars($row0['title']);?>
					</td>
					<td style="width:15%;" >
						<a href="#" id="remove_house_<?php echo $row0['id']?>"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
							<input type="hidden" id="remove_house_<?php echo $row0['id']?>_title" value="<?php echo htmlspecialchars($row0['title']);?>" />
					</td>
				</tr>
				<?php }?>
			</table>
		</div>
			<?php }?>

			<!--工作-->
			<?php		
				$sql1 = "select id,modify_time, title from  zl_employ where status!=-1 and userid=".$_SESSION['tel']." order by modify_time desc";
				$result1 = mysqli_query($conn,$sql1);	
				$rowcount1=mysqli_num_rows($result1);
				if($rowcount1>0){
			?>
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-education"></i>&nbsp;工作
			</div>
				<table class="table-hover" style="width:100%" >
					<?php while($row1 = mysqli_fetch_assoc($result1)){?>
					<tr>
						<td style="width:15%;padding:7px 15px" >
							<?php echo date('Y-m-d', strtotime($row1['modify_time'])); ?>
						</td>
						<td style="width:70%;" >
							<?php echo htmlspecialchars($row1['title']);?>
						</td>
						<td style="width:15%;" >
							<a href="#" id="remove_employ_<?php echo $row1['id']?>"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
							<input type="hidden" id="remove_employ_<?php echo $row1['id']?>_title" value="<?php echo htmlspecialchars($row1['title']);?>" />
						</td>
					</tr>
					<?php }?>
				</table>
		</div>
			<?php }?>

			<!--便民-->
			<?php		
				$sql = "select id,modify_time, title from  zl_tel where status!=-1 and userid=".$_SESSION['tel']." order by modify_time desc";
				$result = mysqli_query($conn,$sql);	
				$rowcount=mysqli_num_rows($result);
				if($rowcount>0){
			?>
        <div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-wrench"></i>&nbsp;便民
			</div>
				<table class="table-hover" style="width:100%" >
					<?php while($row = mysqli_fetch_assoc($result)){?>
					<tr>
						<td style="width:15%;padding:7px 15px" >
								<?php echo date('Y-m-d', strtotime($row['modify_time'])); ?>
						</td>
						<td style="width:70%;" >
								<?php echo htmlspecialchars($row['title']);?>
						</td>
						<td style="width:15%;" >
							<a href="#" id="remove_tel_<?php echo $row['id']?>"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
							<input type="hidden" id="remove_tel_<?php echo $row['id']?>_title" value="<?php echo htmlspecialchars($row['title']);?>" />
						</td>
					</tr>
					<?php }?>
				</table>
		</div>
			<?php }?>

			<!--教育-->
			<?php		
				$sql4 = "select id,modify_time, title from  zl_education where status!=-1 and userid=".$_SESSION['tel']." order by modify_time desc";
				$result4 = mysqli_query($conn,$sql4);	
				$rowcount4=mysqli_num_rows($result4);
				if($rowcount4>0){
			?>
        <div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-wrench"></i>&nbsp;教育
			</div>
				<table class="table-hover" style="width:100%" >
					<?php while($row4 = mysqli_fetch_assoc($result4)){?>
					<tr>
						<td style="width:15%;padding:7px 15px" >
								<?php echo date('Y-m-d', strtotime($row4['modify_time'])); ?>
						</td>
						<td style="width:70%;" >
								<?php echo htmlspecialchars($row4['title']);?>
						</td>
						<td style="width:15%;" >
							<a href="#" id="remove_tel_<?php echo $row4['id']?>"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
							<input type="hidden" id="remove_tel_<?php echo $row4['id']?>_title" value="<?php echo htmlspecialchars($row4['title']);?>" />
						</td>
					</tr>
					<?php }?>
				</table>
		</div>
			<?php }?>
            
			<?php		
				if($rowcount==0&&$rowcount0==0&&$rowcount1==0&&$rowcount4==0){
			?>
            <div class="panel panel-default" >
                <div class="panel-heading" style="background-color:#fff;" ><i class="glyphicon glyphicon-trash"></i>&nbsp;
                    删除帖子
                </div>
                <div class="panel-body" style="padding:20px 50px 20px 50px">
                    <p style="color:#999"> 您还没有发帖记录。</p>
                </div>
            </div>
			<?php }?>
            
	</div>
			
</div> 

<script type="text/javascript">
$(document).ready(function(){
	$("[id^='remove_']").click(function(){
	var id = $(this).attr("id");
	var title_id = id+"_title";
	var title = $("#"+title_id).val();
		//bootbox.alert("Hello world!", function() {});
		bootbox.dialog({
		  // dialog的内容
		  message: "你确定删除帖子 “"+title+"” 吗？",

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
			  label: "删除该帖",
			   
			  // 按钮的类名
			  className: "btn-success",
			   
			  // 点击按钮时的回调函数
			  callback: function() {
					var value =id.substr(7);
					$.post("myPublish_ajax.php", {operate:"remove",msg:value},function(data) {
							if("ok"!=data&&"error"!=data){
								bootbox.dialog({
									  message: data,
									  animate: true,
									  className: "my-modal",
									  buttons: {
										success: {   
										  label: "坚持删除该帖",
										  className: "btn-success",
										  callback: function() {
												$.post("myPublish_ajax.php", {operate:"remove_force",msg:value},function(d) {
														setTimeout(function(){window.location.reload();},1000);
												});
										  }
										},
										 
											// 另一个按钮配置
											"保留该帖": {
											  className: "btn-info",
											  callback: function() {}
											}
										},
								});
							}else{
								setTimeout(function(){window.location.reload();},1000);
							}

					});
			  }
			},
			 
			// 另一个按钮配置
			"保留该帖": {
			  className: "btn-info",
			  callback: function() {}
			}
		  }
		});
	});
});

</script>

<?php require dirname(__FILE__) . '/../include/footer.php';?>