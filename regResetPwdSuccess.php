<?php 
	header("Content-Type:text/html;charset=utf-8");
?>
<?php require dirname(__FILE__) . '/common/const.php';?>
<?php require dirname(__FILE__) . '/common/function.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<title></title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<script type="text/javascript" src="../js/jquery-2.1.4.min.js" ></script>
		<script type="text/javascript" src="../js/bootstrap.min.js" ></script>
<style>
.zhdl {
    padding: 27px 0 24px;
    text-align: center;
    font-size: 24px;
    color: #666;
}
.login-text {
    width: 100%;
    font-size: 18px;
    line-height: 18px;
    height: 40px;
    padding: 10px;
    border: 1px solid #ddd;
}

.bgc{
	
}
.n_a{
    padding: 0 15px ;
    color: #999;
    font-size: 14px;
}


	</style>

	</head>
<body> 
<?php
$refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
?>
<div class="container">  
	<div>
		<a href="/">
			<img  src="img/1.png">
		</a>
	</div>
	<div class="bgc" style="height:22px">
	&nbsp;
	</div>
	<div class="col-md-2 bgc" >
	&nbsp;
	</div>
	
	<div class="col-md-8" style="border: 1px solid #ddd; padding-bottom:150px;">
		<div class="zhdl"><?php if($type=="reg"){ ?>注册成功<?php }else{ ?>重置密码成功<?php }?>，正在跳转<?php if(!empty($refer)){echo "至您最近浏览过的内容，请稍候";}?>...</div>	
	</div>
	<div class="col-md-2 bgc" >
	&nbsp;
	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){window.location="<?php if(!empty($refer)){echo $refer;}else{echo "/index.php";} ?>";},2000);
});
</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>






















