<?php
    $table = 'hinhanh';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        foreach($_POST['cid'] as $k=>$v){
            
            $sql_img=select($table, array('hinhanh'=>'hinhanh')).  where(array('id'=>$v));
            $query_img = mysql_query($sql_img);
            while($data = mysql_fetch_assoc($query_img)){
                @unlink(FILE_PATH.'/news/'.$data['hinhanh']);
            }
        }
                     
        $str=implode(" , ",$_POST['cid']);
        
        $where='id IN (' . $str . ')';
        $sql = delete($table). whereIN($where);
        mysql_query($sql);
    }else{
        $sql_img=select($table, array('hinhanh'=>'hinhanh')).  where(array('id'=>$_GET['id']));
        $query_img = mysql_query($sql_img);
        $data = mysql_fetch_assoc($query_img);
        @unlink(FILE_PATH.'/news/'.$data['hinhanh']);

        $sql = delete($table).where(array('id'=>$_GET['id']));
        mysql_query($sql);
    }
    header("location:index.php?module=$module&act=index");
    exit();
?>
