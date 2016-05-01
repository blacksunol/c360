<?php 
	ob_start();
	require('../../../define.php');
	$conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
    require('../../../helper/model.php');
	
	$sql = select('sanpham','').  where(array('id'=>$_REQUEST['id']));
    $data = fetchRow($sql);
	$hinhanh = json_decode($data['hinhanh'],true);
	
	$result = json_encode(array_diff($hinhanh,array($_REQUEST['file'])));
    @unlink(FILE_PATH.'/product/'.$_REQUEST['file']);
    $sql = update('sanpham',array('hinhanh'=>$result)).  where(array('id'=>$_REQUEST['id']));
    mysql_query($sql);
	
    $file = curl_init(APPLICATION_URL."/admin/modules/sanpham/viewremovePic.php?id=".$_REQUEST['id']);
    curl_setopt($file, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($file, CURLOPT_HEADER, 0);
    $file = curl_exec($file);
    $id = $_REQUEST['id'];
    $f = array(
            'error' => 0,
            'msg' => 'Success',
            'html' => $file
    );
    echo json_encode($f);
    return;
?>