		<div class="col-md-12 text-right " style="margin-top:10px;margin-bottom:10px;">

            <?php if(empty($_SESSION['tel'])){ ?>
                <a href="/login.php" class="top_right">登录</a> 
                <span  class="top_right">|</span>
                <a href="/register.php" class="top_right">注册</a> 
            <?php }else{ ?>
                <a  href="/user_center/" class="top_right" >
                    <?php if(!empty($_SESSION['ni'])){echo $_SESSION['ni'];} else {echo $_SESSION['tel'];}?>的个人空间
                </a>	
                <span  class="top_right">|</span>
                
                <?php
                    if($locate=="education"||$locate=="tel"||$locate=="house"||$locate=="employ"){
                        $url=$locate."Add.php";
                ?>
                        <a  href="/<?php echo $url; ?>" class="top_right" >
                            免费发布
                        </a>	
                        <span  class="top_right">|</span>
                <?php
                    }
                
                ?>

                <a href="loginout.php?refer=<?php echo $refer?>" class="top_right">退出</a>
            <?php } ?>
             <br/>
        </div>