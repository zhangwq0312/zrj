<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php	
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$type = empty($_REQUEST['type'])?'':$_REQUEST['type'];

	$db_limit_offset = 20;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
	$countSql = "select count(*) count from index_net where status!=-1 and type = '".$type."'";
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);

?>
<script type="text/javascript">
function page(i){
		window.location.href="/index_net_list.php?page="+i+"&type="+document.getElementById("type").value; 
}
</script>

 <div class="container">
	<div class="col-md-12" >
	
				<ol class="breadcrumb" style="margin-bottom:0px;color:#999;font-size:15px">
					<?php 
						if($type=="gov"){
							echo "<li><a href='/'>资讯</a></li><li><a href='index_net_list.php?type=my'>政府新闻</a></li><li>列表</li>";
						}
						if($type=="base"){
							echo "<li><a href='/'>资讯</a></li><li><a href='index_net_list.php?type=xinwen'>网络链接</a></li><li>列表</li>";
						}
					?>
				</ol>
				<?php
                        $sql = "select id, title,source_url,build_time from  (select * from index_net where status!=-1 and type ='".$type."'";
                        $sql = $sql." order by order_num,build_time desc) a limit 0,9";
						$result = mysqli_query($conn,$sql);
				?>
	<table class="table table-hover" style="margin-top:0px">
					<?php			
						while($row = mysqli_fetch_assoc($result)){
					?>
	<tr><td style="border:1px ;border-bottom:1px #ddd DASHED;">
					<a href="<?php echo $row['source_url'];?>" target="_blank"><?php echo $row['title']; ?></a>			
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