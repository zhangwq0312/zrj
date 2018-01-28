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
	$id = empty($_REQUEST['id'])?'':$_REQUEST['id'];
	$content = empty($_REQUEST['content'])?'':$_REQUEST['content'];
	$title = empty($_REQUEST['title'])?'':$_REQUEST['title'];
	if(!(empty($content)&&empty($title))){
		$sql = "update zl_cont set title='".$title."',content='".$content."',build_time=now() where  id =".$id." and type='".$type."'";
		$result = mysqli_query($conn,$sql) or die ('查询数据出错');
        ?>
        <script>
            window.location.href="/index.php"
        </script>
        <?php
        exit;
	}

	$sql = "select id, title,content,build_time from zl_cont where  id =".$id." and type='".$type."'";
	//echo $sql;
	$result = mysqli_query($conn,$sql);	
	$row = mysqli_fetch_assoc($result);
?>
 <div class="container">
	<div class="col-md-12" >
				<ol class="breadcrumb" style="background-color:transparent">
					<li class="active">
						<?php 
							if($type=="my"){
								echo "通知";
							}
							if($type=="xinwen"){
								echo "新闻";
							}
						?>
					</li>
					<li class="active">修改</li>
				</ol>
				
			<div class="panel panel-default" style="border:0px;padding:0px">
				<div class="panel-body" style="padding:5px 15px;" >
<!-- 编辑器开始-->
<form role="form" id="defaultForm" <?php if(!isMobile()){?>class="form-horizontal"<?php }?>  action="/contEdit.php" method="POST">
	<div>
		<input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title'];?>"/>
	</div>
	<div>
		<script id="editor" type="text/plain" style="height:380px;"><?php echo $row['content'];?></script>
	</div>
	<div id="btns">
		<div class="text-center">
			<button id="save"  class="btn btn-success btn-lg">提交内容</button>
		</div>
		<input type="hidden" id="type" name="type" value="<?php echo $type;?>"/>
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>"/>
		<input type="hidden" id="content" name="content" />
	</div>
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
    function setContent(isAppendTo) {					
        UE.getEditor('editor').setContent('<?php echo $row['content'];?>', isAppendTo);
    }
	$(document).ready(function(){
		$("[id='save']").click(function(){
			getContent();
			var aa=document.getElementById("content").value;
			//alert($("#content").val());
			$("#defaultForm").submit();
		});
	});

	ue.ready(function(){
		setContent();
	});
	
</script>

<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>