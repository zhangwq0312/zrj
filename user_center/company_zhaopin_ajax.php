<?php
 session_start(); 
?>
<?php require dirname(__FILE__) . '/../include/checkSession.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
$company_id=empty($_POST['company_id'])|| !is_numeric($_POST['company_id'])||$_POST['company_id']<1 ? '':$_POST['company_id'];
if(empty($company_id)){ echo "招聘活动的信息填写不全，请补充";return;}
$title=$_POST['title'];
$leixing=$_POST['leixing'];
if(!is_numeric($leixing)){
	echo "格式有误，请检查";exit;
}
$sex=$_POST['sex'];
if(!is_numeric($sex)){
	echo "格式有误，请检查";exit;
}
$yuexin=$_POST['yuexin'];
$tel=$_POST['tel'];

$description=$_POST['description'];
if(empty($leixing)){echo "请输入招聘信息的类型";return;}
if(empty($tel)){echo "请输入招聘负责人电话";return;}
if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)&&!preg_match("/^([0-9]{3,4}-)?[0-9]{7,8}$/",$tel)){  
  echo "手机号有误，请检查"; exit; 
}  
if(empty($title)){echo "请输入招聘信息的标题";return;}
if(empty($yuexin)){echo "请选择月薪";return;}
if(empty($sex)){echo "请选择性别";return;}

$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select count(*) count from zl_employ where tel=? and leixing=? and title = ?")){
	mysqli_stmt_bind_param($stmt,"sss",$tel,$leixing,$title);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$count);
	mysqli_stmt_fetch($stmt);

	if($count>0){
		echo "您已经发布过相同标题、类型的职位，请修改标题或删除之前同名的发帖。";return;
	}else{
		$sql = "insert into zl_employ (tel,leixing,title,sex,yuexin,description,create_time,modify_time,status,userid,c_id)
			values (?,?,?,?,?,?,now(),now(),0,?,?)";

		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, 'sssssssi', $tel, $leixing, $title,$sex,$yuexin,$description,$_SESSION['tel'],$company_id);
			mysqli_stmt_execute($stmt);
		}
		echo "招聘信息已成功发布";
	}
}
?>