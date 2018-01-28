<?php $locate="employ";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php

$title=$_POST['title'];
$leixing=$_POST['leixing'];
if(!is_numeric($leixing)){
	echo "格式有误";exit;
}
$sex=$_POST['sex'];
if(!is_numeric($sex)){
	echo "格式有误";exit;
}
$yuexin=$_POST['yuexin'];
$tel=$_POST['tel'];
$description=$_POST['description'];


if(empty($title)
	||empty($leixing)
	||empty($sex)
	||empty($yuexin)
	||empty($tel)){
		echo "您输入的数据有误，请重新输入";
		return;
	}
	
$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select count(*) count from zl_employ where tel=? and leixing=? and title = ?")){
	mysqli_stmt_bind_param($stmt,"sss",$tel,$leixing,$title);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$count);
	mysqli_stmt_fetch($stmt);

	if($count>0){

		?>
		 <div class="container">
				<div class="panel panel-default">
					<div class="panel-heading">
						发布结果
					</div>
					<div class="panel-body">
						您已经发布过相同标题、类型的职位，请使用手机号登录系统查看。
					</div>
				</div>
		</div>
		<?php	
	}else{
		$sql = "insert into zl_employ (tel,leixing,title,sex,yuexin,description,create_time,modify_time,build_time,status,userid)
			values (?,?,?,?,?,?,now(),now(),now(),0,?)";

		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, 'sssssss', $tel, $leixing, $title,$sex,$yuexin,$description,$_SESSION['tel']);
			mysqli_stmt_execute($stmt);
		}
		
		?>

		 <div class="container">
				<div class="panel panel-default">
					<div class="panel-heading">
						发布结果
					</div>
					<div class="panel-body">
						您的信息已成功提交，请前往工作栏目查看。为保证您的发帖在列表中排名靠前，请定期登录系统<b>刷新</b>。
					</div>
				</div>
		</div>
	<?php
	}
}
?>
<?php require dirname(__FILE__) . '/include/footer.php';?>