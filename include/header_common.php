<?php 
	header("Content-Type:text/html;charset=utf-8");
?>
<?php require_once dirname(__FILE__) . '/../common/const.php';?>
<?php require_once dirname(__FILE__) . '/../common/function.php';?>
<?php
 $refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="renderer" content="webkit">
        <meta name="keywords" content="胜溪汇 胜溪湖 孝义房产 孝义微信 孝义培训">
        <meta name="description" content="胜溪汇 胜溪湖 孝义房产 孝义微信 孝义培训">
		<title>胜溪汇</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/zhangwq.css" />
        <style>
            body { padding-top: 50px; }
        </style> 
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
			<link rel="stylesheet" href="../css/zhangwq_ie8.css" />
		<![endif]-->

		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js" ></script>
		<script type="text/javascript" src="../js/jquery.ez-bg-resize.js" ></script>
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
		<script type="text/javascript" src="../js/zhangwq.js" ></script>
	</head>
	
	<body>
    <?php if(empty($locate)){
        if(!empty($_REQUEST['locate'])){
            $locate=$_REQUEST['locate'];
        }else{
            $locate="";
        }
    }?>
<?php if(!isMobile()){?>
		<nav class="nav navbar-inverse navbar-fixed-top"   role="navigation" >
			<div class="container-fluid">	
				<div class="navbar-header" style="margin-right: 60px;">
					<a href="#" class="navbar-brand">
						<img style="height:50px ;margin-top: -13px;" src="img/1.png"  /><!--margin-top: -15px;-->

                    </a>
                    <a href="index.php" class="navbar-brand" style="padding: 13px 8px 13px 0px;">
                        <span class="glyphicon glyphicon-home" style="font-size:14px;color:#D2D2D2;"></span>
                        <span style="font-size:12px;color:#D2D2D2;">首页</span>
                    </a>
                    
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

								<a href="loginout.php?from=<?php echo $locate?>"  class="navbar-brand" style="padding: 13px 8px;">
                                    <span class="glyphicon glyphicon-off" style="font-size:14px;color:#D2D2D2;"></span>
                                    <span style="font-size:12px;color:#D2D2D2;">退出</span>
                                </a>
						<?php } ?>
                   
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="padding:4px 8px">
						<li class="glyphicon glyphicon-th-list" style="font-size:20px;color:#fff;"></li>&nbsp;
                        <span style="color:#aaa">
					<?php 
						if($locate=="house"){echo "住房";}
						if($locate=="employ"){echo "招聘";}
						if($locate=="marriage"){echo "婚恋";}
						if($locate=="tel"){echo "便民";}
                        if($locate=="education"){echo "教育";}
						if($locate=="company"){echo "商家";}
                        if($locate=="coupon"){echo "促销";}
					 ?></span>
					</button>
				</div>
				
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav" style="margin-right: 80px;">
						<li <?php if($locate=="house"){echo " class='active' ";}?> ><a href="house.php">住房</a></li>
						<li <?php if($locate=="education"){echo " class='active' ";}?> ><a href="education.php">教育</a></li>
						<li <?php if($locate=="marriage"){echo " class='active' ";}?> ><a href="marriage.php">婚恋</a></li>	
                        <li <?php if($locate=="employ"){echo " class='active' ";}?> ><a href="employ.php">招聘</a></li>
                        <li <?php if($locate=="coupon"){echo " class='active' ";}?> ><a href="coupon.php">促销</a></li>
						<li <?php if($locate=="tel"){echo " class='active' ";}?> ><a href="tel.php">便民</a></li>
                        <li <?php if($locate=="company"){echo " class='active' ";}?> ><a href="business.php">商家</a></li>
                    </ul>
				   <div class="navbar-form navbar-left">

						<?php if($locate=="education"||$locate=="marriage"||$locate=="house"||$locate=="employ"||$locate=="company"||$locate=="tel"){?>
						<?php 
						$search_msg="";
						if($locate=="house"){
							$search_msg="住房";
						}else if($locate=="employ"){
							$search_msg="招聘";
						}else if($locate=="marriage"){
							$search_msg="婚恋";
						}else if($locate=="tel"){
							$search_msg="便民";
						}else if($locate=="education"){
							$search_msg="教育";
						}else if($locate=="company"){
							$search_msg="商家";
						}else if($locate=="shop"){
							$search_msg="网上超市";
						}
						
						?>
						<div class="form-group" >	
							<div class="input-group">
								<?php $key = empty($_REQUEST['key'])?'':$_REQUEST['key'];?>
								<input id="search_input" name="search_input" type="text" class="form-control" style="width:200px" placeholder="输入<?php echo $search_msg;?>关键词"  value="<?php if(!empty($key)){echo $key;} ?>"/>
								<div class="input-group-btn">
									<button id="search_button" class="btn btn-block"><span class="glyphicon glyphicon-search" style="color:#3d5c99"></span></button>
								</div>
							</div>	
						</div>
						<?php } ?>
                        
					</div>	
				</div>
			</div>
		</nav>
        
                
        <div style="height: 20px;"></div>
<?php } ?>

<?php if(isMobile()){?>
		<nav class="nav navbar-inverse navbar-fixed-top"   role="navigation" >
			<div class="container-fluid">	
					<ul class="nav navbar-nav">
						<?php if(empty($locate)&&!empty($_REQUEST['locate'])){
							$locate=$_REQUEST['locate'];
						}?> 

						<li>
                            <div  class="col-xs-3 text-center"><a href="index.php"><span <?php if($locate==""){echo "class='white'";}else{echo "class='black'";}?>>首页</span></a></div>
                            <div  class="col-xs-3 text-center"><a href="house.php"><span <?php if($locate=="house"){echo "class='white'";}else{echo "class='black'";}?>>住房</span></a></div>
                            <div  class="col-xs-3 text-center"><a href="education.php"><span <?php if($locate=="education"){echo "class='white'";}else{echo "class='black'";}?>>教育</span></a></div>
                            <div  class="col-xs-3 text-center"><a href="marriage.php"><span <?php if($locate=="marriage"){echo "class='white'";}else{echo "class='black'";}?>>婚恋</span></a></div>
                        </li>
						<li>
                            <div  class="col-xs-3 text-center"><a href="employ.php"><span <?php if($locate=="employ"){echo "class='white'";}else{echo "class='black'";}?>>招聘</span></a></div>
                            <div  class="col-xs-3 text-center"><a href="coupon.php"><span <?php if($locate=="coupon"){echo "class='white'";}else{echo "class='black'";}?>>促销</span></a></div>
                            <div  class="col-xs-3 text-center"><a href="tel.php"><span <?php if($locate=="tel"){echo "class='white'";}else{echo "class='black'";}?>>便民</span></a></div>
                            <div  class="col-xs-3 text-center" ><a href="business.php"><span <?php if($locate=="company"){echo "class='white'";}else{echo "class='black'";}?>>商家</span></a></div>

                        </li>

					</ul>

			</div>
		</nav>
        <?php  
            $refer = isset($_REQUEST['refer']) ? $_REQUEST['refer'] : '';
            $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
        ?>
        <?php require_once dirname(__FILE__) . '/top_mobile.php';?>
<?php } ?>


<script>
$(document).ready(function(){
	$("[data-toggle='tooltip']").tooltip(); 
	$("#search_button").click(function(){
		window.location.href="/search.php?locate=<?php echo $locate;?>&key="+$.trim($("#search_input").val());
	});
});
	
</script>
