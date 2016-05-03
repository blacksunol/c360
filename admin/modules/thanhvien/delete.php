<?php
    $table = 'thanhvien';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        $str=implode(" , ",$_POST['cid']);
        mysql_query(delete($table). whereIN('id IN (' . $str . ')'));
        mysql_query(delete('thanhvien_phanquyen'). whereIN('id_thanhvien IN (' . $str . ')'));
        mysql_query(delete('thanhvien_sothich'). whereIN('id_thanhvien IN (' . $str . ')'));
    }else{
        mysql_query(delete($table).where(array('id'=>$_GET['id'])));
        mysql_query(delete('thanhvien_phanquyen').where(array('id_thanhvien'=>$_GET['id'])));
        mysql_query(delete('thanhvien_sothich').where(array('id_thanhvien'=>$_GET['id'])));
    }
    header("location:index.php?module=$module&act=index");
    exit();
?>
