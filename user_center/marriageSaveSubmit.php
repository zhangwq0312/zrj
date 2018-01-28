<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php

$email=$_POST['email'];
$education=$_POST['education'];
$job=$_POST['job'];
$message=$_POST['message'];
$address=$_POST['address'];

$stmt=mysqli_stmt_init($conn);
$sql = "update zl_marriage set address=?,education=?,job=?,message=?,email=? where tel=?";

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt,'ssssss',$address,$education,$job,$message,$email,$_SESSION['tel']);
    mysqli_stmt_execute($stmt);
	echo "已保存成功";
}
?> 
