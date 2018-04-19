<?php 
    session_start();
?>
<?php
	if(empty($_SESSION['tel'])){
		header("location: /login.php?refer=".$_SERVER['REQUEST_URI']);exit;
	}else{
		header("test: zhangwq");
	}
?>
<?php require dirname(__FILE__) . '/header_common.php';?>
