<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php if(empty($_SESSION['tel'])||isNotAdmin($_SESSION['tel'])){ return;}   ?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php	
	$type = empty($_REQUEST['type'])?'':$_REQUEST['type'];
	$content = empty($_REQUEST['content'])?'':$_REQUEST['content'];
	$title = empty($_REQUEST['title'])?'':$_REQUEST['title'];

	$sql = "insert into  zl_cont (type,title,content,build_time) values ('".$type."','".$title."','".$content."',now())";
	//echo $sql;
	$result = mysqli_query($conn,$sql) or die ('查询数据出错');
?>
 <div class="container-fluid">
	<div class="col-md-12" >
			<div class="panel panel-default" style="border:0px;padding:0px">
				<div class="panel-heading">
					<?php 
						if($type=="my"){
							echo "当日早报->本站相关：";
						}
						if($type=="xinwen"){
							echo "当日早报->新闻：";
						}
						if($type=="youhui"){
							echo "当日早报->商家优惠：";
						}
					?>
				</div>
				<div class="panel-body" style="padding:5px 15px;" >
					<?php if($result){ ?>
						您已经成功添加该信息，请回到首页检查。
					<?php } ?>
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