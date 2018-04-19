<?php
        if(empty($_SESSION['tel'])){
                header("location: /login.php?refer=".$_SERVER['REQUEST_URI']);exit;
        }
?>

