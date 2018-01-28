<?php $locate = empty($_REQUEST['locate'])?'cont':$_REQUEST['locate'];?>
<?php if($locate!="cont"&&$locate!="house"&&$locate!="marriage"&&$locate!="company"&&$locate!="employ"&&$locate!="tel"&&$locate!="education"){echo "不支持该类型的搜索";exit;}?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>

<?php	
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$key= empty($_REQUEST['key'])?'':$_REQUEST['key'];
?>
<script type="text/javascript">
function page(i){
		window.location.href="/search.php?page="+i+"&locate=<?php echo $locate;?>&key=<?php echo $key;?>"; 
}
</script>

 <div class="container">
	<div class="col-md-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				搜索结果&nbsp;&nbsp;(仅显示十分钟之前发布的信息)
			</div>
			
			<?php 
				if(empty($key)){echo "<div class='panel-body row'>&#12288;&#12288;您还没有输入关键字呢......</div>";exit;}
			?>

			<?php 
				$perPage = 20;
				$ch=curl_init(); 
				$search_url="http://127.0.0.1:8080/search/q.do?key=".$key."&type=".$locate."&page=".$page."&perPage=".$perPage;
				//echo $search_url;
				curl_setopt($ch,CURLOPT_URL,$search_url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				
				$output=curl_exec($ch);

				curl_close($ch);

				$arr = json_decode($output, true);

				if(empty($arr)||empty($arr['code'])||$arr['code']!=200){
					echo  "<div class='panel-body row'>&#12288;&#12288;搜索系统正在维护，暂不可使用......</div>";
                    exit;
				}
				$total_count=$arr['res']['total'];
				$str=implode(',',$arr['res']['list']);
				
				if(empty($str)){
					echo "<div class='panel-body row'>&#12288;&#12288;没有搜索到相关记录</div>";
					exit;
				}
			?>	
        </div>
        
			<?php 
			$count = ceil  ($total_count/$perPage);
			?>
				<?php
                    if($locate!="marriage"){
                        $sql = "select *,build_time>now() as isbefore from zl_".$locate." where status=0 and id in (".$str.") order by INSTR('".$str."',id)";
                    }else{
                        $sql = "select * from zl_".$locate." where status=0 and id in (".$str.") order by INSTR('".$str."',id)";
                    }
					$result = mysqli_query($conn,$sql);	
				?>

				<?php if($locate=="house"){ ?>
					<?php require dirname(__FILE__) . '/list_search_common/house_list.php';?>
				<?php } ?>
				
				<?php if($locate=="employ"){ ?>
					<?php require dirname(__FILE__) . '/list_search_common/employ_list.php';?>
				<?php } ?>

				<?php if($locate=="marriage"){ ?>
					<?php require dirname(__FILE__) . '/list_search_common/marriage_list.php';?>
				<?php } ?>
				
				<?php if($locate=="tel"){ ?>
					<?php require dirname(__FILE__) . '/list_search_common/tel_list.php';?>
				<?php } ?>
				
				<?php if($locate=="education"){ ?>
					<?php require dirname(__FILE__) . '/list_search_common/education_list.php';?>
				<?php } ?>
                
                
				<?php if($locate=="company"){ ?>
				<div class="row">
                        <?php
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <div class="col-md-3" >
                                <div class="thumbnail">
                                    <a href="company.php?id=<?php echo $row["id"];?>" target="_blank">
                                        <img src="<?php echo $row["main_img"];?>" class="img-rounded">
                                    </a>
                                    <div class="caption">
                                        <p><?php echo $row["name"];?></p>
                                        <p>
                                        <?php if(!empty($row['tel'])){ ?>
                                            <i  class="glyphicon glyphicon-phone"  style="color:#999"></i>&nbsp;
                                        <?php } ?>
                                        <span class="tel"><?php echo $row["tel"];?></span></p>
                                    </div>
                                 </div>
                            </div>
                        <?php
                            }	
                        ?>	
                </div>
				<?php } ?>
	<?php require dirname(__FILE__) . '/include/page.php';?>
    
    


    
    
	</div>
</div>

<?php
if(isset($conn)){
	mysqli_close($conn);
}
?>