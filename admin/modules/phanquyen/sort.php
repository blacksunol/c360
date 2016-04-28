<?php
    $table = 'phanquyen';
    $module = $_GET['module'];
    
    foreach ($_POST['cid'] as $key =>$val){
        $where = array('id'=>$val);
        $data = array('sapxep'=>$_POST['sapxep'][$key]);
        $sql = update($table,$data).where($where);
        mysql_query($sql);
    }
    header("location:index.php?module=$module&act=index");
    exit();
?>
