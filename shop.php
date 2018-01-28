<?php $locate="shop";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	//$region = empty($_REQUEST['region'])|| !is_numeric($_REQUEST['region'])?'':$_REQUEST['region'];
	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
?>
<style>
._3z_5 {
    background-color: #fa3e3e;
    border-radius: 2px;
    color: #fff;
	font-size: 14px;
    padding: 1px 4px;
}

</style>
 <div class="container">
 	<div class="col-md-9" >	
		<div class="panel panel-default">
			<div class="panel-body">
				<span  id="">说明：功能正在规划中。</span>
			</div>
		</div>	
		

	<?php 
	$countSql = "select count(*) count from zl_shop where status!=-1";
	
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
		
<?php
		$sql = "select id, title,img,price,num,description,tel from  (select * from zl_shop where status!=-1 ";
		$sql = $sql."   order by sequence ) a limit ".$db_limit_start.",".$db_limit_offset;
		 
		$result = mysqli_query($conn,$sql);	
?>
			<div class="row">
			<?php		
				while($row = mysqli_fetch_assoc($result)){
			?>
				 	<div class="col-md-3">
					 	<div class="thumbnail">
					   	 	<img style="height:140px" src="<?php echo $row['img'];?>" class="img-rounded">
					   	 	<div class="caption">
								<h3><span style="color:#999"><?php echo $row['title']?></span></h3>
								<!--<div class="text-right"><?php echo "库存：".$row['num'];?></div>-->
								<p class="text-right"><strong><?php echo $row['price']?></strong></p>
					   	 		
								<div><?php echo $row['description'];?></div><br/>
								<?php if(!empty($row['tel'])){echo "<font style='color:red' >购买：</font><font style='color:red;font-size:17px;font-family:serif;'><I>".$row['tel']."</I></font>";}?>
					   	 	</div>
					   	 </div>
					</div>
			<?php
				}	
			?>
			 </div>
<?php require dirname(__FILE__) . '/include/page.php';?>
				</div>



	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading-blue">提示</div>
			<div class="panel-body">
				<p>支持一定时间内上门送货、货到付款的商户，可以联系本站，洽谈具体合作方式。
                    <br/><br/>类型：超市产品，商户产品，厂家产品。</p>
				
			</div>
		</div>
        
        <div class="panel panel-default">
            <div class="panel-heading-orange">
                推荐
                <a href="#" class="text-muted pull-right">>>></a>
            </div>
            <div class="panel-body">
                <img src="img/zhaozu_house.png" class="img-responsive center-block"/>
                <p>此处提供给各大超市、商户、厂家，可以链至您的网站、或本站为您提供的商户界面。<Br/>(半年租期、一天3.3元)</p>
            </div>
        </div>
	</div>	

</div>
<?php require dirname(__FILE__) . '/include/footer.php';?>