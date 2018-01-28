<?php $locate="education";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php

$title=$_POST['title'];
$leixing=$_POST['leixing'];
if(!is_numeric($leixing)){
	echo "格式有误";exit;
}

$tel=$_POST['tel'];
$description=$_POST['description'];


if(empty($title)
	||empty($leixing)
	||empty($tel)){
		echo "您输入的数据有误，请重新输入";
		return;
	}

$count = "select count(*) from zl_education where tel='".$tel
		."' and leixing='".$leixing."' and status = 0";

$countResult = mysqli_query($conn,$count);
$countRow = mysqli_fetch_row($countResult);

if($countRow[0]>0){

	?>
	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					该手机号已经发过教育信息，您可以在搜索框输入“手机号”查看。为避免信息重复，目前一个手机号只能拥有一条教育信息。您可以删除旧的信息，再重新发布。
				</div>
			</div>
	</div>
	<?php	
}else{
	$sql = "insert into zl_education (tel,leixing,title,description,create_time,modify_time,build_time,status,userid)
		values (?,?,?,?,now(),now(),now(),-2,?)";
	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, 'sssss', $tel, $leixing, $title,$description,$_SESSION['tel']);
        mysqli_stmt_execute($stmt);
	}
	?>

	 <div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布结果
				</div>
				<div class="panel-body">
					您的信息已提交，教育信息需要系统审核，<span style="color:red">正常情况下会在24小时内审核。审核通过后，方能显示。如需提前审核，请拨打本站电话</span>
					<br/>为保证您的发帖在列表中排名靠前，请定期登录系统<b>刷新</b>。
				</div>
			</div>
	</div>
<?php
}
?>
<?php require dirname(__FILE__) . '/include/footer.php';?>