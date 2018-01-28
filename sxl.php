<html>
<body>
<?php 
//var_dump($_REQUEST);

$address= $_REQUEST["a"];
//echo $address;
$a= $_REQUEST['b'];
//echo $a;


if($address=="zhangwq"&&$a=="1"){
	echo "<b>注册成功</b>";
	?>
	<script>
		window.location.href="third.php";
	</script>
	<?php
	
	
}else{
	//echo "<b>注册失败</b>";
	?>
		<b>注册失败</b>
	<?php 
}
?>
</body>
</html>