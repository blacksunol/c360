<?php 
function category($arrPram){
    $table = 'danhmuc';
    $coln = array(
        'danhmuc.id'=>'danhmuc.id',
        'danhmuc.ten'=>'danhmuc.ten',
		'danhmuc.taotrang'=>'danhmuc.taotrang',
        'danhmuc.duyet'=>'danhmuc.duyet',
        'danhmuc.phancap'=>'danhmuc.phancap',
        'danhmuc.sapxep'=>'danhmuc.sapxep',
    );
    
    $sql .= select($table,$coln);
    if($arrPram['act']=='edit'){
        $sql .= ' where danhmuc.id !='.$arrPram['id'];
    }
    $sql .= order('danhmuc.sapxep', 'ASC');
    $query = mysql_query($sql);
    
    $results = array();
    while($data = mysql_fetch_assoc($query)){
        $results[] = $data;
    }
    $items = new recursive($results);
    if($_GET['act'] == 'delete'){
        $result = $items->process($arrParam['id']);
    }else{
        $result = $items->process(0);
    }
    return $result;
}
?>
