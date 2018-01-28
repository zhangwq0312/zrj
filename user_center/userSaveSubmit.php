<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
$mail=$_POST['mail'];
$ni=$_POST['ni'];
$username=$_POST['username'];
$sex=$_POST['sex'];
$born_day=$_POST['born_day'];
$address=$_POST['address'];

$pwd_question=$_POST['pwd_question'];
$pwd_answer=$_POST['pwd_answer'];

$stmt=mysqli_stmt_init($conn);
$sql = "update  t_user set pwd_question=?,pwd_answer=?,mail=?,ni=?,username=?,sex=?,born_day=?,address=?,modify_time=now() where tel=?";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'sssssisss',$pwd_question,$pwd_answer,$mail, $ni, $username,$sex,$born_day,$address,$_SESSION['tel']);
	mysqli_stmt_execute($stmt);
	$_SESSION['ni']=$ni;
    $_SESSION['username']=$username;
	echo "已保存成功";
}
?> 
