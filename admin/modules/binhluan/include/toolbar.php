<?php
    $action = $_GET['act'];
    $module = $_GET['module'];
    $id = $_GET['id'];
    
    $lnkNew = "index.php?module=$module&act=add&pid=".$_GET['pid'];
    $btnNew = cmsButton('Thêm',$lnkNew);
    
    $lnkActive = "index.php?module=$module&act=status&type=multi&s=0&pid=".$_GET['pid'];
    $btnActive = cmsButton('Bật',$lnkActive,array('icon'=>'icon-32-active.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkInactive = "index.php?module=$module&act=status&type=multi&s=1&pid=".$_GET['pid'];
    $btnInactive = cmsButton('Tắt',$lnkInactive,array('icon'=>'icon-32-inactive.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkDelete = "index.php?module=$module&act=delete&type=multi&pid=".$_GET['pid'];
    $btnDelete = cmsButton('Xóa',$lnkDelete,array('icon'=>'icon-32-delete.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa không?')) return false;"),array('type'=>'submit','name'=>'appForm'));
    if($action=='edit'){
        if(!empty($_GET['trang'])){
            $page = '&trang='.$_GET['trang'];
        }
        $lnkSave = "index.php?module=$module&act=$action&id=$id".$page.'&pid='.$_GET['pid'];
    }else{
        $lnkSave = "index.php?module=$module&act=$action&pid=".$_GET['pid'];
    }
    $btnSave = cmsButton('Lưu',$lnkSave,array('icon'=>'icon-32-save.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkCancel = "index.php?module=$module&act=index&pid=".$_GET['pid'];
	$lnkBack = "index.php?module=sanpham&act=index";
    $btnCancel = cmsButton('Bỏ qua',$lnkCancel,array('icon'=>'icon-32-cancel.png'));
    $btnBack = cmsButton('Trở về',$lnkBack,array('icon'=>'icon-32-back.png'));
    switch ($action){
        case 'add': 
            $strButton =  $btnSave . ' ' . $btnCancel;
            break;

        case 'edit': 
            $strButton =  $btnSave . ' ' . $btnCancel;
            break;

        case 'delete': 
            $strButton =  $btnBack . ' ' . $btnAccept;
            break;

        default: $strButton = $btnBack.' '.$btnActive . ' ' 
                            . $btnInactive . ' ' .$btnNew . ' ' . $btnDelete ;
    }
?>
<div id="toolbar-box">
    <div class="t"><div class="t"><div class="t"></div></div></div>
    <div class="m">
        <div id="toolbar" class="toolbar" >	
            <?php echo $strButton;?>
            <div class="clr"></div>
        </div>
        <div class="header icon-48-install">
        <?php
            switch ($_GET['act']){
                case 'add':
                    $install = "Thêm bình luận";
                    break;
                case 'index':
                    $install = "Danh sách bình luận";
                    break;
                case 'edit':
                    $install = "Sửa bình luận";
                    break;
            }
            echo $install;
        ?>
        </div>

        <div class="clr"></div>
    </div>
    <div class="b"><div class="b"><div class="b"></div></div></div>
</div>
<div class="clr"></div>