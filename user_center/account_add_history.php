﻿<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="account_add_history";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" ><i class="glyphicon glyphicon-duplicate"></i>&nbsp;
				交费历史记录
			</div>

<?php
	$sql0 = "select * from i_account_history where  userid='".$_SESSION['tel']."' and money_change>0 order by create_time desc ";
	$result0 = mysqli_query($conn,$sql0);	
    $rowcount0=mysqli_num_rows($result0);
    if($rowcount0>0){
?>
			<div class="panel-body" style="padding:20px 50px 20px 50px">
					<div style="padding:0 30px 0 30px">
						<table class="table table-hover table-striped" >
							<?php while($row_0 = mysqli_fetch_assoc($result0)){?>
							<tr>
								<td style="width:20%;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
									<?php echo date('Y-m-d H:i:s', strtotime($row_0['create_time'])); ?>
								</td>
								<td style="width:10%;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
									<?php 
										echo "+".$row_0['money_change'];
									?>
								</td>
								<td style="width:70%;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
									交费
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
            </div>
			<?php } else {?>
					<div class="panel-body" style="padding:20px 50px 20px 50px">
                        <p style="color:#999"> 您还没有交费记录。</p>
                    </div>
            <?php }?>

		</div>
	</div>
			
</div> 
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















