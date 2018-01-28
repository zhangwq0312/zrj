				<table class="table table-hover " >
			<?php
				while($row = mysqli_fetch_assoc($result)){
			?>
				<tr><td style="border:0px ;border-bottom:1px #999 DASHED;padding:0px 5px 0px 25px">
                
					<table style="width:100%;background-color:transparent;">

                    <?php if(!isMobile()){ ?>             
                        <tr>
							<td >
                            <small>
                                <span style="color:#333">
                                    开抢时间：<?php echo $row['publish_start_time']; ?>
                                    <br/>券有效期：<?php echo date('Y-m-d', strtotime($row['start_time'])); ?>~<?php echo date('Y-m-d', strtotime($row['end_time'])); ?>
                                    <br/>详细情况：<?php echo $row["description"]; ?>
                                </span>
							</small>
                            </td>
                           
                            <td style="width:250px;vertical-align:middle; ">
                                <div class="quan-item" id="grab_<?php echo $row["id"]; ?>">
                                    <div class="q-price">
                                        <span style="font: 25px arial;"><?php echo $row["big"]; ?></span>
                                        <span class="q-limit"><?php echo $row["rest_num"]; ?>张</span>
                                   </div>

                                    <div class="q-range">
                                        <div class="txt"><?php echo $row["small"]; ?></div>
                                    </div>

                                </div>
                            </td>
                            
						</tr>
                <?php }else{  ?>	
                        <tr>
                            <td style="text-align:left; ">
                                <div class="quan-item" id="grab_<?php echo $row["id"]; ?>">
                                    <div class="q-price">
                                        <span style="font: 25px arial;"><?php echo $row["big"]; ?></span>
                                        <span class="q-limit"><?php echo $row["rest_num"]; ?>张</span>
                                   </div>

                                    <div class="q-range">
                                        <div class="txt"><?php echo $row["small"]; ?></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
							<td style="padding-bottom:5px;">
                            <small>
                                <span style="color:#333">
                                    开抢时间：<?php echo $row['publish_start_time']; ?>
                                    <br/>券有效期：<?php echo date('Y-m-d', strtotime($row['start_time'])); ?>~<?php echo date('Y-m-d', strtotime($row['end_time'])); ?>
                                    <br/>详细情况：<?php echo $row["description"]; ?>
                                </span>
							</small>
                            </td>
						</tr>
                <?php } ?>	
					</table>
				
				</td></tr>
						<?php
							}	
						?>		
				</table>


				