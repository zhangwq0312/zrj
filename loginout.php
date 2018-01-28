<?php
session_start();
$_SESSION['tel']="";
session_destroy();

$refer=$_REQUEST['refer'];
if(!empty($refer)){
    header("location: ".$refer);
}else{
    $from="";
    $to="";
    if(empty($from)){
        if(!empty($_REQUEST['from'])){
            $to=$_REQUEST['from'];
        }else{
            $to="";
        }
    }
     
    if($to=="company"){
        $to="business";
    } 
    if($to==""){
        header("location: /");
    }else{
        header("location: /".$to.".php");
    }
}
?>
