<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php $menu_active="sysMsg";?>
<?php $type= empty($_REQUEST['type']) ? 'add':$_REQUEST['type'];?>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;" >
				<i class="glyphicon glyphicon-fire"></i>&nbsp;消息助手
			</div>
			<div class="panel-body" >
				该功能尚未开通，预计在一个月后开通。
			</div>
		</div>
	</div>
			
</div> 
	
<?php require dirname(__FILE__) . '/../include/footer.php';?>










