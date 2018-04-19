<?php $locate="marriage";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$sex = empty($_REQUEST['sex'])|| !is_numeric($_REQUEST['sex'])?'':$_REQUEST['sex'];
	$photo = empty($_REQUEST['photo'])|| !is_numeric($_REQUEST['photo'])?'':$_REQUEST['photo'];
	
	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
?>
<script type="text/javascript">
$(document).ready(function(){

	<?php  if(!empty($sex)){?>
		$("[id='b_<?php echo $sex;?>']").addClass("btn-info");
	<?php }?>
	<?php  if(!empty($photo)){?>
		$("[id='a_<?php echo $photo;?>']").addClass("btn-info");
	<?php }?>
	
	$("[id^='b_']").click(function(){
		var id = $(this).attr("id");
		var value =id.substr(2);
		document.getElementById("sex").value= value;
		search();
	});
	$("[id='bclear']").click(function(){
		document.getElementById("sex").value= '';
		search();
	});
	
	$("[id^='a_']").click(function(){
		var id = $(this).attr("id");
		var value =id.substr(2);
		document.getElementById("photo").value= value;
		search();
	});
	$("[id='aclear']").click(function(){
		document.getElementById("photo").value= '';
		search();
	});

	$("#new_marriage").click(function(){
		window.open("/marriageAdd.php");
	});
});

function search(){
		window.location.href="/marriage.php?sex="+document.getElementById("sex").value+"&photo="+document.getElementById("photo").value; 
}
</script>


 <div class="container">
	<div class="col-md-9" >
    
        <?php if(isMobile()){?> 
        <?php require_once dirname(__FILE__) . '/include/search_mobile.php';?>
        <?php } ?> 
        
		<div class="panel panel-default">
			<div class="panel-body">
			
			<table <?php if(isMobile()){ ?> class="table_bottom"<?php } ?> >
			<tr>
				<td style="width:70px;text-align:right;">性别：</td>
				<td>
					<button type="button" id="bclear" class="btn  btn-default btn-sm button_m">全部</button>
					<button type="button" id="b_1" class="btn  btn-default btn-sm button_m">男</button>
					<button type="button" id="b_2" class="btn  btn-default btn-sm button_m">女</button>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;">相片：</td>
				<td>
					<button type="button" id="aclear" class="btn  btn-default btn-sm button_m">全部</button>
					<button type="button" id="a_1" class="btn  btn-default btn-sm button_m">有相片</button>
					<button type="button" id="a_2" class="btn  btn-default btn-sm button_m">无相片</button>
				</td>
			</tr>
			</table>
					<input type="hidden" id="sex" name="sex" value="<?php echo $sex?>"/>
					<input type="hidden" id="photo" name="photo" value="<?php echo $photo?>"/>
			</div>
		</div>
		
		
	<?php 
	$countSql = "select count(*) count from zl_marriage where status!=-1  ";

	if(!empty($sex)){
			$countSql = $countSql . " and sex = ".$sex;
	}
	if(!empty($photo)){
			$countSql = $countSql . " and photo = ".$photo;
	}
	
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>

        <?php 
            if($countRow['count']!="0"){
        ?>
        
		<?php
			$sql = "select id,sex,photo,TIMESTAMPDIFF(YEAR, born_time, CURDATE()) age,education,job,message,modify_time from  (select * from zl_marriage where status!=-1 ";
			
			if(!empty($sex)){
					$sql = $sql . " and sex = ".$sex;
			}
			if(!empty($photo)){
					$sql = $sql . " and photo = ".$photo;
			}
			
			
			$sql = $sql." order by modify_time desc) a limit ".$db_limit_start.",".$db_limit_offset;
			// var_dump($sql);
			$result = mysqli_query($conn,$sql);	
		?>
		<?php require dirname(__FILE__) . '/list_search_common/marriage_list.php';?>
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
				<p>为保证婚恋交友的安全性和严肃性，需要您联系客服来登记您的交友信息。如果您能够将您的个人相片，以及身份证复印件托管在本站，您将会得到重点推荐和更多的机会哦！</p>
				<p><small><a target="_blank" href="/contView.php?type=my&id=6">点击此处了解更多</a></small></p>
				<?php if(!empty($_SESSION['tel'])&&isAdmin($_SESSION['tel'])){?>
                <div class="text-right">
                    <a target="_blank" id="new_marriage" class="btn btn-success ">客服发布</a>
                </div>
                <?php }   ?>
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
				
                “年轻”的朋友们喜欢聚餐、美容、娱乐，
				那么餐饮酒店、服装护肤、<span style="color: #337ab7;"><b>婚礼庆典</b></span>、娱乐休闲类型公司，有没有什么想对他们说的话呢？
				您的公司可以在此购买图片广告位，点击后进入您的信息专栏。该专栏，支持由您自己更改内容哦！！费用：150元/90天
                
            </div>
		</div>
        <?php } ?> 
	</div>
	
</div>
<script>
	$(function () { $("[data-toggle='tooltip2']").tooltip(); });
</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>
