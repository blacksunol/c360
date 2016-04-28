<?php
    require('../../../config/connect.php');
    require('../../../helper/model.php');
    require('../../../define.php');
    @unlink(FILE_PATH.'/news/'.$_GET['file']);
    $sql = update('hinhanh',array('hinhanh'=>'')).  where(array('id'=>$_GET['id']));
    mysql_query($sql);
?>