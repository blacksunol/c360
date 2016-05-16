<?php
$module = 'shopping';
switch($_GET['act'])
{
    case "list":
        require("modules/$module/list.php");
        break;
    case "detail":
        require("modules/$module/detail.php");
        break;
    case "search":
        require("modules/$module/search.php");
        break;
    case "vote":
        require("modules/$module/vote.php");
        break;
    case "topview":
        require("modules/$module/topview.php");
        break;
}
?>