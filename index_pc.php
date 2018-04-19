<?php require dirname(__FILE__) . '/head_login_reg.php';?>   

<?php header("Cache-Control: max-age=600");//客户端缓存十分钟?> 

<style>
ul>li{background-color:#fff;margin:10px}

.nav>li>a:hover, .nav>li>a:focus{
    color: #fff;
    background-color: #5bc0de;
    border-color: #5bc0de;
}

</style>

<div class="banner_color">
 <div class="container">
 
            <div class="col-md-6" >
            
                 <div class="panel panel-default" style="height:350px;border:0px;background-color:transparent;  -webkit-box-shadow: none; box-shadow: none; ">
                    <div class="panel-heading"  style="background-color:transparent;color:#fff">
                        您可以点击下列类型：
                    </div>
                    <div class="panel-body" >
                        <ul class="nav navbar-nav" >
                            <li><a href="house.php">住房</a></li>
                            <li ><a href="education.php">教育</a></li>
                            <li><a href="marriage.php">婚恋</a></li>	
                            <li><a href="employ.php">招聘</a></li>
                            <li><a href="coupon.php">促销</a></li>
                            <li><a href="tel.php">便民</a></li>
                            <li><a href="business.php">商家</a></li>
                        </ul>
                    </div>
                    
                    <div class="panel-heading"  style="background-color:transparent;color:#fff">
                        介绍：
                    </div>
                    <div class="panel-body" >
                        <p class="lead" style="color:#fff;font-size:18px;">
                        &#12288;&#12288;本站致力于孝义市胜溪湖畔的信息汇集和信息推送，未来将持续推出更多的类型。预计本年度将实现“个人定制接收信息”，并推送到手机和邮箱。
                        </p>
                    </div>
                    
                </div>
                
            </div>

            <div class="col-md-4" >
                <div class="panel panel-default" style="height:350px;background-color:#fff">
                    <div id="myCarousel" class="carousel slide">
                        <!-- 轮播（Carousel）指标 -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>   
                        <!-- 轮播（Carousel）项目 -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <a href="/contView.php?type=my&id=6"><img  src="/img/test2.jpg" alt="胜溪互联上线啦！" >
                                </a>	
                            </div>
                            <div class="item">
                                <a href="/contView.php?type=my&id=7"><img src="/img/zhaoshang.jpg" alt="Third slide" >
                                </a>	
                            </div>
                            <div class="item">
                                <a href="/contView.php?type=computer&id=1"><img src="/img/zhaosheng_3.jpg" alt="走进互联网技术的世界" >
                                </a>
                            </div>
                        </div>
                        <!-- 轮播（Carousel）导航 -->
                        <a class="carousel-control left" style="background-image:none" href="#myCarousel" 
                            data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control right" style="background-image:none" href="#myCarousel" 
                            data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                    
					<div class="panel-body" style=" padding: 0px;">
						<?php		
							$sql = "select id, title,build_time,flag from  (select * from zl_cont where type ='my' and  status!=-1 ";
							$sql = $sql." order by order_num,build_time desc) a limit 0,9";
							//echo $sql;
							$result = mysqli_query($conn,$sql);	
						?>
                        <table class="table table-hover">
						<?php
						while($row = mysqli_fetch_assoc($result)){
							?>
												<tr><td style="padding: 5px 3px 5px 15px;">
													<?php 
														if(!empty($row['flag'])){
													?>
														
														<i class="glyphicon glyphicon-volume-up red_color"></i>
													<?php
														}
													?>
													
													
														<a href="contView.php?type=my&id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['title']; ?></a>
<?php if(!empty($_SESSION['tel'])&&isAdmin($_SESSION['tel'])){?><a  href="contEdit.php?type=my&id=<?php echo $row['id'];?>" ><i class='glyphicon glyphicon-pencil'></i></a><?php }   ?>	
													</td></tr>
						<?php }?>
                        </table>
					</div>
				</div>  
    </div>	

    <div class="col-md-2" >
        <div class="panel panel-default" style="height:350px;border:2px ;padding:10px 15px 5px 15px;background-color:#b1d1e6">
            <?php if($msg=="001"){echo "<div>系统没有该用户名,请注册</div>";} ?>	
            <?php if($msg=="002"){echo "<div>密码错误</div>";} ?>		
            

            <?php if(!empty($_SESSION['tel'])){ ?> 
			<div class="form-group" >
                <div  style="background-color: #eee;padding:5px 10px;
    font-size: 14px;
word-break:break-all;word-wrap:break-word;">
                    <div style="color:#666">
                        <p>
                            <strong>帐号：</strong><br/>
                            &nbsp;<span style="color:#f0ad4e"><?php echo $_SESSION['tel']; ?></span>
                            <br/>
                            <strong>昵称：</strong><br/>
                            &nbsp;<span style="color:#f0ad4e"><?php if(!empty($_SESSION['ni'])){echo $_SESSION['ni'];} else {echo "未设置";}?></span>
                        </p>
                    </div>
                </div>
              </div>
                <div style="font-size: 14px;" class="text-right">
                        <a href="/loginout.php" >退出</a> 
                </div>
              
                <br/>
                
                <div  >
                        <a class="btn btn-info btn-sm btn-block " href="/house.php"  style="text-align:left" role="button">&nbsp;搜索住房信息</a>
                        <a class="btn btn-info btn-sm btn-block " href="/user_center/index.php"  style="text-align:left" role="button">&nbsp;前往个人中心</a>
                        <a class="btn btn-danger btn-sm btn-block " href="/contact.php" style="text-align:left"  role="button">&nbsp;给本站留言</a>
                </div>
            <?php }else{ ?>
                <form role="form"  action="/loginSubmit.php" method="POST">  
                  <input type="hidden" name="refer" value="<?php echo $refer;?>" />
                <div class="form-group">
                    <div>
                        <label for="tel" class="control-label" style="font-size: 14px;color:#337ab7"><strong>手机号</strong></label>  
                        <input type="text" id="tel"  name="tel"  class="form-control input-sm" placeholder="手机号" />  
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="password" class="control-label" style="font-size: 14px;color:#337ab7"><strong>密码</strong></label>  
                        <input type="password" id="password" name="password" class="form-control input-sm" placeholder="密码" required/>
                    </div>
                </div>
                <div class="form-group ">
                        <button class="btn btn-warning btn-sm btn-block " type="submit">登录</button> 
                </div>	
                <div style="font-size: 14px;" class="text-center">
                        <a href="/register.php<?php if(!empty($refer)){echo "?refer=".$refer;}?>" >注册</a> &nbsp;|&nbsp; <a href="/resetPassword.php<?php if(!empty($refer)){echo "?refer=".$refer;}?>" >忘记密码</a> 
                </div>
                
                </form> 
                <br/><br/>
                <div>
                        <a class="btn btn-success btn-sm btn-block " href="education.php" style="text-align:left" role="button">不登陆，直接访问</a>
                </div>
            <?php } ?>
            

        </div>
    </div>

</div>

</div>



  <div class="container" style="color:#424242;padding:10px 8px">
		<div class="col-md-3 col-sm-3" >
				<strong><small>运营方</small></strong><Br/>
				<small>凤凰鸣工作室</small>
                &nbsp;<a href="/site.php"><small>概况</small></a>
                &nbsp;<a href="/contact.php"><small>联系本站</small></a>
                <br/><small>晋ICP备18000834号</small>
		</div>
		<div class="col-md-3 col-sm-3" >
			<address>
				<strong><small>地址</small></strong><Br/>
				<small>孝义市梧桐新区西区教师公寓楼</small>
			</address>
		</div>
		<div class="col-md-3 col-sm-3" >
			<div><strong><small>联系</small></strong></div>
			<div><small>手机/微信：<?php echo SITE_TEL;?></small></div>
			<div><small>qq：<?php echo SITE_QQ;?></small><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo SITE_QQ;?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo SITE_QQ;?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></div>
		</div>


		<div class="col-md-3 col-sm-3 " >
            <table style="background:transparent"><tr>
                    <td style="vertical-align:top;">
                            <strong><small>手机端：</strong><br/>请使用手机浏览器访问</br>微信公众号暂未营运</small>
                    </td>
            </tr></table>

		</div>

	</div>

<?php
    if(isset($stmt)){
        mysqli_stmt_close($stmt);
    }
    if(isset($conn)){
        mysqli_close($conn);
    }
?>


<script type="text/javascript">
$(document).ready(function(){
	$("#add_my").click(function(){
		window.open("/contAdd.php?type=my");
	});
    $('#myCarousel').carousel({interval:8000});//每隔8秒自动轮播 
});


</script>
