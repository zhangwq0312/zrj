<?php header("Content-Type:text/html;charset=utf-8");?>
<?php 
    $refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
?>

<?php require dirname(__FILE__) . '/../common/const.php';?>
<?php require dirname(__FILE__) . '/../common/function.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
 session_start(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="renderer" content="webkit">
<?php
	$id= empty($_REQUEST['id'])|| !is_numeric($_REQUEST['id'])||$_REQUEST['id']<1 ? '1':$_REQUEST['id'];
	$sql = "select * from zl_company where  id=".$id." and status !=-1 ";
	$result = mysqli_query($conn,$sql);	
	$row = mysqli_fetch_assoc($result);
?>

		<title>胜溪汇_<?php echo $row["name"]?></title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/zhangwq.css" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
	</head>
	
	<body>
		<nav class="nav navbar-inverse navbar-static-top"  role="navigation">
		<div class="container-fluid">
					<a href="#" class="navbar-brand">
						<img style="height:50px ;margin-top: -13px;" src="img/1.png"  /><!--margin-top: -15px;-->

                    </a>
                    <a href="index.php" class="navbar-brand" style="padding: 13px 8px 13px 0px;">
                        <span class="glyphicon glyphicon-home" style="font-size:14px;color:#D2D2D2;"></span>
                        <span style="font-size:12px;color:#D2D2D2;">首页</span>
                    </a>
                    
					<div class="navbar-header" style="margin-right: 60px;">
                            <?php if(empty($_SESSION['tel'])){ ?>
							<?php if(!empty($_REQUEST['refer'])){?>
								<a href="login.php?refer=<?php echo $_REQUEST['refer']?>" class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-user" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">登录</span>
                                </a>
							<?php }else{?>
								<a href="login.php?refer=<?php echo $_SERVER['REQUEST_URI'];?>" class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-user" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">登录</span>
								</a>
							<?php } ?>
                            

							<?php if(!empty($refer)){?>
								<a href="register.php?refer=<?php echo $refer?>" class="navbar-brand" class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-registration-mark" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">注册</span>
                                </a>
							<?php }else{?>
								<a href="register.php?refer=<?php echo $_SERVER['REQUEST_URI'];?>"   class="navbar-brand"  style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-registration-mark" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">注册</span>
                                </a>
							<?php } ?>
                            
						<?php }else{ ?>
								<a  href="/user_center/index.php" title="进入个人中心"  class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-cog" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">个人中心</span>
                                </a>						

								<a href="loginout.php?refer=<?php echo $_SERVER['REQUEST_URI'];?>"  class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-off" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">退出</span>
                                </a>
						<?php } ?>
                        
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li ><a href="#"><i class="glyphicon glyphicon-th-large"></i>&nbsp;<?php echo $row["name"]?></a></li>
						</ul>
                        
                        <ul class="nav navbar-nav navbar-right" >
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" style="color:#D2D2D2;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">转到 <span class="caret"></span></a>
                              <ul class="dropdown-menu" >
                                <li><a href="/education.php" >教育</a></li>
                                <li><a href="/marriage.php">婚恋</a></li>	
                                <li><a href="/house.php">住房</a></li>
                                <li><a href="/employ.php">招聘</a></li>
                                <li><a href="/coupon.php">促销</a></li>
                                <li><a href="/tel.php">便民</a></li>
                                <li><a href="/business.php">商家</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/contact.php">联系本站</a></li>
                              </ul>
                            </li>
                        </ul>

							<?php if(isMobile()){ ?>
								<a href="#" class="top_right" onclick="javascript :history.back(-1);" ><i class="glyphicon glyphicon-circle-arrow-left"></i>&nbsp;返回</a>
							<?php }?>	
							&#12288;
							

	   		   	  </div>
   	  	</div>
		</nav>
		<div style="height: 20px;"></div>
