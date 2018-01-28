<?php session_start();?>
<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
$msg=$_POST['msg'];
$operate=$_POST['operate'];
$stmt=mysqli_stmt_init($conn);
$msgArray = explode('_',$msg); 
$id=$msgArray[1];

if($msgArray[0]!="house"&&$msgArray[0]!="employ"&&$msgArray[0]!="tel"&&$msgArray[0]!="education"){
	echo "error";
	exit;
}

if($operate=="fresh"){
		$sql = "update  zl_".$msgArray[0]." set build_time=now() where id=? and userid=?";
}else if ($operate=="remove"){
		$sql = "update  zl_".$msgArray[0]." set status=-1 where id=? and userid=? and build_time<now()";
}else if ($operate=="remove_force"){
		$sql = "update  zl_".$msgArray[0]." set status=-1 where id=? and userid=?";
}

if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt,'is',$id, $_SESSION['tel']);
	mysqli_stmt_execute($stmt);
	$num = mysqli_stmt_affected_rows($stmt);
	if($num==0){
		if ($operate=="remove"){
			echo "该帖子已订购自动刷新业务。如删除该帖，已订购的刷新费用就打水漂啦！您坚持要删除该贴吗？";exit;
		}
	}else{
		echo "ok";
	}
}
?>
