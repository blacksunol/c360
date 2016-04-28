<?php
$sql = "select * from sanpham where duyet=1 and id=".$_GET['id'];
$data = fetchRow($sql);
if(count($_SESSION["cart"])>0){
    if(array_key_exists($_GET['id'], $_SESSION["cart"])){
        $_SESSION["cart"][$_GET['id']]['quantity'] = $_SESSION["cart"][$_GET['id']]['quantity']+1;
    }else{
        $_SESSION["cart"][$_GET['id']] = array(
            'id'=>$_GET['id'],
            'quantity'=>1,
            'price'=>$data['gia']
        );
    }
}else{
    $_SESSION["cart"][$_GET['id']] = array(
        'id'=>$_GET['id'],
        'quantity'=>1,
        'price'=>$data['gia']
    );
}
header("location:index.php?module=cart&act=viewcart");
exit();
?>
