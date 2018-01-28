<?php require dirname(__FILE__) . '/header.php';?>
<?php require dirname(__FILE__) . '/../include/db.php';?>
<?php
	$coupon_id= empty($_REQUEST['coupon_id'])|| !is_numeric($_REQUEST['coupon_id'])||$_REQUEST['coupon_id']<1 ? '':$_REQUEST['coupon_id'];
    $code= empty($_REQUEST['code'])|| !is_numeric($_REQUEST['code'])||$_REQUEST['code']<1 ? '':$_REQUEST['code'];

    if(empty($coupon_id)){ return;}
	$menu_active="coupon_".$coupon_id;
?>
<style>
.table>thead>tr>td {
    text-align:center;
}
.table>tbody>tr>td {
    padding: 5px 15px 5px 15px;
    line-height: 1.5;
    vertical-align: top;
    border-bottom: 1px solid #ddd;
    border-top: 0px;
    text-align:center;
    font-size:15px;
    WORD-WRAP: break-word;
}
.table{table-layout:fixed;}
</style>
<div class="container-fluid">    
	<?php require dirname(__FILE__) . '/menu_left.php';?>
	<?php 
        $sql_coupon = "select * from  z_coupon where  status=0 and id=".$coupon_id." and userid='".$_SESSION['tel']."'";
        $sql_coupon = $sql_coupon." order by userid desc";
        $result_coupon = mysqli_query($conn,$sql_coupon);	
        
        $row_coupon_count=mysqli_num_rows($result);
        if($row_coupon_count==0){
            return;
        }
        $row_coupon=mysqli_fetch_assoc($result_coupon);
        $pstime =strtotime($row_coupon["publish_start_time"]);
        $petime =strtotime($row_coupon["publish_end_time"]);
 
    ?>
    
	<div class="col-md-10">  
		<div class="panel panel-default" >
			<div class="panel-heading" style="background-color:#fff;">
				<i class="glyphicon glyphicon-volume-up"></i>&nbsp;<?php echo $row_coupon["big"];?>
			</div>
			<div class="panel-body" style="padding:20px 50px 20px 50px">
            <?php 
            $time_flag=0;
            if($pstime>=time()){
                $time_flag=1;
            }else if($petime<=time()){
                $time_flag=2;
            }else if($pstime<time() && $petime>time()){
                $time_flag=3;
            }    

            ?>
            <form role="form" id="form_txt" class="form-horizontal" action="coupon_user.php">
                <div <?php if(!isMobile()){?>style="width:300px"<?php }?>>  
                    <div class="input-group">
                        <input type="hidden"  id="coupon_id" name="coupon_id" value="<?php echo $coupon_id; ?>" >
                        <input type="text" class="form-control" placeholder="手机号/验证码" id="code" name="code" value="<?php echo htmlspecialchars($code); ?>" >
                      <span class="input-group-btn">
                            <button id="search_coupon_user" class="btn btn-default" type="submit">查询</button>
                      </span>
                    </div> 
                </div> 
            </form>
            
                <?php		
                if(!empty($code)){
                    $sql = "select * from  z_coupon_user where   gid=".$coupon_id." and gid in ( select id from z_coupon t where t.userid=".$_SESSION['tel'].") and ( userid = '".$code."' or coupon_code='".$code."')";
                    $sql = $sql." order by userid desc";
                    $result = mysqli_query($conn,$sql);	
                    $rowcount=mysqli_num_rows($result);
                    if($rowcount>0){
                ?>
                    <br/>
                
                    <?php if(!isMobile()){?>
                        <table class="table table-bordered table-hover table-striped">
                                <thead><tr>
                                    <td class="success">手机号</td>
                                    <td class="success">验证码</td>
                                    <td class="success">状态</td>
                                    <td class="success">操作</td>
                                    </tr></thead>
                                <?php
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $row['userid']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['coupon_code']; ?>
                                                            </td>
                                                            <td>
                                                                <?php if("0"==$row['status']){
                                                                    echo "未使用";
                                                                }else if ("-1"==$row['status']){
                                                                    echo "已使用" ;
                                                                }?>
                                                            </td>
                                                            <td>
                                                                <?php if("0"==$row['status']){
                                                                    echo "<button id='cs_".$row["id"]."'  class='btn btn-success btn-xs'>标记为已领取</button>";
                                                                }else if ("-1"==$row['status']){
                                                                    echo "已".date('Y-m-d H:i:s', strtotime($row['used_time']))."使用。"."<a id='bk_".$row["id"]."'  >恢复</a>";
                                                                }?>
                                                            </td>
                                                            </tr>
                                <?php }?>
                        </table>
                        
                    <?php }else{?>
                    
                        <table class="table table-bordered table-hover table-striped">
                                <?php
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <tr>
                                            <td style="text-align: left;">
                                                手机号:&nbsp;<?php echo $row['userid']; ?>
                                                <br/>
                                                验证码:&nbsp;<?php echo $row['coupon_code']; ?>
                                                <br/>
                                                状态:&nbsp;
                                                <?php if("0"==$row['status']){
                                                    echo "未使用";
                                                }else if ("-1"==$row['status']){
                                                    echo "已使用" ;
                                                }?>
                                                <br/>
                                                操作:&nbsp;
                                                <?php if("0"==$row['status']){
                                                    echo "<button id='cs_".$row["id"]."'  class='btn btn-success btn-xs'>标记为已领取</button>";
                                                }else if ("-1"==$row['status']){
                                                    echo "已".date('Y-m-d H:i:s', strtotime($row['used_time']))."使用。"."<a id='bk_".$row["id"]."'  >恢复</a>";
                                                }?>
                                            </td>
                                        </tr>
                                <?php }?>
                        </table>

                    <?php }?>
                
                
				<?php }else{?>
                
                    <br/><p style="color:#999">&#12288;没有该券，请检查输入。</p>
                <?php }?>
                <?php }?>
                
                <br/><p style="color:#999">&#12288;<?php 
                    if($time_flag==1){
                        echo "该券尚未发行。";
                    }else if($time_flag==2){
                        echo "该券发行结束。";
                    }else if($time_flag==3){
                        echo "该券正在发行。";
                    }  
                    ?>
                    
                    <?php if($time_flag!=1){ ?> 
                        共<?php echo $row_coupon["total_num"];?>张,
                        领取<?php echo $row_coupon["rest_num"];?>张。
                        已领取中<a target="_blank" href="./coupon_user_nouse.php?coupon_id=<?php echo $coupon_id;?>">待用券</a>和<a target="_blank" href="./coupon_user_used.php?coupon_id=<?php echo $coupon_id;?>">已验证券</a>。
                    <?php } ?>
                </p>
            </div>
		</div>
	</div>
</div> 


<script type="text/javascript">
$(document).ready(function(){
	$("[id^='cs_']").click(function(){
        var id = $(this).attr("id");
		var value =id.substr(3);
		$.post("coupon_user_ajax.php",{ coupon_user_id:value,type:'used'},function(data) {
			if(data=="success"){
                window.location.reload();
			}else{
                alert(data);
            }
		});
	});
    
	$("[id^='bk_']").click(function(){
        var id = $(this).attr("id");
		var value =id.substr(3);
		$.post("coupon_user_ajax.php",{ coupon_user_id:value,type:'nouse'},function(data) {
			if(data=="success"){
                window.location.reload();
			}else{
                alert(data);
            }
		});
	});
});
</script>
<?php require dirname(__FILE__) . '/../include/footer.php';?>



















