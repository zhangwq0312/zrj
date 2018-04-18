<?php $locate="education";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$leixing = empty($_REQUEST['leixing'])|| !is_numeric($_REQUEST['leixing'])?'':$_REQUEST['leixing'];
	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
?>
<script type="text/javascript">
$(document).ready(function(){
	<?php  if(!empty($leixing)){?>
		$("[id='a_<?php echo $leixing;?>']").addClass("btn-primary");
	<?php }?>
		
	$("[id^='a_']").click(function(){
		var id = $(this).attr("id");
		var value =id.substr(2);
		document.getElementById("leixing").value= value;
		search();
	});
	$("[id='aclear']").click(function(){
		document.getElementById("leixing").value= '';
		search();
	});

	$("#new_education").click(function(){
		window.open("/educationAdd.php");
	});
});

function search(){
		window.location.href="/education.php?leixing="+document.getElementById("leixing").value; 
}
function page(i){
		window.location.href="/education.php?page="+i+"&leixing="+document.getElementById("leixing").value; 
}
</script>


 <div class="container">
 
 <div class="col-md-9" >
        <?php if(isMobile()){?> 
        <?php require_once dirname(__FILE__) . '/include/search_mobile.php';?>
        <?php } ?> 
    
		<div class="panel panel-default">
			<div class="panel-body">
			
			<table>
			<tr>
				<td style="width:70px;text-align:right;vertical-align:top; padding:9px 0px 0px 0px; " >类型：</td>
				<td><button type="button" id="aclear" class="btn  btn-default btn-sm button_m">全部类型</button>
					<?php
					$sql = "select name,value from t_type where  group_name='education' and status =0 order by order_num asc";
					$result = mysqli_query($conn,$sql);	
					while($row = mysqli_fetch_assoc($result)){
					?>				
						<button type="button" id="a_<?php echo $row['value'];?>" class="btn  btn-default btn-sm button_m"><?php echo $row['name'];?></button>
					<?php }?>
				</td>
			</tr>
			</table>
					<input type="hidden" id="leixing" name="leixing" value="<?php echo $leixing?>"/>
			</div>
		</div>
		
		
	<?php 
	$countSql = "select count(*) count from zl_education where status=0  ";
	if(!empty($leixing)){
			$countSql = $countSql . " and leixing = '".$leixing."' ";
	}

	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
			<?php 
                if($countRow['count']!="0"){
            ?>
            
			<?php		
				$sql = "select id, title,leixing,description ,tel,build_time,build_time>now() as isbefore from  (select * from zl_education where status=0 ";
				
				if(!empty($leixing)){
						$sql = $sql . " and leixing = '".$leixing."' ";
				}
				$sql = $sql." order by build_time desc) a limit ".$db_limit_start.",".$db_limit_offset;

				$result = mysqli_query($conn,$sql);	
			?>
			<?php require dirname(__FILE__) . '/list_search_common/education_list.php';?>
			<?php require dirname(__FILE__) . '/include/page.php';?>
            
            <?php 
                }else{
            ?>
            <div class="panel panel-default" >
                <div class="panel-body" >
                    <p style="color:#999">&#12288;&#12288;目前没有相关记录。</p>
                    
                </div> 
            </div> 
            <?php 
                }
            ?>
            
	</div>
	
	<div class="col-md-3">
    
        <?php if(!isMobile()){?> 
		<div class="panel panel-default">
			<div class="panel-heading-blue">提示</div>
			<div class="panel-body">
				<p>&#12288;&#12288;孩子的健康成长，是父母们的共同希望。</p>
                <p>&#12288;&#12288;孩子不输在起跑线上，是父母们应尽的责任。</p>
                <div class="text-right"><a target="_blank" id="new_education" class="btn btn-success">免费发布</a></div>
            </div>
		</div>
        <?php } ?> 
        
        <?php if(!isMobile()){?>         
		<div class="panel panel-default">
			<div class="panel-heading-orange">
				推荐
				<a href="#" class="text-muted pull-right">>>></a>
			</div>
			<div class="panel-body">
				<img src="img/zhaozu_house.png" class="img-responsive center-block"/>
                您希望大家更容易关注到您的才艺培训中心？您的儿童乐园位置比较隐蔽？您愿意成为明星家教？您可以在此处推广，扩大您的知名度。费用：150元/90天
            </div>
		</div>
        <?php } ?> 
	</div>
	
</div>
<?php require dirname(__FILE__) . '/include/footer.php';?>