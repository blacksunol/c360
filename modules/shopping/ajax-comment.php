<?php
    include_once '../../define.php';
    $conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $content = $_REQUEST['content'];
	$id_product = $_REQUEST['id_product'];
    $datetime = time();
    if(!empty($fullname) && !empty($email) && !empty($content)){
        $sql="insert into binhluan(hoten,email,noidung,ngaytao,duyet,id_sanpham) 
     values ('$fullname','$email','$content','$datetime','0','$id_product')"; 
        mysql_query($sql);
        $f = array(
                'status' => true,
                'captcha'=>"Dữ liệu đúng",
            );
    }else{
        $f = array(
                'status' => false,
                'captcha'=>"Dữ liệu sai",
            );
    }
    echo json_encode($f);
    exit();
?>