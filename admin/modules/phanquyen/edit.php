<?php
    $table = 'phanquyen';
    $module = $_GET['module'];
    $sql = select($table,'').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
    if(isset($_POST['submit_frm'])){
        if($_POST['ten']==NULL){
            $error['ten']= "Xin vui lòng nhập tên chức năng";
        }
		if($_POST['module']==NULL){
            $error['module']= "Xin vui lòng nhập tên thư mục";
        }
		if($_POST['action']==NULL){
            $error['action']= "Xin vui lòng nhập tên chức năng";
        }
        $data['ten']=$_POST['ten'];
        if($_POST['ten'] && $_POST['module'] && $_POST['action'])
        {
            $arrSet = array(
                'ten'=>$_POST['ten'],
				'module'=>$_POST['module'],
				'action'=>$_POST['action'],
                'duyet' =>$_POST['duyet'],
                'sapxep'=>$_POST['sapxep'],
				'ngaytao'=>time(),
            );
            if($_GET['act']=='edit'){
                $sql = update($table,$arrSet).where(array('id'=>$_GET['id']));
            }else{
                $sql = insert($table,$arrSet);
            }
            mysql_query($sql);
            if(!empty($_GET['trang'])){
                $page = '&trang='.$_GET['trang'];
            }
            header("location:index.php?module=$module&act=index".$page);
            exit();	
        }
    }
    
?>
<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    require_once ("modules/$module/include/toolbar.php");
                ?>	

                <!-- BEGIN: CONTENT -->
                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>
                    <div class="m">
                        <!-- BEGIN: ELEMENT BOX -->
                        <div id="adminfieldset">
                            <div class="adminheader">Thông tin</div>
                            
                            <div id="row">
                                <div class="label">Tên quyền truy cập:</div>
                                <input type="text" name="ten" value="<?php echo $data['ten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['ten'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Thư mục:</div>
                                <input type="text" name="module" value="<?php echo $data['module'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['module'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Chức năng:</div>
                                <input type="text" name="action" value="<?php echo $data['action'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['action'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Duyệt:</div>
                                <input type="radio" name="duyet" value="0" class="radioclass" <?php echo ($data['duyet']==0)?"checked='checked'":""; ?>>Tắt
                                <input type="radio" name="duyet" value="1" class="radioclass" <?php echo ($data['duyet']==1)?"checked='checked'":""; ?>>Bật
                            </div>
                            <div id="row">
                                <div class="label">Sắp xếp:</div>
                                <input type="text" name="sapxep" value="<?php echo $data['sapxep'];?>" class="txtlong">
                               
                            </div>
                            <div class="clr"></div>
                        </div>
                        <!-- END: ELEMENT BOX -->	
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>
                <!-- END: 	CONTENT -->
            </form>
            </div>
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>
            