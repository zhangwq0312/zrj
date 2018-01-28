<?php require_once dirname(__FILE__) . '/common/function.php';?>
<?php require dirname(__FILE__) . '/include/db.php';?>
<?php if(!isMobile()){?>
    <?php require dirname(__FILE__) . '/index_pc.php';?>   
<?php }else { ?>
   <?php require dirname(__FILE__) . '/index_mobile.php';?>
<?php } ?>

