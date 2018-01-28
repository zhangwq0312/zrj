			<div class="row">
			<?php
				while($row = mysqli_fetch_assoc($result)){
			?>
				<div class="col-md-3" >
					<div class="thumbnail">
						<a href="company.php?id=<?php echo $row["id"];?>" target="_blank">
							<img src="<?php echo $row["main_img"];?>" class="img-rounded">
						</a>
						<div class="caption">
							<p><?php echo $row["name"];?></p>
							<p>
							<?php if(!empty($row['tel'])){ ?>
								<i  class="glyphicon glyphicon-phone"  style="color:#999"></i>&nbsp;
							<?php } ?>
							<span class="tel"><?php echo $row["tel"];?></span></p>
						</div>
					 </div>
				</div>
			<?php
				}	
			?>	
			</div>