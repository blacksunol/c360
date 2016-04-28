<?php
$module = 'news';
switch($_GET['act'])
{
    case "list":
        require("modules/$module/list.php");
        break;
    case "detail":
        require("modules/$module/detail.php");
        break;
    case "page":
        require("modules/$module/page.php");
        break;
    case "contact":
        require("modules/$module/contact.php");
        break;
}
?>