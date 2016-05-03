<?php
    $action = $_GET['act'];
    $module = $_GET['module'];
    $id = $_GET['id'];
    
    $lnkNew = "index.php?module=$module&act=add";
    $btnNew = cmsButton('Thêm',$lnkNew);
    
    $lnkActive = "index.php?module=$module&act=status&type=multi&s=0";
    $btnActive = cmsButton('Bật',$lnkActive,array('icon'=>'icon-32-active.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkInactive = "index.php?module=$module&act=status&type=multi&s=1";
    $btnInactive = cmsButton('Tắt',$lnkInactive,array('icon'=>'icon-32-inactive.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkSort = "index.php?module=$module&act=sort";
    $btnSort = cmsButton('Sắp xếp',$lnkSort,array('icon'=>'icon-32-sort.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkDelete = "index.php?module=$module&act=delete&type=multi";
    $btnDelete = cmsButton('Xóa',$lnkDelete,array('icon'=>'icon-32-delete.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa không?')) return false;"),array('type'=>'submit','name'=>'appForm'));
    if($action=='edit'){
        if(!empty($_GET['trang'])){
            $page = '&trang='.$_GET['trang'];
        }
        $lnkSave = "index.php?module=$module&act=$action&id=$id".$page;
    }else{
        $lnkSave = "index.php?module=$module&act=$action";
    }
    $btnSave = cmsButton('Lưu',$lnkSave,array('icon'=>'icon-32-save.png'),array('type'=>'submit','name'=>'appForm'));
    
    $lnkCancel = "index.php?module=$module&act=index";;
    $btnCancel = cmsButton('Bỏ qua',$lnkCancel,array('icon'=>'icon-32-cancel.png'));
    $btnBack = cmsButton('Trở về',$lnkCancel,array('icon'=>'icon-32-back.png'));
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

        default: $strButton = $btnSort . ' ' . $btnActive . ' ' 
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
                    $install = "Thêm danh mục";
                    break;
                case 'index':
                    $install = "Danh sách danh mục";
                    break;
                case 'edit':
                    $install = "Sửa danh mục";
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