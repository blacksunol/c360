<?php
    include_once '../../define.php';
    $conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
	$error = array();
    $fullname = $_REQUEST['fullname'];	
	if(empty($fullname)){
		$error['fullname'] = 'Vui lòng nhập họ tên';
	}
    $email = $_REQUEST['email'];
	if(empty($email)){
		$error['email'] = 'Vui lòng nhập email';
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error['email'] = 'Email không hợp lệ';
	}
    $content = $_REQUEST['content'];
	if(empty($email)){
		$error['content'] = 'Vui lòng nhập nội dung';
	}
	$id_product = $_REQUEST['id_product'];
    $datetime = time();
	
    if(count($error)==0){
        $sql="insert into binhluan(hoten,email,noidung,ngaytao,duyet,id_sanpham) 
     values ('$fullname','$email','$content','$datetime','0','$id_product')"; 
        mysql_query($sql);
		
		$file = curl_init(APPLICATION_URL."/modules/shopping/ajax_comment_html.php?id=".$_REQUEST['id_product']);
		curl_setopt($file, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($file, CURLOPT_HEADER, 0);
		$file = curl_exec($file);
        $f = array(
                'status' => true,
                'messg'=>"Bình luận thành công",
				'html'=>$file
            );
    }else{
        $f = array(
                'status' => false,
                'messg'=>"Dữ liệu sai",
            );
    }
    echo json_encode($f);
    exit();
?>