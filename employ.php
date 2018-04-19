<?php $locate="employ";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$leixing = empty($_REQUEST['leixing'])||!is_numeric($_REQUEST['leixing'])?'':$_REQUEST['leixing'];
	$sex = empty($_REQUEST['sex'])||!is_numeric($_REQUEST['sex'])?'':$_REQUEST['sex'];
	$yuexin = empty($_REQUEST['yuexin'])?'':$_REQUEST['yuexin'];

	$yuexincheck= str_replace("_","",$yuexin);
	
	if(!is_numeric($yuexincheck)&&$yuexincheck!=""){
		echo "输入格式有误";
		exit;
	}
	
	$db_limit_offset = 12;
	$db_limit_start = $db_limit_offset * ($page -1 );
?>
<script type="text/javascript">
$(document).ready(function(){
	<?php  if(!empty($leixing)){?>
		$("[id='a_<?php echo $leixing;?>']").addClass("btn-info");
	<?php }?>
	<?php  if(!empty($sex)){?>
		$("[id='b_<?php echo $sex;?>']").addClass("btn-info");
	<?php }?>
	<?php  if(!empty($yuexin)){?>
		$("[id='c_<?php echo $yuexin;?>']").addClass("btn-info");
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
	
	$("[id^='c_']").click(function(){
		var id = $(this).attr("id");
		var value =id.substr(2);
		document.getElementById("yuexin").value= value;
		search();
	});
	$("[id='cclear']").click(function(){
		document.getElementById("yuexin").value= '';
		search();
	});

	$("#new_employ").click(function(){
		window.open("/employAdd.php");
	});
});

function search(){
		window.location.href="/employ.php?leixing="+document.getElementById("leixing").value+"&sex="+document.getElementById("sex").value+"&yuexin="+document.getElementById("yuexin").value; 
}
</script>


 <div class="container">
	<div class="col-md-9 " >
    
        <?php if(isMobile()){?> 
        <?php require_once dirname(__FILE__) . '/include/search_mobile.php';?>
        <?php } ?> 
        
		<div class="panel panel-default">
			<div class="panel-body">
			
			<table <?php if(isMobile()){ ?> class="table_bottom"<?php } ?> >
			<tr>
				<td style="width:70px;text-align:right;">类型：</td>
				<td>
					<button type="button" id="aclear" class="btn  btn-default btn-sm button_m">全部</button>
					<button type="button" id="a_1" class="btn  btn-default btn-sm button_m">全职</button>
					<button type="button" id="a_2" class="btn  btn-default btn-sm button_m">临时工</button>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;">性别：</td>
				<td>
					<button type="button" id="bclear" class="btn  btn-default btn-sm button_m">全部</button>
					<button type="button" id="b_1" class="btn  btn-default btn-sm button_m">不限性别</button>
					<button type="button" id="b_2" class="btn  btn-default btn-sm button_m">只招男性</button>
					<button type="button" id="b_3" class="btn  btn-default btn-sm button_m">只招女性</button>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;">月薪：</td>
				<td>
						<button type="button" id="cclear" class="btn  btn-default btn-sm button_m">全部</button>
						<button type="button" id="c_1_1999" class="btn  btn-default btn-sm button_m">1~1999元</button>
						<button type="button" id="c_2000_3999" class="btn  btn-default btn-sm button_m">2000~3999元</button>
						<button type="button" id="c_4000_" class="btn  btn-default btn-sm button_m">超过4000元</button>
				</td>
			</tr>
			</table>
		
			
					<input type="hidden" id="leixing" name="leixing" value="<?php echo $leixing?>"/>
					<input type="hidden" id="sex" name="sex" value="<?php echo $sex?>"/>
					<input type="hidden" id="yuexin" name="yuexin" value="<?php echo $yuexin?>"/>


			</div>
		</div>
		
		
	<?php 
	$countSql = "select count(*) count from zl_employ where status!=-1  ";
	if(!empty($leixing)){
			$countSql = $countSql . " and leixing = '".$leixing."' ";
	}
	if(!empty($sex)){
			$countSql = $countSql . " and sex = '".$sex."' ";
	}
	if(!empty($yuexin)){
			$countSql = $countSql . " and yuexin = '".$yuexin."' ";
	}

	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
			<?php 
                if($countRow['count']!="0"){
            ?>
	<?php
				$sql = "select id, title,leixing,sex,yuexin,description ,tel,build_time,build_time>now() as isbefore from  (select * from zl_employ where status!=-1 ";
				
				if(!empty($leixing)){
						$sql = $sql . " and leixing = '".$leixing."' ";
				}
				if(!empty($sex)){
						$sql = $sql . " and sex = '".$sex."' ";
				}
				if(!empty($yuexin)){
						$sql = $sql . " and yuexin = '".$yuexin."' ";
				}
				
				$sql = $sql." order by build_time desc) a limit ".$db_limit_start.",".$db_limit_offset;
				 
				$result = mysqli_query($conn,$sql);	
	?>

	<?php require dirname(__FILE__) . '/list_search_common/employ_list.php';?>
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
				<p>此处发布招聘信息</p>
				<p>为保证您发布的帖子能停留在靠前的位置，请定期使用手机号登录系统，做<b>刷新</b>操作</p>
                <p>目前不支持求职信息的发布。</p>
                <div class="text-right">
                    <a target="_blank" id="new_employ" class="btn btn-success ">免费发布</a>
                </div>
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
                    您的公司、工厂是否已经家喻户晓？或者您有意让您的公司从“名不见经传”成为胜溪湖畔的明星企业？您可以购买图片广告位，链至为您提供的信息发布平台，或您的官方网站。费用：150元/90天 
            </div>
		</div>
        <?php } ?> 
        
	</div>
	
</div>
<?php require dirname(__FILE__) . '/include/footer.php';?>
