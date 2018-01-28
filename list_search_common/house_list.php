	<table class="table table-hover"  >
			<?php
				while($row = mysqli_fetch_assoc($result)){
			?>
	<tr><td style="border:0px ;border-bottom:1px #999 DASHED;">
			<table  style="width:100%;background-color:transparent">
				<tr>
					<td>
						<span class="model_title">
						<?php 
							if($row['source']=="10"){
								echo "<a target='_blank' href='".$row['url']."' style='color:#ff6700'>".htmlspecialchars($row['title'])."</a>";
							}
							if($row['source']=="20"){
								echo htmlspecialchars($row['title']);
							}
						?>
					
						
						</span>
					</td>
					<?php if(isMobile()){ ?></tr><tr><?php } ?>
					<td style="text-align:right;">
						<?php if(!empty($row['tel'])){ ?>
							<i  class="glyphicon glyphicon-phone"  style="color:#999"></i>&nbsp;
						<?php } ?>
						<span class="tel" style="margin:0px 2px 0px 0px;"><?php echo $row['tel']; ?></span>
					</td>
				</tr>
				<tr>
					<td <?php if(!isMobile()){ ?>colspan="2"<?php } ?>>
						
							<small>
								<?php echo htmlspecialchars($row['house']);?>
							</small>
							<?php 
								if($row['source']=="20"&&!empty($row['description'])){
									echo "<br/><small>描述：".htmlspecialchars($row['description'])."</small>";
								}
							?>
								
							<small class="pull-right">
								<span >发布时间:
								<?php 
									$build_date="";
									if($row['isbefore']=='1'){echo date('Y-m-d',time());}else{echo date('Y-m-d', strtotime($row['build_time']));}
									echo $build_date;
								?>
                                </span>
							</small>
					
					</td>
				</tr>
			</table>

	</td></tr>
			<?php
				}	
			?>		
	</table>