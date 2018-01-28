<?php 
	header("Content-Type:text/html;charset=utf-8");
?>
<?php require dirname(__FILE__) . '/../common/const.php';?>
<?php require dirname(__FILE__) . '/../common/function.php';?>
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

<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
	$coupon_id= empty($_REQUEST['coupon_id'])|| !is_numeric($_REQUEST['coupon_id'])||$_REQUEST['coupon_id']<1 ? '':$_REQUEST['coupon_id'];
	if(empty($coupon_id)){ return;}
	$menu_active="coupon_".$coupon_id;
?>
<style>
.table>thead>tr>td {
    text-align:center;
}
.table>tbody>tr>td {
    padding: 5px 15px 5px 15px;
    line-height: 1.5;
    vertical-align: top;
    border-bottom: 1px solid #ddd;
    border-top: 0px;
    text-align:center;
    font-size:15px;
    WORD-WRAP: break-word;
}
.table{table-layout:fixed;}
</style>
<div class="container">    

	<div class="col-md-12">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;">
				<i class="glyphicon glyphicon-volume-up"></i>&nbsp;已经使用的券
			</div>
			<div class="panel-body" >
						<?php		
							$sql = "select * from  z_coupon_user where  status=-1 and gid=".$coupon_id." and gid in ( select id from z_coupon where userid=".$_SESSION['tel'].")";
							$sql = $sql." order by userid desc";
							$result = mysqli_query($conn,$sql);	
						?>
						<?php 
							$rowcount=mysqli_num_rows($result);
							if($rowcount>0){
						?>
						
				<table class="table table-bordered table-hover">
						<thead><tr>
                            <td class="success">手机号</td>
							<td class="success">验证码</td>
                            <td class="success">状态</td>
							<td class="success">验证时间</td>
                            </tr></thead>
						<?php
						while($row = mysqli_fetch_assoc($result)){
							?>

												<tr>
													<td>
														<?php echo $row['userid']; ?>
													</td>
													<td>
														<?php echo $row['coupon_code']; ?>
													</td>
													<td style="">
                                                        已用
													</td>
													<td>
														<?php echo date('Y-m-d H:i:s', strtotime($row['used_time'])); ?>
													</td>                       
													</tr>
						<?php }?>
				</table>
				<?php }?>

			</div>
		</div>
	</div>
			
</div> 
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















