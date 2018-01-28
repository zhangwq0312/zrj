<?php
    if(isset($stmt)){
        mysqli_stmt_close($stmt);
    }
    if(isset($conn)){
        mysqli_close($conn);
    }
?>
<?php if(!isMobile()){?>
		<div class="col-md-12 text-center " style="margin-bottom:20px;">
			<span class="N-nav-bottom-copyright"><span class="N-nav-bottom-copyright-icon">&copy;</span> 凤凰鸣工作室</span> 
			<a href="/site.php">概况</a> | 
			<a href="/contact.php">联系本站</a>  
   	  	</div>
<?php } else { ?>
        <div class=" text-center " style="margin-bottom:40px;">
            <span class="N-nav-bottom-copyright"><span class="N-nav-bottom-copyright-icon">&copy;</span> 凤凰鸣工作室</span>  
        </div>
<?php } ?>
    </body>
</html>


