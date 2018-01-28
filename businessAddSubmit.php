<?php $locate="company";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 
// 将有效期设置为当前时间的一个月多一天再减去1秒
?>
<?php
$title=$_POST['title'];
$leixing=$_POST['leixing'];
if(!is_numeric($leixing)){
	echo "格式有误";exit;
}
$short_name=$_POST['short_name'];
$tel=$_POST['tel'];

	if(empty($title)
		||empty($leixing)
		||empty($tel)){
		echo "您输入的数据有误，请重新输入";
		return;
	}
$chongfu = "select count(*) from zl_company where name='".$title."'";
$chongfuResult = mysqli_query($conn,$chongfu);
$chongfuRow = mysqli_fetch_row($chongfuResult);
if($chongfuRow[0]>0){
	?>
	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					该商家名称之前已经存在，请检查。
				</div>
			</div>
	</div>
	<?php	
	return;
}
	$sql = "insert into zl_company (userid,tel,leixing,name,short_name,create_time,modify_time,build_time,status,create_operator_id)
			values (?,?,?,?,?,now(),now(),now(),0,-1)";
	$stmt = mysqli_stmt_init($conn);
	
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, 'sssss', $tel,$tel, $leixing, $title,$short_name);
        mysqli_stmt_execute($stmt);
		
		$insert_id = mysqli_stmt_insert_id($stmt);
		//echo $insert_id;exit;
		$sql = "insert into zl_discount (c_id,status,userid) values (?,-1,?)";
		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, 'is', $insert_id,$tel);
			mysqli_stmt_execute($stmt);
		}
	}
	
	
$count = "select count(*) from zl_company where userid='".$tel."'";
$countResult = mysqli_query($conn,$count);
$countRow = mysqli_fetch_row($countResult);

if($countRow[0]>0){

	?>
	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					该手机号已创建<?php echo $countRow[0];?>条商家信息。请通知商家前往商户管理界面。
				</div>
			</div>
	</div>
	<?php	
}
	?>

<?php require dirname(__FILE__) . '/include/footer.php';?>