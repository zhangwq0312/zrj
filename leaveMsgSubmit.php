<?php session_start();?>
<?php require dirname(__FILE__) . '/common/const.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 

$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$to_tel = isset($_POST['to_tel']) ? $_POST['to_tel'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';

if(empty($_SESSION['tel'])||$_SESSION['tel']!=$tel){
	$checkcode = isset($_POST['checkcode']) ? $_POST['checkcode'] : '';
	$sql2 = "select code from (select * from t_checkcode  where tel= '".$tel."' and status=1 and type='leave_msg_sys' order by create_time desc) a limit 1"; 
	$result2 = mysqli_query($conn,$sql2);
	$code="";
	while($row2 = mysqli_fetch_assoc($result2)){
		$code=$row2['code'];
	}
	if($checkcode!=$code){
		echo "103"; exit;
	}
}

$person = isset($_POST['person']) ? $_POST['person'] : '';
$qq = isset($_POST['qq']) ? $_POST['qq'] : '';
$desc = isset($_POST['desc']) ? $_POST['desc'] : '';

$sql = "insert into t_leave_msg (person,from_tel,qq,description,status,create_time,to_tel,type) values ('".$person."','".$tel."','".$qq."','".$desc."',0,now(),'".$to_tel."','".$type."')";


if(mysqli_query($conn,$sql)){
	$sql3 = "update t_checkcode set status=-1 where tel='".$tel."' and type='leave_msg_sys'"; 
	$result3 = mysqli_query($conn,$sql3);	
	echo "000";exit;
}