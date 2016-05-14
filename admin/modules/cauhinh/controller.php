<?php
$module = 'cauhinh';
switch($_GET['act'])
{
    case "edit":
        require("modules/$module/edit.php");
        break;
}
?>