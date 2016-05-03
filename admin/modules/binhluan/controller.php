<?php
$module = 'binhluan';
switch($_GET['act'])
{
    case "index":
        require("modules/$module/index.php");
        break;
    case "add":
        require("modules/$module/edit.php");
        break;
    case "edit":
        require("modules/$module/edit.php");
        break;
    case "delete":
        require("modules/$module/delete.php");
        break;
    case "status":
        require("modules/$module/status.php");
        break;
}
?>