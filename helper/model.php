<?php
function fetchAll($sql){
    $query = mysql_query($sql);
    $result = array();
    while($data = mysql_fetch_assoc($query)){
        $result[] = $data;
    }
    return $result;
}
function fetchRow($sql){
    $query = mysql_query($sql);
    $data = mysql_fetch_assoc($query);
    return $data;
}
function insert($table,$arrFiled){
    
    foreach($arrFiled as $key =>$val){
        $k[] = $key;
        $v[] = "'$val'";
    }
    $feild=implode(",",$k);
    $feild="(".$feild.")";
    
    $values=implode(",",$v);
    $values="(".$values.")";
        
    $sql = ("INSERT INTO ".$table.$feild.' values'.$values);
    return $sql;
}  
function joinInner($name, $cond)
{
    $joinInner = " inner join $name ON $cond";
    return $joinInner;
}
function joinLeft($name, $cond)
{
    $joinLeft = " left join $name ON $cond";
    return $joinLeft;
}
function select($table,$coln){
    if(is_array($coln)){
        foreach($coln as $key =>$val){
            $arr[] = $val;
        }
        $columns=implode(',',$arr);
    }else{
        $columns = '*';
    }
    $select = "select $columns from $table";
    return $select;
}
function order($columns,$sort){
    $order = ' order by '. $columns.' '.$sort;
    return $order;
}
function limit($offset,$limit){
    $limit = " limit $offset,$limit";
    return $limit;
}
function update($table,$arrSet){
    
    if(is_array($arrSet)){
        foreach($arrSet as $key =>$val){
            $arr[] = $key.'="'.$val.'"';
        }
        $set = implode(',',$arr);
    }
    $update = "update $table set $set";
    return $update;
}
function where($arrWhere){
    if(is_array($arrWhere)){
        foreach($arrWhere as $key =>$val){
            $arr[] = $key.'="'.$val.'"';
        }
        $strWhere = implode(' AND ',$arr);
    }
    $where = ' where '.$strWhere;
    return $where;
}
function whereIN($where){
    $whereIN = " where $where";
    return $whereIN;
}
function delete($table){
    $delete = "delete from $table";
    return $delete;
}
?>
