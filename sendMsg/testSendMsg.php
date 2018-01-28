<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 

    $c = new TopClient;
    $c->appkey = '24715305';
    $c->secretKey = '5cd612a39987dee9a2a5011e48808a70';

	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req ->setExtend( "" );
	$req ->setSmsType( "normal" );
	$req ->setSmsFreeSignName( "胜溪汇" );
	$req ->setSmsParam( "{code:'898724'}" );
	$req ->setRecNum( "18701690961" );
	$req ->setSmsTemplateCode( "SMS_122035036" );
	$resp = $c ->execute( $req );

?>