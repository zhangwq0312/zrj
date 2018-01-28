<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<?php  
$company_id= $_REQUEST['company_id'];
//var_dump($_FILES);exit;
$img_1="";
$img_2="";
$img_3="";
$img_talk="";
$msg="";
foreach($_FILES as $name=>$f){
	if ($f["error"] > 0)  {  
		$error="图片上传失败，请联系客服进行操作。错误码: " . $f["error"] . "<br />";
	}else{   

		$img_index=explode('_',$name); 
		//echo "Upload: " . $f["name"] . "<br />";//获取文件名  
		//echo "Type: " . $f["type"] . "<br />";//获取文件类型  
		//echo "Size: " . ($f["size"] / 1024) . " Kb<br />";//获取文件大小  
		
		if($f["size"]/1024 > 2000){
			if($name=="img_1"){$msg=$msg."图片1上传失败：文件必须小于2M<Br/>";continue;}else
			if($name=="img_2"){$msg=$msg."图片2上传失败：文件必须小于2M<Br/>";continue;}else 
			if($name=="img_3"){$msg=$msg."图片3上传失败：文件必须小于2M<Br/>";continue;}else 
			if($name=="img_talk"){$msg=$msg."图片4上传失败：文件必须小于2M<Br/>";continue;}
		}
		
		$path=parse_url($f["name"]); 
		$prex_end=explode('.',$path['path']); 
		//echo "临时文件名字" . $f["tmp_name"] . "后缀名".$prex_end[1]."<br />";//获取文件临时地址  
		$new_img_name="company_".$company_id."_".$img_index[1].".".$prex_end[1];
		move_uploaded_file($f["tmp_name"],IMG_COMPANY_DIR.$new_img_name);
		
		if($name=="img_1"){$img_1=IMG_COMPANY_WEB.$new_img_name;$msg=$msg."图片1上传成功<Br/>";}else
		if($name=="img_2"){$img_2=IMG_COMPANY_WEB.$new_img_name;$msg=$msg."图片2上传成功<Br/>";}else 
		if($name=="img_3"){$img_3=IMG_COMPANY_WEB.$new_img_name;$msg=$msg."图片3上传成功<Br/>";}else
		if($name=="img_talk"){$img_talk=IMG_COMPANY_WEB.$new_img_name;$msg=$msg."微信聊天二维码上传成功<Br/>";}
	}
}

if(empty($img_1)&&empty($img_2)&&empty($img_3)&&empty($img_talk)){
	?>
		<script>
			bootbox.alert("<?php if($msg==""){echo "请选择你要修改的图片";}else{echo $msg; }?>",function() {window.location.href="/user_center/company.php?id=<?php echo $company_id;?>";});
		</script>
	<?php
	}else{
	$stmt=mysqli_stmt_init($conn);
	$sql = "update zl_company set ";
	if(!empty($img_1)){$sql=$sql." img_1='".$img_1."',";}
	if(!empty($img_2)){$sql=$sql." img_2='".$img_2."',";}
	if(!empty($img_3)){$sql=$sql." img_3='".$img_3."',";}
	if(!empty($img_talk)){$sql=$sql." img_talk='".$img_talk."',"." weixin_talk=1,";}
	$sql=rtrim($sql, ",");
	$sql=$sql ." where id=".$company_id." and userid='".$_SESSION['tel']."'";
	mysqli_query($conn,$sql);
	$msg=$msg."保存成功<Br/>";
	?>
	<script>
			bootbox.alert("<?php echo $msg; ?>",function() {window.location.href="/user_center/company.php?id=<?php echo $company_id;?>";});
	</script>
	<?php
}
?>
