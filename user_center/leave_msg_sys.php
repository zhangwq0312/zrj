<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="leave_msg_sys";?>
<style>
.table>thead>tr>td {
    text-align:center;
}
.table>tbody>tr>td {
    padding: 5px 15px 5px 15px;
    line-height: 1.5;
    vertical-align: top;
    border-bottom: 1px solid #ddd;
    border-top: 0px;
    text-align:center;
    font-size:15px;
    WORD-WRAP: break-word;
}
.table{table-layout:fixed;}
</style>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;">
				<i class="glyphicon glyphicon-volume-up"></i>&nbsp;系统消息
			</div>
			<div class="panel-body" >
						<?php		
							$sql = "select * from  t_leave_msg where from_tel='".$_SESSION['tel']."' and status!=-1 and type='leave_msg_sys'";
							$sql = $sql." order by create_time desc";
							$result = mysqli_query($conn,$sql);	
						?>
						<?php 
							$rowcount=mysqli_num_rows($result);
							if($rowcount>0){
						?>
						
				<table class="table table-bordered table-hover table-striped" >
						<thead><tr>
							<td style="text-align:center;font-size:15px;width:15%" class="success">开始日期</td>
							<td style="text-align:center;font-size:15px;width:42%" class="success">我的发言</td>
							<td style="text-align:center;font-size:15px;width:43%" class="danger">客服发言</td>
							</tr></thead>
						<?php
						while($row = mysqli_fetch_assoc($result)){
							?>
                                <tr>
                                    <td>
                                        <?php echo date('Y-m-d', strtotime($row['create_time'])); ?>
                                    </td>
                                    <td  style="text-align:left;">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </td>
                                    <td  style="text-align:left;">
                                        <?php 
                                        if($row['status']=="0"&&empty($row['reply'])){
                                            echo "<span style='color:red;font-size:15px'>您的留言已收到，请等待回复</span>";
                                        }else{
                                            echo htmlspecialchars($row['reply']); 
                                        }
                                        ?>
                                    </td>
                                </tr>
						<?php }?>
				</table>
				<?php }?>
				<div class="text-right" style="padding: 10px 15px ;color:#999">注：仅显示近两个月的消息</div>
			</div>
		</div>
	</div>
			
</div> 
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















