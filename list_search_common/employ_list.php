	<table class="table table-hover" >
			<?php		
				while($row = mysqli_fetch_assoc($result)){
			?>
	<tr><td style="border:0px ;border-bottom:1px #999 DASHED;">
		<table style="width:100%;background-color:transparent">
			<tr>
				<td>
					<span class="model_title"><?php echo htmlspecialchars($row['title']); ?></span>
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
							<?php if($row['leixing']==1){echo "全职";} if($row['leixing']==2){echo "临时工";} ?>
							&nbsp;<?php if($row['sex']==1){echo "不限性别";} if($row['sex']==2){echo "只招男性";} if($row['sex']==3){echo "只招女性";} ?>
							&nbsp;<?php echo "月薪区间：".str_replace("_","~",$row['yuexin']);?>
							&nbsp;<?php echo htmlspecialchars($row['description']);?>
						</small>	
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