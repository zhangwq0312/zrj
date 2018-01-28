<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 

$refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';

if(empty($tel)){
	$msg="100";//手机号不能为空
	header("location: /resetPassword.php?refer=".$refer."&msg=".$msg);exit;
}
if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)){  
	$msg="101";//手机号有误，请检查
	header("location: /resetPassword.php?refer=".$refer."&msg=".$msg);exit;
}  

$checkcode = isset($_REQUEST['checkcode']) ? $_REQUEST['checkcode'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
$pwd_answer = isset($_REQUEST['pwd_answer']) ? $_REQUEST['pwd_answer'] : '';

$stmt=mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt,"select pwd_answer,tel from t_user  where tel= ? and status!=-1 limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_pwd_answer,$s_tel);
	mysqli_stmt_fetch($stmt);
}

if(empty($s_tel)){
	header("location: /resetPassword.php?refer=".$refer."&msg=200");exit;
}

if($s_pwd_answer!=$pwd_answer){
	header("location: /resetPassword.php?refer=".$refer."&tel=".$tel."&msg=201");exit;
}

$s_code="";
if (mysqli_stmt_prepare($stmt,"select code from (select * from t_checkcode  where tel= ? and status=1 and type='resetPassword' order by create_time desc) a limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_code);
	mysqli_stmt_fetch($stmt);
}
if($checkcode!=$s_code){
	$msg="203";
	header("location: /resetPassword.php?refer=".$refer."&tel=".$tel."&msg=".$msg);exit;
}

$password=substr(md5($password."5qtje0k"),8,16);

$sql = "update t_user set password=?,modify_time=now() where tel=?";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt, 'ss',$password,$tel);
	mysqli_stmt_execute($stmt);

	$_SESSION['tel']=$tel;
	if (mysqli_stmt_prepare($stmt, "update t_checkcode set status=-1,modify_time=now() where tel=? and type='resetPassword'")) {
		mysqli_stmt_bind_param($stmt, 's', $tel);
		 mysqli_stmt_execute($stmt);
	}	
}


if (empty($_SESSION['tel'])) {
	echo "重置密码失败";
}else{
	 header("location: /regResetPwdSuccess.php?refer=".$refer."&type=resetPassword");
}
