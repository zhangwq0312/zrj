<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="account";?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-duplicate"></i>&nbsp;我的账户余额
			</div>
			<div class="panel-body row" style="padding:20px 50px 20px 50px">
<?php
	$sql = "select * from i_account where  userid=".$_SESSION['tel'];
	$result = mysqli_query($conn,$sql);	
	$row = mysqli_fetch_assoc($result);
?>
	<p style="color:#999">
		您当前的账户余额为：
		<span style="font-size:30px;color:#000"><?php echo empty($row["money_now"])? '0':$row["money_now"]; ?></span>
		<span style="font-size:18px;color:#000">
			<i class="glyphicon glyphicon-jpy"></i>
		</span>
	</p>
			
	<p style="color:#999">
		您历史上交费总金额
		<span style="font-size:18px;color:#000">
		<?php echo empty($row["money_add"])? '0':$row["money_add"]; ?>
		</span>
		元，扣费总金额
		<span style="font-size:18px;color:#000">
		<?php echo empty($row["money_cut"])? '0':$row["money_cut"]; ?>
		</span>
		元。
	</p>

	<br/>
	<br/>

<?php
	$sql0 = "select a.*,b.name cuttype_name,b.unit_price from i_account_history a left join  zz_cuttypes b on  b.id=a.cuttype_id where a.userid=".$_SESSION['tel']."  order by a.create_time desc limit 5 ";
	$result0 = mysqli_query($conn,$sql0);	
    $rowcount0=mysqli_num_rows($result0);
    if($rowcount0>0){
?>
	<p style="color:#999">
		最近五次操作如下
	</p>
<!--需要我根据来源判断来重新排版，手机上就不需要有自动隔色排行了。add by zhangwq-->
		<div class=" col-md-12" >
			<table class="table table-bordered table-hover" style="table-layout:fixed;">
				<?php while($row_0 = mysqli_fetch_assoc($result0)){?>
				<tr>
					<td style="width:20%;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
						<?php echo date('Y-m-d H:i:s', strtotime($row_0['create_time'])); ?>
					</td>
					<td style="width:10%;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
						<?php 
							if($row_0['money_change']>0){
								echo "+".$row_0['money_change'];
							}else{
								echo $row_0['money_change'];
							}
						?>
					</td>
					<td style="width:70%;white-space:normal;WORD-WRAP: break-word;padding: 7px 7px 7px 15px;" >
						<?php 
							if($row_0['money_change']<0){
								echo '扣费&#12288;';
							}
							if($row_0['money_change']>0){
								echo  '交费&#12288;';
							}
							
							if(!empty($row_0["cuttype_name"])){
								echo $row_0["unit_num"]."份"."“<span style='color:#337ab7'>".$row_0["cuttype_name"]."</span>”业务，单价".$row_0["unit_price"]."元，合计".$row_0["unit_num"]*$row_0["unit_price"]."元";
							}
						?>
					</td>
				</tr>
				<?php }?>
			</table>
		</div>
    <?php }?>
    
    
	<p style="color:#666">
		注：本系统不对婚恋类费用进行统计。
	</p>
        
        
			</div>
		</div>
	</div>
			
</div> 
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















