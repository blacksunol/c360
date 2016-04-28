<?php
    if($_REQUEST['id_product']>0){
        mysql_query("update `sanpham` set lan_chon=lan_chon + 1,diem_chon=diem_chon + ".$_REQUEST['rating']." where id=".$_REQUEST['id_product']);
        $data = fetchRow("select * from sanpham where duyet=1 and id=".$_REQUEST['id_product']);
        $rating = (@round($data['diem_chon'] / $data['lan_chon'],1)) * 20; 
        $f = array(
            'status'=>'0',
            'message'=>'Thành công',
            'percent'=>$rating
        );
    }else{
        $f = array(
            'status'=>'1',
            'message'=>'Thất bại'
        );
    }
    echo json_encode($f);
    exit();
