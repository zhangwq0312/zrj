<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 

$refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';
if(empty($tel)){
	$msg="200";//手机号不能为空
	header("location: /register.php?refer=".$refer."&msg=".$msg);exit;
}
if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)){  
	$msg="201";//手机号有误，请检查
	header("location: /register.php?refer=".$refer."&msg=".$msg);exit;
}  
$checkcode = isset($_REQUEST['checkcode']) ? $_REQUEST['checkcode'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
$password2 = isset($_REQUEST['password2']) ? $_REQUEST['password2'] : '';

$stmt=mysqli_stmt_init($conn);

$s_tel="";
if (mysqli_stmt_prepare($stmt,"select tel from t_user  where tel= ? and status!=-1 limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_tel);
	mysqli_stmt_fetch($stmt);
}
if(!empty($s_tel)){
	header("location: /register.php?refer=".$refer."&msg=101");exit;
}
	
$s_code="";
if (mysqli_stmt_prepare($stmt,"select code from (select * from t_checkcode  where tel= ? and status=1 and type='reg' order by create_time desc) a limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_code);
	mysqli_stmt_fetch($stmt);
}
if($checkcode!=$s_code){
	$msg="103";
	header("location: /register.php?refer=".$refer."&msg=".$msg);exit;
}
	
if($password!=$password2){
	$msg="102";
	header("location: /register.php?refer=".$refer."&msg=".$msg);exit;
}

$password=substr(md5($password."5qtje0k"),8,16);

$sql = "insert into t_user (tel,password,create_time,modify_time) values (?,?,now(),now())";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt, 'ss', $tel,$password);
	$num = mysqli_stmt_execute($stmt);
	
	$_SESSION['tel']=$tel;
	if (mysqli_stmt_prepare($stmt, "update t_checkcode set status=-1,modify_time=now() where tel=? and type='reg'")) {
		mysqli_stmt_bind_param($stmt, 's', $tel);
		 mysqli_stmt_execute($stmt);
	}	
}


if (empty($_SESSION['tel'])) {
	echo "注册失败";
}else{
	 header("location: /regResetPwdSuccess.php?refer=".$refer."&type=reg");
}
