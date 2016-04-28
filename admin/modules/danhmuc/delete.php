<?php
    $table = 'danhmuc';
    $module = $_GET['module'];
    if($_GET['type']=='multi'){
        $sql = select($table,'');
        $query = mysql_query($sql);
        $items = array();
        while($data = mysql_fetch_assoc($query)){
            $items[]= $data;
        }
        		
        $arrDelete = array();
        foreach ($_POST['cid'] as $val){
                $data = new recursive($items);
                $result = $data->process($val);
                $arrDelete[] = $val;
                if(count($result)>0){
                        foreach ($result as $val_1){
                                $arrDelete[] = $val_1['id'];
                        }
                }
        }
        $arrDelete = array_unique($arrDelete);
       
        if(count($arrDelete)>0){
                $ids = implode(',', $arrDelete);
                $where = 'id IN (' . $ids . ')';
                $sql = delete($table). whereIN($where);
                mysql_query($sql);
        }
    }else{
        $sql = select($table,'');
        $query = mysql_query($sql);
        $items = array();
        while($data = mysql_fetch_assoc($query)){
            $items[]= $data;
        }
        $arrdata = new recursive($items);
        $result = $arrdata->process($_GET['id']);
        $result[] = array('id'=>$_GET['id']);
        foreach ($result as $key => $val){
            $sql = delete($table).where(array('id'=>$val['id']));
            mysql_query($sql);
        }
    }
    header("location:index.php?module=$module&act=index");
    exit();
?>
