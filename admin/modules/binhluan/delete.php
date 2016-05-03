<?php
    $table = 'binhluan';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        $str=implode(" , ",$_POST['cid']);
        $where='id IN (' . $str . ')';
        $sql = delete($table). whereIN($where);
        mysql_query($sql);
    }else{
        $sql = delete($table).where(array('id'=>$_GET['id']));
        mysql_query($sql);
    }
    header("location:index.php?module=$module&act=index&pid=".$_GET['pid']);
    exit();
?>
