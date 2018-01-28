<?php
 session_start(); 
?>
<?php require dirname(__FILE__) . '/../include/checkSession.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
$coupon_user_id=empty($_POST['coupon_user_id'])|| !is_numeric($_POST['coupon_user_id'])||$_POST['coupon_user_id']<1 ? '':$_POST['coupon_user_id'];
if(empty($coupon_user_id)){echo "error1";exit;}
$type=$_POST["type"];
if(empty($type)){ echo "error2";exit;}
if($type=="used"){
    $to_status=-1;
}else if ($type=="nouse"){
    $to_status=0;
}else{
    echo "error3";exit;
}

$stmt=mysqli_stmt_init($conn);
$sql = "update z_coupon_user set status=? where id=? and gid in ( select id from z_coupon t where t.userid=?) ";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'iis',$to_status, $coupon_user_id,$_SESSION['tel']);
	mysqli_stmt_execute($stmt);
	$num = mysqli_stmt_affected_rows($stmt);
	if($num==0){
		echo "error4";exit;
	}else{
		echo "success";exit;
	}
	
}else{
	echo "error5，请联系客服";exit;
}

?>