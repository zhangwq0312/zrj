<?php $locate="coupon";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<script type="text/javascript" src="../js/bootbox.min.js" ></script>
<?php  
	$page= empty($_REQUEST['page'])|| !is_numeric($_REQUEST['page'])||$_REQUEST['page']<1 ? '1':$_REQUEST['page'];
	$status = empty($_REQUEST['status'])|| !is_numeric($_REQUEST['status'])?'0':$_REQUEST['status'];
	$db_limit_offset = 20;
	$db_limit_start = $db_limit_offset * ($page -1 );
?>

<style>
.btn-myStyle{position: absolute;top:25%; } 
.quan-item {
    position: relative;
    width: 244px;
    height: 110px;
    padding-right: 45px;
    padding-left: 10px;
    padding-top: 20px;
    background: url(img/blue_coupon.jpg) no-repeat 50% 50%;
    color: #fff;
    overflow: hidden;
}
.q-price {
    height: 30px;
    margin: 0 15px;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.q-limit {
    display: inline-block;
    height: 20px;
    padding: 0 2px;
    margin-top: 9px;
    margin-left: 5px;
    overflow: hidden;
    font-size: 12px;
    background: rgba(255,255,255,.7);
    border-radius: 2px;
    line-height: 20px;
    color: #f23030;
    vertical-align: top;
}
.q-range .txt{
    color: #fff;
    margin: 0 15px;
    line-height: 18px;
    overflow: hidden;
    padding-top:15px;
    font-size:14px;
}

.q-opbtns {
    position: absolute;
    right: 0;
    top: 0;
    width: 45px;
    height: 110px;
    color: #fff;
}

</style>
 <div class="container">
	<div class="col-md-9" >

		<div class="panel panel-default">
			<div class="panel-body">
			
			<table>
			<tr>
				<td style="width:70px;text-align:right;vertical-align:top; padding:9px 0px 0px 0px; ">类型：</td>
				<td>
						<button type="button" id="bclear" class="btn  btn-default btn-sm button_m">全部</button>
						<button type="button" id="b_1" class="btn  btn-default btn-sm button_m">正在抢券中</button>
						<button type="button" id="b_2" class="btn  btn-default btn-sm button_m">待抢券</button>
				</td>
			</tr>
			</table>
					<input type="hidden" id="status" name="status" value="<?php echo $status?>"/>
			</div>
		</div>
        
	<?php 
        $countSql = "select count(*) count from z_coupon where status=0 ";
        if ("0"==$status){
            $countSql = $countSql . " and ((publish_start_time<now() and publish_end_time>now() )or (publish_start_time>=now())) ";
        }
        if ("1"==$status){
            $countSql = $countSql . " and publish_start_time<now() and publish_end_time>now() ";
        }	
        if ("2"==$status){
            $countSql = $countSql . " and publish_start_time>=now() ";
        }

        $countResult = mysqli_query($conn,$countSql);
        $countRow = mysqli_fetch_assoc($countResult);
        $count = ceil  ($countRow['count']/$db_limit_offset);
    ?>
    <?php 
        if($countRow['count']!="0"){
    ?>
            
            <?php		
                $sql = "select *  from  (select * from z_coupon where status=0  and rest_num>0 ";
                if ("0"==$status){
                    $sql = $sql . " and ((publish_start_time<now() and publish_end_time>now() ) or (publish_start_time>=now())) ";

                }
                if ("1"==$status){
                    $sql = $sql . " and publish_start_time<now() and publish_end_time>now() ";
                }	
                if ("2"==$status){
                    $sql = $sql . " and publish_start_time>=now() ";
                }

                $sql = $sql." order by orderno desc ,create_time asc) a limit ".$db_limit_start.",".$db_limit_offset;
                $result = mysqli_query($conn,$sql);	
            ?>
			<?php require dirname(__FILE__) . '/list_search_common/coupon_list.php';?>
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
    <?php if(!isMobile()){ ?> 
        <div class="col-md-3" >
            <div class="panel panel-default">
                    <div class="panel-heading-blue">
                        提示
                    </div>
                    <div class="panel-body" >
                         为保证商家促销的真实性，本站只限发行免费的礼品券。凭借手机号和存放在“我的领券”中的验证码，在“券有效期”前往指定地点，即可领取赠品。
                    </div>
            </div>
       
            <div class="panel panel-default">
                    <div class="panel-heading-orange">
                        商家优惠活动
                        <a href="discountList.php" class="text-muted pull-right"><small>更多>>></small></a>
                    </div>
                    <div class="panel-body" style=" padding: 0px;">
                            <table class="table table-hover">
                                <?php		
                                    $sql = "select * from  (select a.c_id id,a.title ,b.short_name short_name,a.born_day_end born_day_end,a.born_day_begin from zl_discount a,zl_company b where  a.c_id=b.id and a.status!=-1 and b.status!=-1 and b.main_img !='' and a.born_day_end>date_add(now(), INTERVAL -1 day)  order by a.born_day_end desc,a.born_day_begin desc) a limit 0,7";
                                    //echo $sql;
                                    $result = mysqli_query($conn,$sql);	
                                    while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr><td style="padding: 5px 3px 5px 15px;">
                                            <div><a href="company.php?id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['short_name'];?>&nbsp;:&nbsp;<?php echo $row['title']; ?></a></div>
                                            <div class="text-right" style="color:#999"><small>起：<?php echo substr($row["born_day_begin"],0,10);?>&#12288;止：<?php echo substr($row["born_day_end"],0,10);?></small></div>
                                    </td></tr>
                                <?php }?>
                            </table>
                    </div>
            </div>
        </div>
    <?php } ?> 
</div>
<script type="text/javascript">
$(document).ready(function(){

    $("[id='b_<?php echo $status;?>']").addClass("btn-info");
	$("[id^='b_']").click(function(){
		var id = $(this).attr("id");
		var value =id.substr(2);
		document.getElementById("status").value= value;
		search();
	});
    $("[id='bclear']").click(function(){
		document.getElementById("status").value= '';
		search();
	});
	$("[id^='grab_']").click(function(){
            var id=$(this).attr("id").split("_");
            $.post("grab_ajax.php", {gid:id[1]},function(data) {
                bootbox.alert({
                    className: 'btn-myStyle',  
                    message: data
                }); 
            });
	});
});  

function search(){
		window.location.href="/coupon.php?status="+document.getElementById("status").value; 
}
    
function page(i){
		window.location.href="/coupon.php?page="+i+"&status="+document.getElementById("status").value; 
}

</script>
<?php require dirname(__FILE__) . '/include/footer.php';?>
