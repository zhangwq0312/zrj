<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="myPublish_refresh";?>
<style>
table td{padding:7px 15px}
table th{padding:7px 15px}
.my-modal{position: absolute;top:25%; } 
</style>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
			<!--住房-->
			<?php		
				$sql0 = "select id,build_time,build_time>now() isautoflushing, title from  zl_house where status!=-1 and userid=".$_SESSION['tel']." order by build_time desc";
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
							<?php if($row0['isautoflushing']==1){?>
								  已订购自动刷新
							<?php } else { ?>
								<a href="#" id="flush_house_<?php echo $row0['id']?>"><i class="glyphicon glyphicon-refresh" title="刷新"></i></a>
							<?php } ?>
							
							<input type="hidden" id="flush_house_<?php echo $row0['id']?>_title" value="<?php echo htmlspecialchars($row0['title']);?>" />
							</td>
                        </tr>
                        <?php }?>
                    </table>
            </div>
			<?php }?>

		
		
		

			<!--工作-->
			<?php		
				$sql1 = "select id,build_time,build_time>now() isautoflushing,  title from  zl_employ where status!=-1 and userid=".$_SESSION['tel']." order by build_time desc";
				$result1 = mysqli_query($conn,$sql1);	
				$rowcount1=mysqli_num_rows($result1);
				if($rowcount1>0){
			?>
            <div class="panel panel-default" >
                <div class="panel-heading" style="background-color:#fff;" >
                    <i class="glyphicon glyphicon-bullhorn"></i>&nbsp;工作
                </div>
            
				<table class="table-hover" style="width:100%" >
					<?php while($row1 = mysqli_fetch_assoc($result1)){?>
					<tr>
						<td style="width:15%;padding:7px 15px" >
							<?php echo date('Y-m-d', strtotime($row1['build_time'])); ?>
						</td>
						<td style="width:70%;" >
							<?php echo htmlspecialchars($row1['title']);?>
						</td>
						<td style="width:15%;" >
							<?php if($row1['isautoflushing']==1){?>
								  已订购自动刷新
							<?php } else { ?>
								<a href="#" id="flush_employ_<?php echo $row1['id']?>"><i class="glyphicon glyphicon-refresh" title="刷新"></i></a>
							<?php } ?>
							<input type="hidden" id="flush_employ_<?php echo $row1['id']?>_title" value="<?php echo htmlspecialchars($row1['title']);?>" />
						</td>
					</tr>
					<?php }?>
				</table>
            </div>
			<?php }?>



			<!--便民-->
			<?php		
				$sql = "select id,build_time,build_time>now() isautoflushing,  title from  zl_tel where status!=-1 and userid=".$_SESSION['tel']." order by build_time desc";
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
								<?php echo date('Y-m-d', strtotime($row['build_time'])); ?>
						</td>
						<td style="width:70%;" >
								<?php echo htmlspecialchars($row['title']);?>
						</td>
						<td style="width:15%;" >
							<?php if($row['isautoflushing']==1){?>
								  已订购自动刷新
							<?php } else { ?>
								<a href="#" id="flush_tel_<?php echo $row['id']?>"><i class="glyphicon glyphicon-refresh" title="刷新"></i></a>
							<?php } ?>
							<input type="hidden" id="flush_tel_<?php echo $row['id']?>_title" value="<?php echo htmlspecialchars($row['title']);?>" />
						</td>
					</tr>
					<?php }?>
				</table>
                </div>
			<?php }?>
		
			<!--教育-->
			<?php		
				$sql4 = "select id,build_time,build_time>now() isautoflushing,  title from  zl_education where status!=-1 and userid=".$_SESSION['tel']." order by build_time desc";
				$result4 = mysqli_query($conn,$sql4);	
				$rowcount4=mysqli_num_rows($result4);
				if($rowcount4>0){
			?>
            <div class="panel panel-default" >
                <div class="panel-heading" style="background-color:#fff;" >
                    <i class="glyphicon glyphicon-education"></i>&nbsp;教育
                </div>
				<table class="table-hover" style="width:100%" >
					<?php while($row4 = mysqli_fetch_assoc($result4)){?>
					<tr>
						<td style="width:15%;padding:7px 15px" >
								<?php echo date('Y-m-d', strtotime($row4['build_time'])); ?>
						</td>
						<td style="width:70%;" >
								<?php echo htmlspecialchars($row4['title']);?>
						</td>
						<td style="width:15%;" >
							<?php if($row4['isautoflushing']==1){?>
								  已订购自动刷新
							<?php } else { ?>
								<a href="#" id="flush_tel_<?php echo $row4['id']?>"><i class="glyphicon glyphicon-refresh" title="刷新"></i></a>
							<?php } ?>
							<input type="hidden" id="flush_tel_<?php echo $row4['id']?>_title" value="<?php echo htmlspecialchars($row4['title']);?>" />
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
                <div class="panel-heading" style="background-color:#fff;" ><i class="glyphicon glyphicon-refresh"></i>&nbsp;
                    刷新帖子
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



















