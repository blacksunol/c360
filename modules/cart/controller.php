<?php
$module = 'cart';
switch($_GET['act'])
{
    case "addcart":
        require("modules/$module/addcart.php");
        break;
    case "update":
        require("modules/$module/update.php");
        break;
    case "viewcart":
        require("modules/$module/viewcart.php");
        break;
    case "order":
        require("modules/$module/order.php");
        break;
    case "order-success":
        require("modules/$module/order-success.php");
        break;
    case "delete":
        require("modules/$module/delete.php");
        break;
    case "listorder":
        require("modules/$module/listorder.php");
        break;
    case "detailorder":
        require("modules/$module/detailorder.php");
        break;
}
?>