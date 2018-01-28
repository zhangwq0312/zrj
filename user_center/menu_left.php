<style>
.firstmenu{
	color:#337ab7;
}
.secondmenu a {
	font-size: 14px;
	color: #4A515B;
}
.nav>li>a {
    position: relative;
    display: block;
    /*padding: 10px 5px 10px 30px;*/
}
.nav>li>a:hover {
	background-color:#aaa;
	border-color: #46b8da;
	color:#fff;
}
.menu_active{
	background-color:#5bc0de;
	border-color: #46b8da;
}
.menu_active a{
	color:#fff;
}
</style>	
<?php
if(empty($menu_active)){
	$menu_active="";
}
?>
<div class="col-md-2" >
	<div >
	<ul id="main-nav" class="list-group" >
		<li class="list-group-item" >
			<span href="#" class="firstmenu" >
				<i class="glyphicon glyphicon-envelope"></i>&nbsp;我的收信
			</span>
			<ul id="my_publish" class="nav nav-list  secondmenu" >
				<li <?php if($menu_active=="leave_msg_sys"){echo "class='menu_active'";}?>><a href="./leave_msg_sys.php"><i class="glyphicon glyphicon-volume-up"></i>&nbsp;系统消息</a></li>
				
					<?php
							$sql = "select count(*) count from  zl_company where tel='".$_SESSION['tel']."' and status=0 ";
							$result = mysqli_query($conn,$sql);	
							$row = mysqli_fetch_assoc($result);
							if($row['count']>0){
					?>
				<li <?php if($menu_active=="leave_msg_company"){echo "class='menu_active'";}?>><a href="./leave_msg_company.php"><i class="glyphicon glyphicon-volume-up"></i>&nbsp;商家收信</a></li>
				<?php } ?>
				
			</ul>
		</li>
	
		<li class="list-group-item" >
			<span href="#" class="firstmenu" >
				<i class="glyphicon glyphicon-th-list"></i>&nbsp;我的发帖
			</span>
			<ul id="my_publish" class="nav nav-list  secondmenu" >
				<li <?php if($menu_active=="myPublish_refresh"){echo "class='menu_active'";}?>><a href="./myPublish_refresh.php"><i class="glyphicon glyphicon-refresh"></i>&nbsp;刷新帖子</a></li>
				<li <?php if($menu_active=="myPublish_list"){echo "class='menu_active'";}?>><a href="./myPublish_list.php"><i class="glyphicon glyphicon-trash"></i>&nbsp;删除帖子</a></li>
			</ul>
		</li>

		<li  class="list-group-item">
			<span href="#" class="firstmenu" >
				<i class="glyphicon glyphicon-hourglass"></i>&nbsp;我的资金
			</span>
			<ul id="my_money" class="nav nav-list  secondmenu" >
				<li <?php if($menu_active=="account"){echo "class='menu_active'";}?>><a href="./account.php"><i class="glyphicon glyphicon-duplicate"></i>&nbsp;我的账户余额</a></li>
				<li <?php if($menu_active=="account_add_history"){echo "class='menu_active'";}?>><a href="./account_add_history.php"><i class="glyphicon glyphicon-duplicate"></i>&nbsp;交费历史记录</a></li>
				<li <?php if($menu_active=="account_cut_history"){echo "class='menu_active'";}?>><a href="./account_cut_history.php"><i class="glyphicon glyphicon-duplicate"></i>&nbsp;扣费历史记录</a></li>
			</ul>
		</li>

		<?php
			$sql = "select * from z_coupon where  userid=".$_SESSION['tel'];
           // var_dump($sql);
			$result = mysqli_query($conn,$sql);	
			//$row = mysqli_fetch_assoc($result);
			$rowcount=mysqli_num_rows($result);
			if($rowcount>0){
		?>
			<li  class="list-group-item">
				<span href="#" class="firstmenu" >
					<i class="glyphicon glyphicon-piggy-bank"></i>&nbsp;我的发券
				</span>
				<?php while($row = mysqli_fetch_assoc($result)){ ?>
					<ul id="systemSetting" class="nav nav-list  secondmenu" >
						<li <?php if($menu_active=="coupon_".$row["id"]){echo "class='menu_active'";}?>><a href="./coupon_user.php?coupon_id=<?php echo $row["id"];?>"><i class="glyphicon glyphicon-edit"></i>&nbsp;券名:<?php echo $row["big"]; ?></a></li>
					</ul>
				<?php } ?>
			</li>
		<?php
			}
		?>
        
		<li class="list-group-item" >
			<span href="#" class="firstmenu" >
				<i class="glyphicon glyphicon-duplicate"></i>&nbsp;我的领券
			</span>
			<ul id="my_coupon" class="nav nav-list  secondmenu" >
				<li <?php if($menu_active=="my_coupon"){echo "class='menu_active'";}?>><a href="./my_coupon.php"><i class="glyphicon glyphicon-duplicate"></i>&nbsp;赠品</a></li>
			</ul>
		</li>
        
        
        
		<?php
			$sql = "select * from zl_company where  userid=".$_SESSION['tel'];
			$result = mysqli_query($conn,$sql);	
			//$row = mysqli_fetch_assoc($result);
			$rowcount=mysqli_num_rows($result);
			if($rowcount>0){
		?>
			<li  class="list-group-item">
				<span href="#" class="firstmenu" >
					<i class="glyphicon glyphicon-piggy-bank"></i>&nbsp;商家管理
				</span>
				<?php while($row = mysqli_fetch_assoc($result)){ ?>
					<ul id="systemSetting" class="nav nav-list  secondmenu" >
						<li <?php if($menu_active=="company_".$row["id"]){echo "class='menu_active'";}?>><a href="./company.php?id=<?php echo $row["id"];?>"><i class="glyphicon glyphicon-edit"></i>&nbsp;商家:<?php echo $row["short_name"]; ?></a></li>
					</ul>
				<?php } ?>
			</li>
		<?php
			}
		?>
		
		<li  class="list-group-item">
			<span href="#" class="firstmenu" >
				<i class="glyphicon glyphicon-cog"></i>&nbsp;系统管理
			</span>
			<ul id="systemSetting" class="nav nav-list  secondmenu" >
				<li <?php if($menu_active=="user"){echo "class='menu_active'";}?>><a href="./user.php"><i class="glyphicon glyphicon-user"></i>&nbsp;个人信息</a></li>
					<?php
                        $sql = "select count(*) count from  zl_marriage where tel='".$_SESSION['tel']."' and status=0 limit 1 ";
                        $result = mysqli_query($conn,$sql);	
                        $row = mysqli_fetch_assoc($result);
                        if($row['count']>0){
					?>
                        <li <?php if($menu_active=="marriage_info"){echo "class='menu_active'";}?>><a href="./marriage_info.php"><i class="glyphicon glyphicon-heart"></i>&nbsp;婚恋编辑</a></li>
                    <?php 
                        } 
                    ?>
                <li <?php if($menu_active=="password"){echo "class='menu_active'";}?>><a href="./password.php"><i class="glyphicon glyphicon-edit"></i>&nbsp;修改密码</a></li>
			</ul>
		</li>
	
	</ul>
	</div>
</div>