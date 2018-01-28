<?php header("Content-Type:text/html;charset=utf-8");?>
<meta charset="utf-8" />
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php include "sendMsg/TopSdk.php";?>
<?php 
$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';
if($tel==""){
    echo "请在上方第一栏填写手机号";  
	exit;
}
if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)){  
    echo "手机号码有误";  
	exit;
}  

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
if($type!="reg"&&$type!="leave_msg_sys"&&$type!="resetPassword"){echo "验证类型有误";exit;}

if($type=="reg"){
	$sql_user = "select  tel from t_user  where tel= '".$tel."' and status!=-1 limit 1"; 
	$result_user = mysqli_query($conn,$sql_user);	
	$telSys="";
	while($row_user = mysqli_fetch_assoc($result_user)){
		$telSys=$row_user['tel'];
	}
	if(!empty($telSys)){
		echo "该手机号已注册";exit;
	}
}

$code = rand(100000,999999);

//发送短信成功但没有经过验证的，如果有且时间在55秒以内的，返回“离上次您申请验证码的时间很近哦，请稍后再试。”;
$sql_0="select TIMESTAMPDIFF(SECOND,create_time,now()) between_second from t_checkcode where tel='".$tel."' and type='".$type."' and status=1 order by create_time desc limit 1";

$result_0 = mysqli_query($conn,$sql_0);
if($result_0){
	$row_0 = mysqli_fetch_assoc($result_0);
	if($row_0&&$row_0['between_second']<55){
		echo "离上次您申请验证码的时间很近哦，请耐心等待一分钟后再试。";exit;
	}
}

$sql = "insert into t_checkcode(tel,code,status,create_time,type) values('".$tel."','".$code."',0,now(),'".$type."')"; 
$result = mysqli_query($conn,$sql);	
if($result){
	    date_default_timezone_set('Asia/Shanghai'); 
		$c = new TopClient;
		$c->appkey = '24715305';
		$c->secretKey = '5cd612a39987dee9a2a5011e48808a70';

		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req ->setExtend( "" );
		$req ->setSmsType( "normal" );
		$req ->setSmsFreeSignName( "胜溪汇" );
		$req ->setSmsParam( "{code:'".$code."'}" );
		$req ->setRecNum($tel);
		$req ->setSmsTemplateCode( "SMS_122035036" );
		$resp = $c ->execute( $req );
		
		$sql2 = "update t_checkcode set status=1,modify_time=now() where tel='".$tel."' and code = '".$code."' and type='".$type."'"; 
		$result2 = mysqli_query($conn,$sql2);	
		
		echo "验证码已发送";//
}else{
	echo "系统故障，请联系站长";//
}
