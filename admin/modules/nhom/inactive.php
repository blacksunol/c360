<?php
    require('../../../config/connect.php');
    require('../../../helper/model.php');
    require('../../../define.php');
    if($_REQUEST['type']=='multi'){
        echo json_encode($response);
        exit();
    }else{
        $sql = delete("nhom_phanquyen").where(array('id_nhom'=>$_REQUEST['id_user'],'id_phanquyen' =>$_REQUEST['id_permisssion'],));
        mysql_query($sql);
        //$response['html'] = file_get_contents('html_permission.php');
        echo json_encode($response);
        exit();
    }
?>