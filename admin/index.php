<?php

ob_start();
session_start();
require_once("../define.php");
require(APPLICATION_PATH . '/config/connect.php');
require_once(APPLICATION_PATH . "/helper/string.php");
require_once(APPLICATION_PATH . "/helper/cmsButton.php");
require_once(APPLICATION_PATH . "/helper/panigation.php");
require_once(APPLICATION_PATH . "/helper/model.php");
require_once(APPLICATION_PATH . "/helper/recursive.php");
require_once(APPLICATION_PATH . "/helper/cmsSelect.php");
if (empty($_SESSION['id_nhom'])) {
    header("location:login.php");
    exit();
} else {
    $sql = "select * from nhom where id=" . $_SESSION['id_nhom'];
    $slbNhom = fetchRow($sql);
    $quyentruycap = $slbNhom['quyentruycap'];
}
if ($quyentruycap == 2) {
    header("location:login.php");
    exit();
}

require_once("templates/include/header.php");



switch ($_GET['module']) {
    case "thanhvien":
        require("modules/thanhvien/controller.php");
        break;
    case "danhmuc":
        require("modules/danhmuc/controller.php");
        break;
    case "sanpham":
        require("modules/sanpham/controller.php");
        break;
    case "hinhanh":
        require("modules/hinhanh/controller.php");
        break;
    case "thongtin":
        require("modules/thongtin/controller.php");
        break;
    case "binhluan":
        require("modules/binhluan/controller.php");
        break;
    case "nhom":
        require("modules/nhom/controller.php");
        break;
    case "sothich":
        require("modules/sothich/controller.php");
        break;
    default:
        require_once("templates/include/main.php");
}
require_once("templates/include/footer.php");
ob_end_flush();
?>
