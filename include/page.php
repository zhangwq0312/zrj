			<div class="text-left" >
				<ul class="pagination" style="margin-top: 0px;margin-bottom: 10px;">
					<?php if($page==1){ ?>
					<?php } else{?>
						<li ><a href="#" onclick="page(<?php echo $page-1;?>)">上一页</a></li>
					<?php } ?>
				
					<?php  for($i=1;$i<$count+1;$i++){?>
						<li <?php if($page==$i){echo "class='active'";}?>><a href="#" onclick="page(<?php echo $i;?>)" ><?php echo $i;?></a></li>
					<?php }?>
					<?php if($page<$count){ ?>
						<li><a href="#" onclick="page(<?php echo $page+1;?>)">下一页</a></li>
					<?php } ?>
				</ul>
			</div>