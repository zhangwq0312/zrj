<?php 
	header("Content-Type:text/html;charset=utf-8");
?>
<?php require_once dirname(__FILE__) . '/common/const.php';?>
<?php require_once dirname(__FILE__) . '/common/function.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="renderer" content="webkit">
		<title>胜溪汇</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/zhangwq.css" />
		<!--[if lt IE 9]>
			<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
			<link rel="stylesheet" href="../css/zhangwq_ie8.css" />
		<![endif]-->
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js" ></script>
		<!--[if lte IE 9]>  
			 <script src="../js/jquery.placeholder.min.js"></script>  
			 <script>  
				$(function(){  
					$('input[placeholder]').placeholder();  
				});  
			 </script>  
			 <style>
				.placeholder {  
					color: #999;  
				}  
			 </style>
		<![endif]--> 
		<script type="text/javascript" src="../js/bootstrap.min.js" ></script>
<style>
    body{ background-color:#fff}
    .h_logo {
        width: 200px;
        height: 78px;
        position: relative;
        margin-left:120px;
    }
    .logo_img {
            position: absolute;
            top: 55%;
            left: 40%;
            margin-top: -36px; /* 高度的一半 */
            margin-left: -100px; /* 宽度的一半 */
    }
    .banner_color{
        padding-top:25px;
        padding-bottom:40px;
        background-image: linear-gradient(-180deg, #0e81a5 0%, #77aacc 100%);
    }
</style>
	</head>
<body> 
<?php
session_start();
if(!empty($_SESSION['tel'])){
    //unset($_SESSION['tel']);
}
$refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
$msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
?>

<?php if(!isMobile()){ ?>
<div>
	<div class="h_logo" >
    
		<a href="/">
			<img class="logo_img" src="img/login_top.png">
		</a>

	</div>
	<div class="text-right" style="font-size:12px;color:red">注意：本站尚未运营。</div>
</div>
<?php } ?>
