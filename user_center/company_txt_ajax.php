<?php
 session_start(); 
?>
<?php require dirname(__FILE__) . '/../include/checkSession.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php

$company_id=empty($_POST['company_id'])|| !is_numeric($_POST['company_id'])||$_POST['company_id']<1 ? '':$_POST['company_id'];
if(empty($company_id)){ return;}
$work_time=$_POST["work_time"];
$address=$_POST["address"];
$description=$_POST["description"];
$tel=$_POST["tel"];
$additional=$_POST["additional"];
$wuliu=empty($_POST['wuliu'])|| !is_numeric($_POST['wuliu'])||$_POST['wuliu']<1 ? '0':'1';
if(!empty($_POST['wuliu_limit'])&&!is_numeric($_POST['wuliu_limit'])){
	echo "起送金额只能输入整数值";exit;
}
$wuliu_limit=empty($_POST['wuliu_limit'])||$_POST['wuliu_limit']<1 ? '0':$_POST['wuliu_limit'];

$weixin_talk=empty($_POST['weixin_talk'])|| !is_numeric($_POST['weixin_talk'])||$_POST['weixin_talk']<1 ? '0':'1';

$stmt=mysqli_stmt_init($conn);

$sql = "update zl_company set  work_time=?,address=?,description=?,tel=?,additional=?,wuliu=?,wuliu_limit=?,weixin_talk=? where id=? and userid=?";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'sssssiiiis',$work_time, $address,$description,$tel,$additional,$wuliu,$wuliu_limit,$weixin_talk,$company_id,$_SESSION['tel']);
	mysqli_stmt_execute($stmt);
	$num = mysqli_stmt_affected_rows($stmt);
	if($num==0){
		echo "保存成功";exit;
	}else{
		echo "已保存成功";exit;
	}
	
}else{
	echo "保存失败，请联系客服";exit;
}

?>