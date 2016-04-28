<?php
    require_once 'define.php';
    $connect = mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$connect);
?>