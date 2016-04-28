<?php
    require_once("model.php");
    $table = 'nhom';
    $module = $_GET['module'];
    
    if($_GET['act']=='edit'){
        $sql = select($table,'').  where(array('id'=>$_GET['id']));
        $data = fetchRow($sql);
    }
    if(isset($_POST['submit_frm'])){
        if($_POST['ten']==NULL){
            $error['ten']= "Xin vui lòng nhập tên nhóm";
        }
        
        $data['ten']=$_POST['ten'];
        if($_POST['ten']){
            $arrSet = array(
                'ten'=>$_POST['ten'],
                'ngaytao'=>time(),
                'sapxep'=>$_POST['sapxep'],
                'duyet' =>$_POST['duyet'],
                'quyentruycap'=>$_POST['quyentruycap'],
            );
            if($_GET['act']=='edit'){
                $sql = update($table,$arrSet).where(array('id'=>$_GET['id']));
            }else{
                $sql = insert($table,$arrSet);
            }
            mysql_query($sql);
            header("location:index.php?module=$module&act=index");
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
                                <div class="label">Tên:</div>
                                <input type="text" name="ten" value="<?php echo $data['ten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['ten'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Quyền truy cập :</div>
                                <input type="radio" name="quyentruycap" value="0" class="radioclass" <?php echo ($data['quyentruycap']==0)?"checked='checked'":""; ?>>Toàn quyền vào admin
                               
                                <input type="radio" name="quyentruycap" value="2" class="radioclass" <?php echo ($data['quyentruycap']==2)?"checked='checked'":""; ?>>Không cho phép vào admin
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
            