<?php $locate="";?>
<?php require dirname(__FILE__) . '/include/header.php';?>
<?php 
   // header("Cache-Control: max-age=600");//客户端缓存十分钟
?> 
<?php 
/*十分钟后重新生成首页html*/
$dir="html/";
$filename = "site.html";
$second=600;
if (is_dir($dir)){
    if(file_exists($dir.$filename)){
        $status=filemtime($dir.$filename)+$second>time();
        if($status){
            $str=file_get_contents($dir.$filename);
            echo $str;
            exit;
        }
    }
}

ob_start();
?>

 <div class="container">
	<div class="col-md-12" >
			<div class="panel panel-default" style="border:0px;padding:0px">
				<div class="panel-heading text-center">
					<span style="font-size:24px;">凤凰鸣工作室</span>
				</div>
				<div class="panel-body" style="padding:5px 15px;" >
			
				<p>本工作室致力于为胜溪湖南区域建设一个互联互通的信息发布平台，目前涵盖房产、教育、招聘、商家信息和婚介。</p>
				<p>在使用过程中，如果您有什么疑问，可以联系<?php echo SITE_CONN;?>，也可以给本站留言。</p>
				<p>工作时间：早9：00到下午17：00，中午饭时间可能休息</p>
				<br/>
				<p>选择我们的四大理由：</p>
				<p>1、地域优势：相对针对全国用户的58同城，赶集网，世纪佳缘，智联招聘，本网站专为胜溪湖附近用户提供服务。</p>	
				<p>2、节省开支：本站免费发布房产信息，婚姻介绍，招聘信息，便民电话等。婚恋仅在已达成“双方见面约定”的情况下才会涉及费用。</p>
				<p>3、长期合作：在未来，本站的功能将会持续扩展。对于老用户，长期合作能够使双方沟通更加流畅，共同发展。</p>	
				<p>4、教育培训：在运营本网站的同时，本工作室开展针对学生的《计算机技术普及班》，欢迎广大学生参与，以便在未来的学习和工作中游刃有余。</p>	
				<br/>
                
				<p>我们欢迎胜溪湖畔、北上广太的极客或运营的加入，欢迎来自超市、商家、房地产、政府等相关机构的合作。 </p>	
                
                
				<p>另外，本工作室兼职厂矿或者商家的企业管理系统的开发，以及相关培训。目前人手稀缺，仅能同时接1个到2个项目，希有意者从速。</p>
                <p><img src="img/site_1.jpg"/>&#12288;<img src="img/site_2.jpg"/></p>
                </div>
				<br/>
				<div class="text-center"><a href="#" class="btn btn-default" onClick="javascript:history.back(-1);">返回上一页</a></div>
				<br/>
			</div>
	</div>
    
    <?php require dirname(__FILE__) . '/include/footer.php';?>
</div>
<?php
    $content=ob_get_contents();//从缓存中获取内容
    ob_end_clean();//关闭缓存并清空
    /***缓存结束***/
    file_put_contents($dir.$filename, $content);
    echo $content;
?>