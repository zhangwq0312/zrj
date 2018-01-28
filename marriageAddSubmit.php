<?php $locate="marriage";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php if(empty($_SESSION['tel'])||isNotAdmin($_SESSION['tel'])){ return;}   ?>
<?php require dirname(__FILE__) . '/include/db.php';?>


<?php
$fullname=$_POST['fullname'];
$sex=$_POST['sex'];
$born_time=$_POST['born_time'];
$education=$_POST['education'];
$job=$_POST['job'];
$tel=$_POST['tel'];
$message=$_POST['message'];
$address=$_POST['address'];
$identity=$_POST['identity'];
$photo=$_POST['photo'];
$email=$_POST['email'];



$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select count(*) count from zl_marriage where tel=? and fullname=?")){
	mysqli_stmt_bind_param($stmt,"ss",$tel,$fullname);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$count);
	mysqli_stmt_fetch($stmt);

if($count>0){

	?>
	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					系统内已经有同一用户，同一手机号的人员信息，添加失败，请客服处理。
				</div>
			</div>
	</div>
	<?php	
}else{
	$sql = "insert into zl_marriage (email,fullname,address,identity,photo,  tel,born_time,education,sex,job,  message,create_time,modify_time,status,userid)
		values (?,?,?,?,?,?,?,?,?,?,?,now(),now(),0,?)";

	if (mysqli_stmt_prepare($stmt, $sql)) {
        $born_time=$born_time."-01-01 00:00:00";
		mysqli_stmt_bind_param($stmt,'sssiisssisss',$email,$fullname,$address,$identity,$photo,$tel,$born_time,$education,$sex,$job,$message,$_SESSION['tel']);
		mysqli_stmt_execute($stmt);
	}

	?>

	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					您的信息已成功提交。
				</div>
			</div>
	</div>
<?php
}
}
?>
<?php require dirname(__FILE__) . '/include/footer.php';?>