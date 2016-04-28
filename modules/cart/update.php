<?php
$_SESSION["cart"];
if(count($_POST['itemProduct'])>0){
    foreach($_POST['itemProduct'] as $k=> $v){
        $_SESSION["cart"][$k]['quantity']=$v;
        if($_SESSION["cart"][$k]['quantity']==0 || !is_numeric($_SESSION["cart"][$k]['quantity'])){
            unset($_SESSION["cart"][$k]);
        }
    }
}

header("location:index.php?module=cart&act=viewcart");
exit();
?>
