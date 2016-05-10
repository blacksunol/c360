<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	if($_GET['module']=='shopping' && $_GET['act']=='detail'){
		$sql = "select * from sanpham where duyet=1 and id=".$_GET['id'];
    	$data = fetchRow($sql);
		$title = $data['ten'];
		$info = remove_all_html($data['thongtin']);
		if(!empty($data['hinhanh'])){
			$hinhanh = json_decode($data['hinhanh'],true);
			$hinh = $hinhanh[0];	
		}
?>
		<meta property="og:title" content="<?php echo $title;?>"/>
        <meta property="og:image" content="<?php echo FILE_URL.'/product/'.$hinhanh[0];?>" />
        <meta property="og:description" content="<?php echo $info;?>" />
<?php
	}else{
		$title= "Cá cảnh";
		$info = "Cá cảnh";
	}
?>

<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $info;?>" />
<meta name="keywords" content="<?php echo $info;?>" />

<script>
var baseUrl = '<?php echo APPLICATION_URL; ?>';
var TEMPLATE_URL = '<?php echo TEMPLATE_URL;?>';
</script>
<link href="<?php echo TEMPLATE_URL;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL;?>/css/menungang.css" rel="stylesheet" type="text/css" />
<script src="<?php echo TEMPLATE_URL;?>/js/jquery.min-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL;?>/js/menungang.js" type="text/javascript"></script>

<link href="<?php echo TEMPLATE_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css" >
<link href="<?php echo TEMPLATE_URL;?>/css/product.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL;?>/css/panigator.css" rel="stylesheet" type="text/css" />

<script src="<?php echo TEMPLATE_URL;?>/js/tabcontent.js" type="text/javascript"></script>
<link href="<?php echo TEMPLATE_URL;?>/css/tabcontent.css" rel="stylesheet" type="text/css" />

<script src="<?php echo TEMPLATE_URL;?>/js/resize.picture.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL;?>/js/ajax.js" type="text/javascript" language="javascript"></script>
<link href="<?php echo TEMPLATE_URL;?>/css/listnews.css" media="screen" rel="stylesheet" type="text/css" >

<link href="<?php echo TEMPLATE_URL;?>/css/lightbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/lightbox.js"></script>
<link href="<?php echo TEMPLATE_URL;?>/css/form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/contact.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/comment.js"></script>

<link href="<?php echo TEMPLATE_URL;?>/css/viewcart.css" rel="stylesheet" type="text/css" >
<script src="<?php echo TEMPLATE_URL;?>/js/jquery.jcarousellite.min.js"></script>
<link href="<?php echo TEMPLATE_URL;?>/css/jcarousellite.css" rel="stylesheet" type="text/css" >

<style>
body{
	background:#b6c71e;
}
</style>
</head>

<body>
<div class="loading_warning"></div>
<div class="header">   
    <div class="banner" align="center">
        <?php
            $sql = "select * from hinhanh where duyet=1 and vitri=1";
            $query = mysql_query($sql);
            $banner = mysql_fetch_assoc($query);
            if(!empty($banner['hinhanh'])){
        ?>
    	<img src="<?php echo FILE_URL.'/news/'.$banner['hinhanh']; ?>"/>
        <?php
            }
        ?>
    </div>
</div>
<div class="clr"></div>
<div class="braind">
    
	<script type="text/javascript">
            jQuery(document).ready(function() {
                var objMenu = eval('');
                var liName = 'liMenu_' + '';
                jQuery("li#" + liName + " a:first").addClass("active_menu");
                for(x in objMenu){
                        var ulName = 'ulGroup_' + objMenu[x];
                        jQuery("ul#" + ulName).show();
                }
            });
        </script>
<?php
    function createMenu($sourceArr,$parents =0, $viewObj ){
        recursiveMenu($sourceArr,$parents = 0,$newMenu,$viewObj);
        return str_replace('<ul></ul>','',$newMenu);
    }
    function recursiveMenu($sourceArr,$parents = 0,&$newMenu, $viewObj){
        if(count($sourceArr)>0){
            $idUL = 'ulGroup_' . $parents;
            if($parents==0){
                $newMenu .= '<ul class="nav">';
            }
            if($parents!=0){
                $newMenu .= '<ul>';
            }
			
            $i=0;
			
            foreach ($sourceArr as $key => $value){
                switch ($value['taotrang']){
                    case 1:
                        $link = '';
                        break;
                    case 2:
                        $link = 'index.php?module=shopping&act=list&cid='.$value['id'];
                        break;
                    case 3:
                        $link = 'index.php?module=news&act=list&cid='.$value['id'];
                        break;
                    case 4:
                        $link = 'index.php?module=news&act=page&cid='.$value['id'];
                        break;
                    case 5:
                        $link = 'index.php?module=news&act=contact&cid='.$value['id'];
                        break;
                }
                if($value['phancap'] == $parents){
                    $liMenu = 'liMenu_' . $value['id'];
                    $newMenu .= '<li><a href="' .APPLICATION_URL.'/'.$link . '" title="'.$value['ten'].'">' . $value['ten'] . '</a>';				
                    $newParents = $value['id'];
                    unset($sourceArr[$key]);
                    recursiveMenu($sourceArr,$newParents, $newMenu, $viewObj);
                    $newMenu .= '</li>';
                    $i++;
                    $newMenu =  str_replace('<ul class="'.$idUL.' ">','',$newMenu);
                }
                
            }
            $newMenu .= '</ul>';
        }
    }
    $sql = "select * from danhmuc where duyet=1 order by sapxep asc";
    $query = mysql_query($sql);
    $result = array();
    while($data = mysql_fetch_assoc($query)){
        $result[] = $data;
    }
    $items = new recursive($result);
    $result = $items->process(0);
    
    $strMenu = createMenu($result,0,$_GET);
    
?>
<div class="menu_ngang">
    <?php echo $strMenu;?>
</div>
    
</div>  
<div class="content">
    <div class="search">
    	<div class="area_inputSearch">
    	<input type="text" name="txtSearch" value="<?php echo $_GET['q'];?>" class="txtInput inputSearch" placeholder="Nhập từ khóa ..."/>
        </div>
        <div class="area_btnSearch">
        <input type="button" name="btn_search" value="Tìm kiếm" class="btn btn_search" />
        </div>
    </div>
    <div class="member" style="display:none">
        <div class="box_register">
            <?php
                if(!empty($_SESSION['username'])){
            ?>
            Chào bạn <span class="wellcome"><?php echo $_SESSION['username'];?></span> |
            <?php
                if(!empty($_SESSION['id_nhom'])){
                    $sql= "select * from nhom where id=".$_SESSION['id_nhom'];
                    $slbNhom  = fetchRow($sql);
                    $quyentruycap = $slbNhom['quyentruycap'];
                    if($quyentruycap ==0 || $quyentruycap ==1){
            ?>
            <a href="<?php echo APPLICATION_URL.'/admin';?>" target="_blank">Admin</a> | 
            <?php 
                    }
                }
            ?>
            <a href="index.php?module=user&act=logout">Thoát</a>
            <?php
                }else{
            ?>
            <a href="index.php?module=user&act=register">Đăng ký</a> |
            <a href="index.php?module=user&act=login">Đăng nhập</a>
            <?php
                }
            ?>

        </div>
    </div>
    <div class="clr"></div>
    <?php
		$sql = "select * from sanpham where duyet=1 order by sapxep asc limit 15";
		$result = fetchAll($sql);
		if(count($result)>0){
	?>
    <div class="custom-container mouseWheelButtons" style="display:none">
        <a href="#" class="prev">&lsaquo;</a>
        <div class="carousel">
            <ul>
            	<?php
					foreach($result as $v){
						$link = 'index.php?module=shopping&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
				?>
                <li><a href="<?php echo $link;?>">
                        <?php
                        if(!empty($v['hinhanh'])){
									$hinhanh = json_decode($v['hinhanh'],true);
							?>
                            <img src="<?php echo FILE_URL.'/product/'.$hinhanh[0]; ?>" border="0"/>
                            <?php
								}
							?></a></li>
                <?php
					}
				?>
            </ul>
        </div>
        <a href="#" class="next">&rsaquo;</a>
        <div class="clr"></div>
    </div>
    <script>
         $(".mouseWheelButtons .carousel").jCarouselLite({
            auto: 800,
            speed: 1000,
            btnNext: ".mouseWheelButtons .next",
            btnPrev: ".mouseWheelButtons .prev",
            mouseWheel: true,
            visible: 6,
            width:100
        });
    </script>
   <?php
   		}
   ?>