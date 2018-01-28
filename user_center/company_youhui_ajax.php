<?php
 session_start(); 
?>
<?php require dirname(__FILE__) . '/../include/checkSession.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php

$company_id=empty($_POST['company_id'])|| !is_numeric($_POST['company_id'])||$_POST['company_id']<1 ? '':$_POST['company_id'];
if(empty($company_id)){ echo "优惠活动的信息填写不全，请补充";return;}
$born_day_begin=$_POST["born_day_begin"];
if(empty($born_day_begin)){ echo "<i class='glyphicon glyphicon-info-sign' style='color:red;font-size:20px'></i>&nbsp;请填写优惠活动的开始时间";return;}
$born_day_end=$_POST["born_day_end"];
if(empty($born_day_end)){ echo "请填写优惠活动的结束时间";return;}
$discount_title=$_POST["discount_title"];
if(empty($discount_title)){ echo "请填写优惠活动的标题";return;}
$discount=$_POST["discount"];
if(empty($discount)){ echo "请填写优惠活动的内容";return;}

$stmt=mysqli_stmt_init($conn);
$sql = "update zl_discount set title=?,content=?,build_time=now(),born_day_begin=?,born_day_end=?,status=0 where c_id=? and userid=?";
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'ssssis',$discount_title, $discount,$born_day_begin,$born_day_end,$company_id,$_SESSION['tel']);
	mysqli_stmt_execute($stmt);

	$num = mysqli_stmt_affected_rows($stmt);
	if($num==0){
		echo "未找到该记录,保存失败";exit;
	}else{
		echo "已保存成功";exit;
	}

}else{
	echo "保存失败，请联系客服";exit;
}

?>