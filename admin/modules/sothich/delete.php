<?php
    $table = 'sothich';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        $str=implode(" , ",$_POST['cid']);
        $where='id IN (' . $str . ')';
        $sql = delete($table). whereIN($where);
        mysql_query($sql);
        mysql_query(delete('thanhvien_sothich'). whereIN('id_sothich IN (' . $str . ')'));
    }else{
        $sql = delete($table).where(array('id'=>$_GET['id']));
        mysql_query($sql);
        mysql_query(delete('thanhvien_sothich').where(array('id_sothich'=>$_GET['id'])));
    }
    header("location:index.php?module=$module&act=index");
    exit();
?>
