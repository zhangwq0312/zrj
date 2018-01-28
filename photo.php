<?php $locate="photo";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];

	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
?>

	<?php 
		//-------------------php 直接查询db，后期优化-----------------------------------
	define ('HOSTNAME', 'localhost'); //数据库主机名 
	define ('USERNAME', 'root'); //数据库用户名 
	define ('PASSWORD', 'root'); //数据库用户登录密码 
	define ('DATABASE_NAME', 'task'); //需要查询的数据库 

	$connect = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE_NAME) or die('Unale to connect');
	
	$countSql = "select count(*) from photo ";
	$countResult = mysqli_query($connect,$countSql);
	$countRow = mysqli_fetch_row($countResult);
	$count = ceil  ($countRow[0]/12);
?>


 <div class="container">
			
 	
			<div class="row">
			<?php		
				$sql = "select id,title,text,url from photo limit ".$db_limit_start.",".$db_limit_offset;
				$result = mysqli_query($connect,$sql);	
				while($row = mysqli_fetch_row($result)){
			?>
				 	<div class="col-md-3">
					 	<div class="thumbnail">
					   	 	<img src="<?php echo $row[3];?>" class="img-rounded">
					   	 	<div class="caption">
					   	 		<p><?php echo $row[1];?></p>
					   	 	</div>
					   	 </div>
					</div>
			<?php
				}	
			?>
			 </div>
			 
			<div class="text-center" >
				<ul class="pagination" style="margin-top: 0px;margin-bottom: 10px;">
					<li><a href="#">&laquo;</a></li>
					<?php  for($i=1;$i<$count+1;$i++){?>
						<li><a href="/photo.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
					<?php }?>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
	 
</div>

<?php require dirname(__FILE__) . '/include/footer.php';?>



















