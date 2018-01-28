<?php $locate="company";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$leixing = empty($_REQUEST['leixing'])|| !is_numeric($_REQUEST['leixing'])?'':$_REQUEST['leixing'];
	$wuliu = empty($_REQUEST['wuliu'])|| !is_numeric($_REQUEST['wuliu'])?'':$_REQUEST['wuliu'];
	$weixin_talk = empty($_REQUEST['weixin_talk'])|| !is_numeric($_REQUEST['weixin_talk'])?'':$_REQUEST['weixin_talk'];

	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
	
?>

 <div class="container">
	<div class="col-md-9" >
    
        <?php if(isMobile()){?> 
        <?php require_once dirname(__FILE__) . '/include/search_mobile.php';?>
        <?php } ?> 
        
		<div class="panel panel-default">
			<div class="panel-body">
			
			<table <?php if(isMobile()){ ?> class="table_bottom"<?php } ?> >
			<tr>
				<td style="width:70px;text-align:right;vertical-align:top; padding:9px 0px 0px 0px; " >类型：</td>
				<td><button type="button" id="aclear" class="btn  btn-default btn-sm button_m">全部类型</button>
					<?php
					$sql = "select name,value from t_type where  group_name='company' and status =0  order by order_num asc";
					$result = mysqli_query($conn,$sql);	
					while($row = mysqli_fetch_assoc($result)){
					?>				
						<button type="button" id="a_<?php echo $row['value'];?>" class="btn  btn-default btn-sm button_m"><?php echo $row['name'];?></button>
					<?php }?>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;">特色：</td>
				<td>
						<button type="button" id="bclear" class="btn  btn-default btn-sm button_m">不限</button>
						<button type="button" id="b_1" class="btn  btn-default btn-sm button_m">上门送货</button>
						<button type="button" id="c_1" class="btn  btn-default btn-sm button_m">微信聊天</button>
						<small><span style="color:#26c6da">支持多选</span></small>
				</td>
			</tr>
			</table>
					<input type="hidden" id="leixing" name="leixing" value="<?php echo $leixing?>"/>
					<input type="hidden" id="wuliu" name="wuliu" value="<?php echo $wuliu?>"/>
					<input type="hidden" id="weixin_talk" name="weixin_talk" value="<?php echo $weixin_talk?>"/>
			</div>
		</div>
		
		
	<?php 
	$countSql = "select count(*) count from zl_company where status=0 and build_time>now() ";
	if(!empty($leixing)){
			$countSql = $countSql . " and leixing = '".$leixing."' ";
	}
	if(!empty($wuliu)){
			$countSql = $countSql . " and wuliu = ".$wuliu."";
	}
	if(!empty($weixin_talk)){
			$countSql = $countSql . " and weixin_talk = ".$weixin_talk."";
	}
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
			<?php 
                if($countRow['count']!="0"){
            ?>

			
			<?php		
				$sql = "select id,main_img, name,leixing,wuliu,description ,tel,modify_time,img_talk,weixin_talk from  (select * from zl_company where status=0 and build_time>now() ";
				
				if(!empty($leixing)){
						$sql = $sql . " and leixing = '".$leixing."' ";
				}
				if(!empty($wuliu)){
						$sql = $sql . " and wuliu = ".$wuliu." ";
				}
				if(!empty($weixin_talk)){
						$sql = $sql . " and weixin_talk = ".$weixin_talk." ";
				}
				$sql = $sql."  and (main_img is not null and main_img!='') ";
				$sql = $sql." order by create_time asc) a limit ".$db_limit_start.",".$db_limit_offset;
				$result = mysqli_query($conn,$sql);	
			?>
						<div class="row">
			<?php
				while($row = mysqli_fetch_assoc($result)){
			?>
				<div class="col-md-4" >
					<div class="thumbnail" style="background-color:#fff">
						<a href="company.php?id=<?php echo $row["id"];?>" target="_blank">
							<img src="<?php echo $row["main_img"];?>" class="img-rounded" style="height:100%;width:100%;">
						</a>
						<div class="caption">
							<p><?php echo $row["name"];?></p>
							<p>
							<?php if(!empty($row['tel'])){ ?>
								<i  class="glyphicon glyphicon-phone"  style="color:#999"></i>&nbsp;
							<?php } ?>
							<span class="tel"><?php echo $row["tel"];?></span>&#12288;
							<?php if(!empty($row["img_talk"])&&$row["weixin_talk"]==1){ ?>
								<img  src="img/weixin.png"/>
							<?php } ?>
							</p>
							
						</div>
					 </div>
				</div>
			<?php
				}	
			?>	
			</div>
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
				<p>你希望推广您的商家？</p> 
				<p>您希望宣传优惠活动？</p>
				<p>您希望获得来自顾客的评价？</p>
				<p>请您将手机号码、经营类型、商家名称、店面照提供给客服，即可<b>自行管理您的商家信息</b>。</p>
				<p><small><a target="_blank" href="/contView.php?type=my&id=6">点击此处了解更多</a></small></p>
				<?php if(!empty($_SESSION['tel'])&&isAdmin($_SESSION['tel'])){?><a target="_blank" id="new_business" class="btn btn-success btn-lg">客服发布</a>
				<?php }else{ ?>
					<a target="_blank" class="btn btn-success " href="/contact.php?leixing=1">我要申请商家管理平台</a>
				<?php } ?>
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
                您是新开的店铺么？或者您想做胜溪湖畔的明星企业？您可以在此处扩大您的知名度。费用：300元/90天
            </div>
		</div>
        <?php } ?> 
        
	</div>
	
</div>
<?php require dirname(__FILE__) . '/include/footer.php';?>
<script type="text/javascript">
$(document).ready(function(){
	<?php  if(!empty($leixing)){?>
		$("[id='a_<?php echo $leixing;?>']").addClass("btn-primary");
	<?php }?>
	<?php  if(!empty($wuliu)){?>
		$("[id='b_1']").addClass("btn-primary");
	<?php }?>
	<?php  if(!empty($weixin_talk)){?>
		$("[id='c_1']").addClass("btn-primary");
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
	$("[id^='b_1']").click(function(){
		document.getElementById("wuliu").value= 1;
		search();
	});
	$("[id^='c_1']").click(function(){
		document.getElementById("weixin_talk").value= 1;
		search();
	});
	$("[id='bclear']").click(function(){
		document.getElementById("wuliu").value= '';
		document.getElementById("weixin_talk").value= '';
		search();
	});
	$("#new_business").click(function(){
		window.open("/businessAdd.php");
	});
});

function search(){
		window.location.href="/business.php?leixing="+document.getElementById("leixing").value+"&wuliu="+document.getElementById("wuliu").value+"&weixin_talk="+document.getElementById("weixin_talk").value; 
}
function page(i){
		window.location.href="/business.php?page="+i+"&leixing="+document.getElementById("leixing").value+"&wuliu="+document.getElementById("wuliu").value+"&weixin_talk="+document.getElementById("weixin_talk").value; 
}
</script>