	<table class="table table-hover" >
			<?php		
				while($row = mysqli_fetch_assoc($result)){
			?>
	<tr><td style="border:0px ;border-bottom:1px #999 DASHED;">
			<span class="model_title" <?php if($row['sex']==1){echo "style='color:#04a4b8'";}else{echo "style='color:#bb4444'";} ?> >
				<?php if($row['sex']==1){echo "男，";}else{echo "女，";} ?>
				<?php if(!empty($row['age'])){echo $row['age']."岁，";} ?>
				<?php if(!empty($row['education'])){echo htmlspecialchars($row['education'])."，";} ?>
				<?php if(!empty($row['address'])){echo htmlspecialchars($row['address'])."，";} ?>		
				<?php if(!empty($row['job'])){echo htmlspecialchars($row['job']);} ?>	
				<?php if(!empty($row['photo'])&&$row['photo']==1){?>
					<span data-toggle="tooltip2" data-placement="right" title="请联系客服查看相片" style='color:orange'><i class='glyphicon glyphicon-picture'></i></span>
				<?php } ?>
				
			</span><br/>
			<small><?php if(!empty($row['message'])){echo "自我评价：".htmlspecialchars($row['message']);} ?></small>	
	</td></tr>
			<?php
				}	
			?>		
	</table>