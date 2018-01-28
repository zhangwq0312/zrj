<?php $locate="cont";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php	
	$type = empty($_REQUEST['type'])?'':$_REQUEST['type'];
	$id = empty($_REQUEST['id'])?'':$_REQUEST['id'];

	$sql = "select id, title,content,build_time from zl_cont where  id =".$id." and type='".$type."'";
	//echo $sql;
	$result = mysqli_query($conn,$sql);	
	$row = mysqli_fetch_assoc($result);
?>
 <div class="container">
	<div class="col-md-12" >
				
				<ol class="breadcrumb" style="margin-bottom:0px;color:#999;font-size:15px">
					<?php 
						if($type=="my"){
							echo "<li><a href='/'>资讯</a></li><li><a href='contList.php?type=my'>通知</a></li><li>".$row['title']."</li>";
						}
						if($type=="xinwen"){
							echo "<li><a href='/'>资讯</a></li><li><a href='contList.php?type=xinwen'>孝义新闻</a></li><li>".$row['title']."</li>";
						}
					?>
				</ol>

				
			<div class="panel panel-default" style="border:0px;padding:0px">
				<div class="panel-heading text-center" style="background-color:#fff">
					<span style="font-size:24px;"><?php echo $row['title'] ;?></span>
				</div>
				<div class="panel-body" style="padding:5px 15px;" >
					<div><?php echo $row['content'] ;?></div><br/>
					<?php if(!isMobile()){ ?>
						<div class="text-center"><input class="btn btn-success  btn-lg" type="button" value="&nbsp关&nbsp&nbsp闭&nbsp" onclick="closeWindows();" /></div>
					<?php } else { ?>
						<div class="text-center"><input class="btn btn-success  btn-lg" type="button" value="&nbsp返&nbsp&nbsp回&nbsp" onclick="javascript :history.back(-1);" /></div>
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
			alert($("#content").val());
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