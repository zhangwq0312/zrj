<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php	
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$type = empty($_REQUEST['type'])?'':$_REQUEST['type'];

	$db_limit_offset = 20;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
	$countSql = "select count(*) count from zl_discount where status!=-1 and born_day_end>date_add(now(), INTERVAL -1 day)";
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
<script type="text/javascript">
function page(i){
		window.location.href="/discountList.php?page="+i; 
}
</script>

 <div class="container">
	<div class="col-md-12 row" >
				<ol class="breadcrumb" style="margin-bottom:0px;color:#999;font-size:15px">
					<li><a href='/'>资讯</a></li><li><a href='#'>商家优惠活动</a></li><li>列表</li>
				</ol>
				<?php
						$sql = "select * from  (select a.c_id id,a.title ,b.short_name short_name,a.born_day_end born_day_end,a.born_day_begin from zl_discount a,zl_company b where a.status!=-1 and b.status!=-1 and a.born_day_end>date_add(now(), INTERVAL -1 day) and a.c_id=b.id  order by a.born_day_end desc,a.born_day_begin desc) a limit ".$db_limit_start.",".$db_limit_offset;
						//echo $sql;
						$result = mysqli_query($conn,$sql);
				?>
	<table class="table table-hover" >
					<?php			
						while($row = mysqli_fetch_assoc($result)){
					?>
	<tr><td style="border:1px ;border-bottom:1px #ddd DASHED;">
					<div class="col-md-9"><a href="company.php?id=<?php echo $row['c_id'];?>"><?php echo $row['short_name'];?>&nbsp;:&nbsp;<?php echo $row['title']; ?></a></div>
					<div class="col-md-3 text-right" style="color:#999;"><small>起：<?php echo substr($row["born_day_begin"],0,10);?>&#12288;止：<?php echo substr($row["born_day_end"],0,10);?></small></div>
	</td></tr>
			<?php
				}	
			?>		
	</table>
					
<?php require dirname(__FILE__) . '/include/page.php';?>
	</div>
</div>

<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>