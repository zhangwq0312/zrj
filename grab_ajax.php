<?php
session_start(); 
if(empty($_SESSION['tel'])){
    echo "请先登录后再抢权券。";return;
}

$gid=empty($_POST['gid'])|| !is_numeric($_POST['gid'])||$_POST['gid']<1 ? '':$_POST['gid'];
if(empty($gid)){ echo "优惠券信息不全";return;}

?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php require dirname(__FILE__) . '/common/function.php';?>
<?php
$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select rest_num count,status,  publish_start_time<now() p1,  publish_end_time>now() p2 from z_coupon where id=?  ")){
	mysqli_stmt_bind_param($stmt,"s",$gid);

	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$s_count,$s_status,$s_p1,$s_p2);
	mysqli_stmt_fetch($stmt);

	if($s_status!=0){
		echo "此券已失效，不再发放！";return;
	}
    
    if($s_p1==0 || $s_p2==0){
		echo "待领券，留意开抢时间再来哦！";return;
	}
    
	if($s_count==0){
		echo "您来晚了，刚刚有人把最后一张券抢走了。。。下次继续努力哦！";return;
	}
    
    if (mysqli_stmt_prepare($stmt,"select count(*) count from z_coupon_user where userid=? and gid=?  ")){
        mysqli_stmt_bind_param($stmt,"si",$_SESSION['tel'],$gid);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$s_count_user);
        mysqli_stmt_fetch($stmt);
        if($s_count_user>0){
            echo "您今日已领过该券了，不能贪心哦。";return;
        }
    }
    
    
    $sql2 = "update z_coupon set rest_num = rest_num-1 
                where id=? and rest_num>0";
    if (mysqli_stmt_prepare($stmt, $sql2)) {
        mysqli_stmt_bind_param($stmt, 'i',$gid);
        $flag2 = mysqli_stmt_execute($stmt);
        if($flag2==1){
        
            $coupon_code=randomkeys(6);
            //echo $coupon_code;
            $sql = "insert into z_coupon_user (userid,gid,big,small,start_time,end_time,create_time,description,coupon_code)
                select ?, id,big,small,start_time,end_time,now(),description,? from z_coupon where id=? ";

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssi', $_SESSION['tel'],$coupon_code,$gid);
                $flag = mysqli_stmt_execute($stmt);
                
                if($flag==1){
                    echo "领券成功，已放入您的帐号，请及时使用";
                }else{
                   echo "系统正在维修中，领券失败，抱歉!";
                }
            }
        }else{
            echo "刚刚被抢光了，抱歉。";
        }
    }
    
    
    


}
?>