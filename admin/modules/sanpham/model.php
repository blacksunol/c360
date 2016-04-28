<?php
    
    $query = mysql_query("select danhmuc.id,danhmuc.ten,danhmuc.duyet,danhmuc.phancap,danhmuc.sapxep 
        from danhmuc order by danhmuc.sapxep ASC");
    $results = array();
    while($data = mysql_fetch_assoc($query)){
        $results[] = $data;
    }
    $items = new recursive($results);
    $result = $items->process(0);
?>
