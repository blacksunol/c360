<?php
	require('../../../define.php');
    $conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
    require('../../../helper/model.php');
    
    @unlink(FILE_PATH.'/news/'.$_GET['file']);
    $sql = update('hinhanh',array('hinhanh'=>'')).  where(array('id'=>$_GET['id']));
    mysql_query($sql);
?>