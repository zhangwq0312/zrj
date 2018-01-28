<?php 
	header("Content-Type:text/html;charset=utf-8");
?>
<?php require dirname(__FILE__) . '/../common/const.php';?>
<?php require dirname(__FILE__) . '/../common/function.php';?>
<?php
$refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
?>
<?php
 session_start(); 
?>

<?php require dirname(__FILE__) . '/../include/checkSession.php';?>
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
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
		<!--<link rel="stylesheet" href="../css/fileinput.min.css" />-->
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
		<!--<script type="text/javascript" src="../js/fileinput.js" ></script>-->
		<!--<script type="text/javascript" src="../js/locales/zh.js" ></script>-->
		<script type="text/javascript" src="../js/bootstrap.min.js" ></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>

		<!-- Latest compiled and minified Locales -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>


	</head>
	
	<body> 
		<nav class="nav navbar-inverse navbar-static-top"  role="navigation" >
		<div class="container-fluid">
					<div class="navbar-header" style="margin-right: 60px;">
                    <?php if(!isMobile()){?>
						<a href="#" class="navbar-brand">
							<img style="height:50px ;margin-top: -13px;" src="/img/1.png"  />
						</a>
                    <?php } ?>   
                        <a href="../index.php" class="navbar-brand" <?php if(!isMobile()){?>style="padding: 13px 8px 13px 0px;"<?php }else{ ?> style="padding: 13px 8px 13px 8px;"<?php } ?>  >
                            <span class="glyphicon glyphicon-home" style="font-size:14px;color:#D2D2D2;"></span>
                            <span style="font-size:12px;color:#D2D2D2;">首页</span>
                        </a>
                        
                        <a  href="index.php"  class="navbar-brand" style="padding: 13px 8px;">
                            <span class="glyphicon glyphicon-cog" style="font-size:14px;color:#D2D2D2;"></span>
                            <span style="font-size:16px;color:#D2D2D2;">个人中心</span>
                        </a>	
                        
                        <a href="../loginout.php?from="  class="navbar-brand" style="padding: 13px 8px;">
                            <span class="glyphicon glyphicon-off" style="font-size:14px;color:#D2D2D2;"></span>
                            <span style="font-size:12px;color:#D2D2D2;">退出</span>
                        </a>
                        

					</div>
                    
					<div class="collapse navbar-collapse">   
                    
                       <ul class="nav navbar-nav navbar-right" >
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" style="color:#D2D2D2;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">转到 <span class="caret"></span></a>
                              <ul class="dropdown-menu" >
                                <li><a href="/house.php">住房</a></li>
                                <li><a href="/education.php" >教育</a></li>
                                <li><a href="/marriage.php">婚恋</a></li>	
                                <li><a href="/employ.php">招聘</a></li>
                                <li><a href="/coupon.php">促销</a></li>
                                <li><a href="/tel.php">便民</a></li>
                                <li><a href="/business.php">商家</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/contact.php">联系本站</a></li>
                              </ul>
                            </li>
                        </ul>
                    </div>
   	  	</div>
		</nav>
        
        <div style="height: 20px;"></div>