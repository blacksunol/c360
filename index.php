<?php
ini_set('display_errors', 0);
error_reporting ('E_ALL');//E_NOTICE //E_ALL
ob_start();
session_start();
require('config/connect_home.php');
require_once('define.php');
require_once(APPLICATION_PATH."/helper/string.php");
require_once(APPLICATION_PATH."/helper/recursive.php");
require_once(APPLICATION_PATH."/helper/phantrang.php");
require_once(APPLICATION_PATH."/helper/model.php");
if($_REQUEST['ajax']==1){
    switch($_GET['module']){
        case "shopping":
            require("modules/shopping/controller.php");
            break;
    }
}else{
    require_once("templates/include/header.php");
    switch($_GET['module']){
        case "shopping":
            require("modules/shopping/controller.php");
            break;
        case "user":
            require("modules/user/controller.php");
            break;
        default:
            require_once("templates/include/main.php");
    }
    require_once("templates/include/left.php");
    require_once("templates/include/footer.php");
}
ob_end_flush();
?>