<?php header("Content-Type:text/html;charset=utf-8");?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php 
$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';
if($tel==""){
    echo "300";  
	exit;
}
if(!preg_match("/^1[34578]{1}\d{9}$/",$tel)){  
    echo "301";  
	exit;
}  

$sql_user = "select  pwd_question,pwd_answer,tel from t_user  where tel= '".$tel."' and status!=-1 limit 1"; 
$result_user = mysqli_query($conn,$sql_user);	
$telSys="";
$questionSys="";
while($row_user = mysqli_fetch_assoc($result_user)){
    $telSys=$row_user['tel'];
    $questionSys=$row_user['pwd_question'];
    $answerSys=$row_user['pwd_answer'];
}
if(empty($telSys)){
    echo "302";exit;
}
if(empty($questionSys)){
    if(empty($answerSys)){
        echo "303";exit;  
    }else{
        echo "304";exit;
    }
}else{
    echo $questionSys;
}

