<?php
    session_start(); 
    require_once PUBLIC_PATH.'/scripts/counter/connect.php';
    
    $countsql="select counter from counter";
    $query = mysql_query($countsql);
    $result_counter = mysql_fetch_assoc($query);
    $countrow = $result_counter['counter'];
    
    if (isset($_SESSION['counter']))
    {
            $_SESSION['counter'] = $countrow;
            $counter=$_SESSION['counter'];
    }
    else
    {

            $counter=0;
            if (count($result_counter) > 0)
            {
                    if (strcmp($countrow,'')!=0)
                    {
                            $_SESSION['counter']=$countrow + 1;
                            $counter=$_SESSION['counter'];
                    }
                    $sql = 'UPDATE counter SET counter="'.$counter.'"';
                    mysql_query($sql);

                    // thuc hien update
            }else{
                $sql = 'UPDATE counter SET counter="1"';
                mysql_query($sql);
            }
    }
    return $counter;

?> 