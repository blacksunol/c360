<?php
    require('../../config/connect.php');
    $title = $_REQUEST['title'];
    $phone = $_REQUEST['phone'];
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $content = $_REQUEST['content'];
    $address =$_REQUEST['address'];
    $datetime = time();
    if(!empty($title) && !empty($phone) && !empty($fullname) && !empty($email) && !empty($content) && !empty($address)){
        $sql="insert into lienhe(hoten,dienthoai,diachi,email,tieude,noidung,ngaytao,sapxep,duyet) 
     values ('$fullname','$phone','$address','$email','$title','$content','$datetime','10','0')"; 
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