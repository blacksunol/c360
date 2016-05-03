<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý Admin</title>
<script>
    var baseurl= '<?php echo APPLICATION_URL; ?>';    
</script>
<link href="templates/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link href="templates/css/menuTiny.css" rel="stylesheet" type="text/css" />
<link href="templates/css/rounded.css" rel="stylesheet" type="text/css" /> 
<link href="templates/css/general.css" rel="stylesheet" type="text/css" />
<link href="templates/css/icon.css" rel="stylesheet" type="text/css" />
<link href="templates/css/menu.css" rel="stylesheet" type="text/css" />
<link href="templates/css/style.css" rel="stylesheet" type="text/css" />
<link href="templates/css/ui.all.css" rel="stylesheet" type="text/css" />
<link href="templates/css/jquery.datepick.css" rel="stylesheet" type="text/css" />
<link href="templates/css/order.css" rel="stylesheet" type="text/css" />

<link href="templates/css/tabcontent.css" rel="stylesheet" type="text/css" />

<script src="templates/js/jquery-1.7.2.js"></script>  
<script src="templates/js/menuTiny.js" type="text/javascript"></script>
<script src="templates/js/submit.js" type="text/javascript"></script>
<script src="templates/js/jquery.datepick.js" type="text/javascript"></script>
<script src="templates/js/currency.js" type="text/javascript"></script>
<script src="templates/js/tabcontent.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
        $('#popupDatepicker').datepick();
        $('#rateDatepicker').datepick();
        $('#from').datepick();
        $('#to').datepick();
});

</script>

<script src="<?php echo ADMIN_URL;?>/templates/js/tablednd.js" type="text/javascript"></script>
<script src="<?php echo SCRIPT_URL;?>/tiny_mce3/tiny_mce.js" type="text/javascript"></script>
<script src="<?php echo SCRIPT_URL;?>/tiny_mce3/tiny_mce_init.js" type="text/javascript"></script>
<script>
    tinyMCE.settings.script_image_upload="<?php echo SCRIPT_URL;?>/tiny_mce3/uploadplugin.php";
</script>
<link href="templates/css/permisssion.css" rel="stylesheet" type="text/css" />
<script src="templates/js/permisssion.js" type="text/javascript"></script>
</head>
    
<body id="minwidth-body">
    <div id="border-top" class="h_green">
        <div>
            <div>
                <span class="version">Version 1.0 Alpha</span>
                <span class="title" style="padding-left:20px">Quản lý admin</span>
            </div>
        </div>
    </div>
    <div id="header-box">
        <div id="module-status">
            <span class="preview"><a target="_blank" href="<?php echo APPLICATION_URL;?>">Xem</a></span>
            <a href="#"><span class="no-unread-messages">0</span></a>
            <span class="loggedin-users">1</span>
            <span class="logout"><a href="logout.php">Thoát</a></span>
        </div>
        <div id="module-menu">
            <ul class="menuTiny" id="menuTiny">
                <li><a href="#" class="menuTinyLink">Mục chính</a>
                    <ul>
                        <li><a href="<?php echo APPLICATION_URL;?>" target="_blank">Trang ngoài</a></li>
                        <li><a href="<?php echo ADMIN_URL;?>">Trang admin</a></li>
                    </ul>
                </li>
                <li><a href="#" class="menuTinyLink">Thành viên</a>
                    <ul>
                        <li><a href="index.php?module=nhom&act=index">Nhóm</a></li>
                        <li><a href="index.php?module=thanhvien&act=index">Thành viên</a></li>
                        <li><a href="index.php?module=sothich&act=index">Sở thích</a></li>
                   </ul>
                </li>
                <li><a href="#" class="menuTinyLink">Quản lý nội dung</a>
                    <ul>
                        <li><a href="index.php?module=danhmuc&act=index">Quản lý danh mục</a></li>
                        <li><a href="index.php?module=sanpham&act=index">Quản lý sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#" class="menuTinyLink">Thông tin chung</a>
                    <ul>
                        <li><a href="index.php?module=hinhanh&act=index">Quản lý hình</a></li>
                        <li><a href="index.php?module=thongtin&act=index">Thông tin chung</a></li>
                    </ul>
                </li>
            </ul>
            <script type="text/javascript">
                var menu=new menu.dd("menu");
                menu.init("menuTiny","menuTinyHover");
            </script>			
        </div>
        <div class="clr"></div>
    </div>

       