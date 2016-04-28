<?php
    $table = 'sanpham';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        
        $status = ($_GET['s']== 0 )? 1:0;
        $arrSet = array(
            'duyet'=>$status,
        );
        
        $ids = implode(',', $_POST['cid']);
        $where='id IN (' . $ids . ')';
        
        $sql = update($table,$arrSet).whereIN($where);
        mysql_query($sql);
        
        
    }else{
        $status = ($_GET['s']== 0 )? 1:0;
        $arrSet = array(
            'duyet'=>$status,
        );
        $where = array('id'=>$_GET['id']);
        $sql = update($table,$arrSet).where($where);
        mysql_query($sql);
        
    }
    header("location:index.php?module=$module&act=index");
    exit();

?>
