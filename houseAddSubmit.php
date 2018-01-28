<?php $locate="house";?>
<?php require dirname(__FILE__) . '/include/header_checkSession.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php

$title=$_POST['title'];
$leixing=$_POST['leixing'];
$price=$_POST['jiage'];
$address=$_POST['address'];
$floor_1=$_POST['floor_1'];
$floor_2=$_POST['floor_2'];
$huxing_1=$_POST['huxing_1'];
$huxing_2=$_POST['huxing_2'];
$huxing_3=$_POST['huxing_3'];
$square_metre=$_POST['square_metre'];
$decoration=$_POST['decoration'];
$region=$_POST['region'];


if(empty($title)
	||empty($leixing)
	||empty($price)
	||empty($address)
	||empty($floor_1)
	||empty($floor_2)
	||empty($huxing_1)
	||empty($huxing_2)
	||empty($huxing_3)
	||empty($region)
	||empty($square_metre)){
		echo "您输入的数据有误，请重新输入";
		return;
	}

$tel=$_POST['tel'];
$seller=$_POST['seller'];
$qq=$_POST['qq'];
$desc=$_POST['desc'];

$house="";

$sql = "select name from t_region where code= '".$region."' limit 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$region_name = $row['name'];
$house=$region_name."    ";

if($leixing=="chuzu"){
	$provider_id = 2000;
	$house=$house."租金：".$price."元/月";

}else if($leixing=="chushou"){
	$provider_id = 2001;
	$unit = round($price*10000/$square_metre);
	$house=$house."售价：".$price."万(单价 ".$unit."元/㎡)";

}else{
	echo "您输入的数据有误，请重新输入";return;
}

$house=$house." 位置：".$address." 户型：".$huxing_1."室".$huxing_2."厅".$huxing_3."卫"." ".$square_metre."㎡ ";

if(!empty($seller)){
	$house=$house." 联系人：".$seller;
}
if(!empty($qq)){
	$house=$house." QQ：".$qq;
}

if(!empty($decoration)&&$decoration!=0){
	if($decoration==1){
		$decoration_s = "毛坯";
	}else if($decoration==2){
		$decoration_s = "简装";
	}else if($decoration==3){
		$decoration_s = "精装";
	}else if($decoration==4){
		$decoration_s = "在建";
	}
	$house=$house." 装修程度：".$decoration_s;
}

$stmt=mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt,"select count(*) count from zl_house where tel=? and provider_id=? and title=? and source=20")){
	mysqli_stmt_bind_param($stmt,"sis",$tel,$provider_id,$title);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$count);
	mysqli_stmt_fetch($stmt);

	if($count>0){
	?>
		 <div class="container">
				<div class="panel panel-default">
					<div class="panel-heading">
						发布结果
					</div>
					<div class="panel-body">
						您已经发布过该信息，请使用手机号登录系统查看。
					</div>
				</div>
		</div>
	<?php	
	}else{
		$sql = "insert into zl_house (
                provider_id,title,address,price,
                description,create_time,modify_time,build_time,source,
                status,type,floor_1,floor_2,huxing_1,
                huxing_2,huxing_3,square_metre,decoration,house,
                tel,spider_key,seller,qq,userid,
                region 
            ) values (
                ?,?,?,?,
                ?,now(),now(),now(),20,
                0,?,?,?,?,
                ?,?,?,?,?,
                ?,?,?,?,?,?
            )";
            
		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, 'ississiiiiiiisssssss', $provider_id, $title, $address,$price,$desc,
			$leixing,$floor_1,$floor_2,$huxing_1,$huxing_2,$huxing_3,$square_metre,$decoration,$house,$tel,$title_key,$seller,$qq,$_SESSION['tel'],$region);
			$flag = mysqli_stmt_execute($stmt);

			if($flag){
			?>
				<div class="container">
						<div class="panel panel-default">
							<div class="panel-heading">
								发布结果
							</div>
							<div class="panel-body">
								您的信息已成功提交，请前往房屋租售页面查看。为保证您的发帖在列表中排名靠前，请定期登录系统<b>刷新</b>。
							</div>
						</div>
				</div>

			<?php
			}else{
					echo "错误2";
			}
		}else{
            echo "错误3";
        }
		?>

<?php
	}
}else{
	echo "错误5";
}
?>
<?php require dirname(__FILE__) . '/include/footer.php';?>