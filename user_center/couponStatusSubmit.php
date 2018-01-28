<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
$pwd_old=$_POST['pwd_old'];
$pwd_new=$_POST['pwd_new'];
$pwd_new2=$_POST['pwd_new2'];

if(trim($pwd_old)==""){
	echo "请输入当前密码";exit;
}
if(trim($pwd_new)==""){
	echo "请输入新密码";exit;
}
if(trim($pwd_new2)==""){
	echo "请输入第二次新密码";exit;
}
if($pwd_old==$pwd_new){
	echo "你输入的当前密码与新密码相同，请修改";exit;
}
if($pwd_new!=$pwd_new2){
	echo "两次输入的新密码不一致，请重新修改";exit;
}
$stmt=mysqli_stmt_init($conn);

$pwd_old_md5=substr(md5($pwd_old."5qtje0k"),8,16);
$pwd_new_md5=substr(md5($pwd_new."5qtje0k"),8,16);
/*
$passwordSys="";
if (mysqli_stmt_prepare($stmt,"select password from t_user  where tel=? limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$_SESSION['tel']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_pwd);
	while (mysqli_stmt_fetch($stmt)) {
			$passwordSys=$s_pwd;
	}
}
echo $pwd_old."-----";
echo $pwd_old_md5."-----";
echo $passwordSys."-----";

if($passwordSys!=$pwd_old_md5){
	echo "旧密码输入错误1";exit;
}
*/
$sql = "update  t_user set password=? where tel=? and password=?";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'sss',$pwd_new_md5,$_SESSION['tel'],$pwd_old_md5);
	mysqli_stmt_execute($stmt);
	$num = mysqli_stmt_affected_rows($stmt);
	if($num==1){
		echo "密码修改成功";exit;
	}else{
		echo "当前密码输入错误";exit;
	}
}
?>
