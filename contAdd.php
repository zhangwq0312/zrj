<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php if(empty($_SESSION['tel'])||isNotAdmin($_SESSION['tel'])){ return;}   ?>
<?php require dirname(__FILE__) . '/include/db.php';?>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="./utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="./utf8-php/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="./utf8-php/lang/zh-cn/zh-cn.js"></script>
<?php 
	$type = empty($_REQUEST['type'])?'':$_REQUEST['type'];
?>				
 <div class="container">
	<div class="col-md-12" >
					<ol class="breadcrumb" style="background-color:transparent">
					
					<li class="active">
						<?php 
							if($type=="my"){
								echo "通知";
							}else if($type=="xinwen"){
								echo "新闻";
							}else if($type=="youhui"){
								echo "商家优惠";
							}else{
								exit;
							}
						?>
					</li>
					<li class="active">新增</li>
				</ol>
				
			<div class="panel panel-default" style="border:0px;padding:0px">
				<div class="panel-body" style="padding:5px 15px;" >
						<!-- 编辑器开始-->
					<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  action="/contAddSuccess.php" method="POST">
						<div>
							<input type="text" class="form-control" id="title" name="title" />
						</div>
						<div>
							<script id="editor" type="text/plain" style="width:1000px;height:380px;"></script>
						</div>
						<div id="btns">
							<div class="text-center">
								<button id="save"  class="btn btn-success btn-lg">新增</button>
							</div>
							<input type="hidden" id="type" name="type" value="<?php echo $type;?>"/>
							<input type="hidden" id="content" name="content" />
						</div>	
						<!-- 编辑器结束-->
					</form>	
				</div>
			</div>
	</div>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    function getContent() {
        var content = UE.getEditor('editor').getContent();
		document.getElementById("content").value= content;
    }

	$(document).ready(function(){
		$("[id='save']").click(function(){
			getContent();
			var aa=document.getElementById("content").value;
			//alert($("#content").val());
			$("#defaultForm").submit();
		});
	});

</script>

<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>