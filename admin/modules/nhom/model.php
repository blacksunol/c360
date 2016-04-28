<?php
function caegory($_GET){
    $table = 'nhom';
    $coln = array(
        'nhom.id'=>'nhom.id',
        'nhom.ten'=>'nhom.ten',
        'nhom.quyentruycap'=>'nhom.quyentruycap',
        'nhom.duyet'=>'nhom.duyet',
        'nhom.sapxep'=>'nhom.sapxep',
    );
    
    $sql .= select($table,$coln);
    if($_GET['act']=='edit'){
        $sql .= ' where nhom.id !='.$_GET['id'];
    }
    $sql .= order('nhom.sapxep', 'ASC');
    $query = mysql_query($sql);
    
    $results = array();
    while($data = mysql_fetch_assoc($query)){
        $results[] = $data;
    }
   
    return $results;
}   
?>
