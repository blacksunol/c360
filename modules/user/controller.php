<?php
$module = 'user';
switch($_GET['act']){
    case "register":
        require("modules/$module/register.php");
        break;
    case "login":
        require("modules/$module/login.php");
        break;
    case "register-success":
        require("modules/$module/register-success.php");
        break;
    case "logout":
        require("modules/$module/logout.php");
        break;
}
?>