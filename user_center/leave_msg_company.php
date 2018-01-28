<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="leave_msg_company";?>
<style>
.table>tbody>tr>td {
    padding: 15px;
    line-height: 1.5;
    vertical-align: top;
    border-bottom: 1px solid #ddd;
    border-top: 0px;
}
</style>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-volume-up"></i>&nbsp;商家收信
			</div>
			<div class="panel-body" >
						<?php		
							$sql = "select * from  t_leave_msg where to_tel='".$_SESSION['tel']."' and status!=-1 and type='leave_msg_company'";
							$sql = $sql." order by create_time desc";
							$result = mysqli_query($conn,$sql);	
						?>
				<table class="table table-bordered table-hover" style="table-layout:fixed;padding: 10px 15px ;">
						<thead><tr>
							<td style="text-align:center;font-size:15px;width:15%" class="info">留言日期</td>
							<td style="text-align:center;font-size:15px;width:20%" class="info">发信人</td>
							<td style="text-align:center;font-size:15px;width:65%" class="info">内容</td>
						</tr></thead>
						<?php
						while($row = mysqli_fetch_assoc($result)){
							?>

											<tr>
												<td style="text-align:center;WORD-WRAP: break-word;padding: 7px 0 7px 0;">
													<?php echo date('Y-m-d', strtotime($row['create_time'])); ?>
												</td>
												<td style="WORD-WRAP: break-word;text-align:center;padding: 7px 0 7px 0;">
													<?php echo htmlspecialchars($row['from_tel']); ?>
												</td>
												<td style="WORD-WRAP: break-word;padding: 7px 0 7px 15px;">
														<?php echo htmlspecialchars($row['description']); ?>
												</td>
											</tr>
				<?php }?>
				</table>
				<div class="text-right" style="padding: 10px 15px ;color:#999">注：仅显示近两个月的信息</div>
			</div>
		</div>
	</div>
			
</div> 
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















