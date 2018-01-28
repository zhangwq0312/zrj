<?php require dirname(__FILE__) . '/include/header.php';?>

<?php header("Cache-Control: max-age=600");//客户端缓存十分钟?> 

 <div class="container">
     
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
      <?php require dirname(__FILE__) . '/include/footer.php';?>
</div>




<script type="text/javascript">
$(document).ready(function(){
	$("#add_my").click(function(){
		window.open("/contAdd.php?type=my");
	});
    $('#myCarousel').carousel({interval:8000});//每隔8秒自动轮播 
});


</script>
