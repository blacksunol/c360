<?php
	require('../../../config/connect.php');
    require('../../../helper/model.php');
    require('../../../define.php');
	if($_REQUEST['type']=='multi'){
		$sql = "select id from phanquyen where module=".$_REQUEST['module'];
		$query = mysql_query($sql);
		while($data = mysql_fetch_assoc($query)){
			$rows[] = $data;
		}
		
		$sql = delete("thanhvien_phanquyen").where(array('id_thanhvien'=>$_REQUEST['id_user'],'module' =>$_REQUEST['module'],));
        mysql_query($sql);
		
		$listModule = array();
		if(count($rows)>0){
			foreach($rows as $v){
				$arrSet = array(
					'id_thanhvien'=>$_REQUEST['id_user'],
					'id_phanquyen' =>$v['id'],
				);
				$sql = insert("thanhvien_phanquyen",$arrSet);
				mysql_query($sql);
			}
		}
		
		echo json_encode($response);
		exit();
	}else{
		$arrSet = array(
			'id_thanhvien'=>$_REQUEST['id_user'],
			'id_phanquyen' =>$_REQUEST['id_permisssion'],
		);
		$sql = insert("thanhvien_phanquyen",$arrSet);
		mysql_query($sql);
		echo json_encode($response);
		exit();
	}
?>