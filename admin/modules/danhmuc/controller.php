<?php
$module = 'danhmuc';

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
    case "sort":
        require("modules/$module/sort.php");
        break;
}
?>