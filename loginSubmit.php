<?php session_start();?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php $refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';

$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

$telSys="";
$passwordSys="";
$ni="";
$username="";

$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select  tel,password,ni,username from t_user  where tel=? and status!=-1 limit 1")){
	mysqli_stmt_bind_param($stmt,"s",$tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$s_tel,$s_password,$s_ni,$s_username);
	//mysqli_stmt_fetch($stmt);
	while (mysqli_stmt_fetch($stmt)) {
			$telSys=$s_tel;
			$passwordSys=$s_password;
			$ni=$s_ni;
			$username=$s_username; 
	}
}

$msg="";
if(empty($telSys)){
	$msg="001";
	header("location: /login.php?refer=".$refer."&msg=".$msg);exit;
}

if(!empty($telSys)&&(substr(md5($password."5qtje0k"),8,16)!=$passwordSys)){
	$msg="002";
	header("location: /login.php?refer=".$refer."&msg=".$msg);exit;
}
$_SESSION['tel']=$telSys;
$_SESSION['ni']=$ni;
$_SESSION['username']=$username;

$sql = "insert into l_login_log (login_name) values (?)";

if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt, 's', $_SESSION['tel']);
	mysqli_stmt_execute($stmt);
}

if (empty($_SESSION['tel'])) {
	if (empty($refer)) {
		header("location: /login.php");exit;
	}else{
		header("location: /login.php?refer=".$refer);exit;
	}
}else{
	if (empty($refer)) {
		header("location: /index.php");exit;
	}else{
		header("location: ".$refer);exit;
	}
}
