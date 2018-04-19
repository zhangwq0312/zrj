<?php $locate="house";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$region = empty($_REQUEST['region'])?'':$_REQUEST['region'];
	$leixing = empty($_REQUEST['leixing'])?'':$_REQUEST['leixing'];
	$after_day = empty($_REQUEST['after_day'])|| !is_numeric($_REQUEST['after_day'])?'':$_REQUEST['after_day'];
	
	if($leixing!="chuzu"&&$leixing!="chushou"&&$leixing!=""){
		echo "输入格式有误。";
		exit;
	}
	$jiage = empty($_REQUEST['jiage'])?'':$_REQUEST['jiage'];
	$jiagecheck= str_replace("_","",$jiage);
	
	if(!is_numeric($jiagecheck)&&$jiagecheck!=""){
		echo "输入格式有误！";
		exit;
	}

	$day_limit="";
	if($after_day=="1"){
			$day_limit="7";
	} else if($after_day=="2"){
			$day_limit="30";
	}
	
	$db_limit_offset = 10;
	$db_limit_start = $db_limit_offset * ($page -1 );
?>

<style>
.button_m{margin:4px;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("[id^='a_']").click(function(){
			if($(this).attr("id")=="a_0"){
				document.getElementById("leixing").value= "";
				document.getElementById("jiage").value= "";
			}  

			if($(this).attr("id")=="a_1"){
				document.getElementById("leixing").value= "chushou";
				document.getElementById("jiage").value= "";
			}
			if($(this).attr("id")=="a_2"){
				document.getElementById("leixing").value= "chuzu";
				document.getElementById("jiage").value= "";
			}
			search();
	});
	
	$("[id^='b_']").click(function(){
			
			if($(this).attr("id")=="b_0"){
				document.getElementById("jiage").value= '';
			}
			if($(this).attr("id")=="b_1"){
				document.getElementById("jiage").value= '_15';
			}
			if($(this).attr("id")=="b_2"){
				document.getElementById("jiage").value= '15_20';
			}
			if($(this).attr("id")=="b_3"){
				document.getElementById("jiage").value= '20_30';
			}
			if($(this).attr("id")=="b_4"){
				document.getElementById("jiage").value= '30_';
			}
			search();
	});
	
	$("[id^='c_']").click(function(){
			//$("[id^='c_']").removeClass("btn-info btn-default").addClass("btn-default");   
			
			//if($(this).attr("id")!="c_0"){
				//$(this).removeClass("btn-default");
				//$(this).addClass("btn-info");
			//}
			
			if($(this).attr("id")=="c_0"){
				document.getElementById("jiage").value= '';
			}
			if($(this).attr("id")=="c_1"){
				document.getElementById("jiage").value= '_500';
			}
			if($(this).attr("id")=="c_2"){
				document.getElementById("jiage").value= '500_1000';
			}
			if($(this).attr("id")=="c_3"){
				document.getElementById("jiage").value= '1000_';
			}
			search();
	});
	
	$("[id^='d_']").click(function(){
			if($(this).attr("id")=="d_0"){
				document.getElementById("region").value= '';
			}else{
				var crowd=$(this).attr("id").split("_");
				var old = document.getElementById("region").value;

				var cc = crowd[1]+'_';
				if(old.indexOf(cc)>-1){
					old = old.replace(cc,"");
					$("#region").val(old);
				}else{
					$("#region").val(old+cc);
				}
			}

			search();
	});
	
	$("[id^='e_']").click(function(){
			if($(this).attr("id")=="e_0"){
				$("#after_day").val('');
			}else{
				var days=$(this).attr("id").split("_");
				$("#after_day").val(days[1]);
			}

			search();
	});
	
	
	$("#new_house").click(function(){
		window.open("/houseAdd.php");
	});
	
});

function search(){
		window.location.href="/house.php?leixing="+document.getElementById("leixing").value+"&jiage="+document.getElementById("jiage").value+"&region="+document.getElementById("region").value+"&after_day="+document.getElementById("after_day").value; 
}

function page(i){
		window.location.href="/house.php?page="+i+"&leixing="+document.getElementById("leixing").value+"&jiage="+document.getElementById("jiage").value+"&region="+document.getElementById("region").value+"&after_day="+document.getElementById("after_day").value; 
}
	
	
</script>


 <div class="container">
        <div class="col-md-9" >
        
            <?php if(isMobile()){?> 
            <?php require_once dirname(__FILE__) . '/include/search_mobile.php';?>
            <?php } ?> 
        
			<div class="panel panel-default">
			<div class="panel-body">
					<input type="hidden" id="leixing" name="leixing" value="<?php echo $leixing?>"/>
					<input type="hidden" id="jiage" name="jiage" value="<?php echo $jiage?>"/>
					<input type="hidden" id="region" name="region" value="<?php echo $region?>"/>
					<input type="hidden" id="after_day" name="after_day" value="<?php echo $after_day?>"/>
		
                <table <?php if(isMobile()){ ?> class="table_bottom"<?php } ?> >
					<tr>
						<td style="width:70px;text-align:right;">类型：</td>
						<td>
							<button type="button" id="a_0" class="btn btn-default  btn-sm button_m" >全部</button>
							<button type="button" id="a_1" class="btn <?php if($leixing == "chushou"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m" >出售</button>
							<button type="button" id="a_2" class="btn <?php if($leixing == "chuzu"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">出租</button>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">小区：<br/>&#12288;<br/>&#12288;</td>
						<td>

							<button type="button" id="d_0" class="btn btn-default  btn-sm button_m">全部</button>
								<?php 
								$sql = "select id, name,code from t_region where status !=-1 order by id ";
								$result = mysqli_query($conn,$sql);
								?>
								<?php			
									while($row = mysqli_fetch_assoc($result)){
								?>
									<button type="button" id="d_<?php echo $row['code']?>" class="btn <?php  if(strpos($region,$row['code'].'_')!== false){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m"><?php echo $row['name']?></button>
								<?php
									}	
								?>	
								<small><span style="color:#26c6da">支持多选</span></small>
						</td>
					</tr>
					<tr>
						<td style="width:70px;text-align:right;">时间：</td>
						<td>
							<button type="button" id="e_0" class="btn btn-default  btn-sm button_m" >全部</button>
							<button type="button" id="e_1" class="btn <?php if($after_day == "1"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m" >一周内发布</button>
							<button type="button" id="e_2" class="btn <?php if($after_day == "2"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">一月内发布</button>
						</td>
					</tr>
					<tr id="chushou" style="<?php if($leixing != "chushou"){echo "display:none;";}?>" >
						<td style="text-align:right;">价格：</td>
						<td>
							<button type="button" id="b_0" class="btn btn-default  btn-sm button_m">全部</button>
							<button type="button" id="b_1" class="btn <?php if($jiage == "_15"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">15万以内</button>
							<button type="button" id="b_2" class="btn <?php if($jiage == "15_20"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">15万-20万</button>
							<button type="button" id="b_3" class="btn <?php if($jiage == "20_30"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">20万-30万</button>
							<button type="button" id="b_4" class="btn <?php if($jiage == "30_"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">30万以上</button>
						
						</td>
					</tr>
					<tr id="chuzu"  style="<?php if($leixing != "chuzu"){echo "display:none;";}?>" >
						<td style="text-align:right;">价格：</td>
						<td>
							<button type="button" id="c_0" class="btn btn-default  btn-sm button_m">全部</button>
							<button type="button" id="c_1" class="btn <?php if($jiage == "_500"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">月租500元以内</button>
							<button type="button" id="c_2" class="btn <?php if($jiage == "500_1000"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">月租500-1000元</button>
							<button type="button" id="c_3" class="btn <?php if($jiage == "1000_"){echo "btn-info";}else{echo "btn-default";}?>  btn-sm button_m">月租1000以上</button>
						</td>
					</tr>
					</table>
			</div>
			</div>
			
<?php 
	$countSql = "select count(*) count from zl_house where status!=-1  ";
	if($leixing!=''){
		$countSql = $countSql . " and type = '".$leixing."' ";
	}

	if($jiage != ""){
		$arr = explode("_",$jiage);
		if($arr[0]!=""&&$arr[1]!=""){
			$countSql = $countSql . " and price between  ".$arr[0]." and ".$arr[1];
		}else if($arr[1]==""){
			$countSql = $countSql . " and price >=  ".$arr[0];  
		}else{
			$countSql = $countSql . " and price >0 and price <  ".$arr[1];  
		}
	}

	if($region != ""){
			$region_temp = rtrim($region,"_");
			$regionArray = explode("_", $region_temp); 
			$countSql = $countSql . " and region in (";
			foreach ($regionArray as $r) {
				$countSql=$countSql."'".$r."',";
			}
			$countSql = rtrim($countSql,",");
			$countSql=$countSql.")";  
	}

	if($day_limit != ""){
		$countSql=$countSql." and TIMESTAMPDIFF(day,build_time,now())<=".$day_limit;
	}
	
	$countResult = mysqli_query($conn,$countSql);
	$countRow = mysqli_fetch_assoc($countResult);
	$count = ceil  ($countRow['count']/$db_limit_offset);
?>
			<?php 
                if($countRow['count']!="0"){
            ?>

			<?php		
				$sql = "select id,status,source,build_time,build_time>now() as isbefore, title, url,house,tel,description from  (select * from zl_house where status!=-1 ";
				
				if($leixing == "chuzu"){
						$sql = $sql . " and type = 'chuzu' ";
				}
				if($leixing == "chushou"){
						$sql = $sql . " and type = 'chushou' ";
				}
				
				if($jiage != ""){
					$arr = explode("_",$jiage);
					if($arr[0]!=""&&$arr[1]!=""){
						$sql = $sql . " and price between  ".$arr[0]." and ".$arr[1];
					}else if($arr[1]==""){
						$sql = $sql . " and price >=  ".$arr[0];  //30_
					}else{
						$sql = $sql . " and price >0 and price <  ".$arr[1];  //_30
					}
				}
				
				if($region != ""){
						$region_temp = rtrim($region,"_");
						$regionArray = explode("_", $region_temp); 
						$sql = $sql . " and region in (";
						foreach ($regionArray as $r) {
							$sql=$sql."'".$r."',";
						}
						$sql = rtrim($sql,",");
						$sql=$sql.")";  
				}

				if($day_limit != ""){
					$sql=$sql." and TIMESTAMPDIFF(day,build_time,now())<=".$day_limit;
				}
				
				$sql = $sql." order by build_time desc) a limit ".$db_limit_start.",".$db_limit_offset;
				//var_dump($sql);
				$result = mysqli_query($conn,$sql);	
			?>
			
			<?php require dirname(__FILE__) . '/list_search_common/house_list.php';?>
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
			<div class="panel-heading-blue">
				提示
			</div>
			<div class="panel-body">
				<p>“<span style="color:#428bca">蓝色</span>”标题的数据属于本站。</p>
				<p>“<span style="color:#ff6700">橙色</span>”标题的数据属于“58同城”，本站不收录联系方式。请"<span style="color:#ff6700">点击标题</span>"，进入“58同城”查看。</p>
				<p>本站数据排在前面。</p>
                <div class="text-right"><a target="_blank" id="new_house" class="btn btn-success">免费发布</a></div>
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
                     
					<p>此处提供给小区地产商，可以链您的网站、或本站为您提供的商户界面。费用：300元/90天</p>
                    
            </div>
		</div>
        <?php } ?> 
	</div>

</div>
<?php require dirname(__FILE__) . '/include/footer.php';?>
