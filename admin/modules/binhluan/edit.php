<?php
    $table = 'binhluan';
    $module = $_GET['module'];
    $sql = select($table,'').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
    if(isset($_POST['submit_frm'])){
        if($_POST['hoten']==NULL){
            $error['hoten']= "Xin vui lòng nhập họ tên";
        }
        $data['hoten']=$_POST['hoten'];
        if($_POST['hoten'])
        {
            $arrSet = array(
                'hoten'=>$_POST['hoten'],
                'email'=>$_POST['email'],
                'noidung'=>$_POST['noidung'],
                'duyet' =>$_POST['duyet'],
				'id_sanpham'=>$_GET['pid'],
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
            header("location:index.php?module=$module&act=index".$page.'&pid='.$_GET['pid']);
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
                                <div class="label">Họ Tên:</div>
                                <input type="text" name="hoten" value="<?php echo $data['hoten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['hoten'];?></div>
                            </div>
                            
                           <div id="row">
                                <div class="label">Email:</div>
                                <input type="text" name="email" value="<?php echo $data['email'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['email'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Nội dung:</div>
                                <div style="margin-left: 175px;">
                                    <textarea style="height:150px; width:55%;"  id="noidung" name="noidung" class="noeditor" ><?php echo showText($data['noidung']);;?>
                                    </textarea>
                                </div>
                            </div>
                            
                            <div id="row">
                                <div class="label">Duyệt:</div>
                                <input type="radio" name="duyet" value="0" class="radioclass" <?php echo ($data['duyet']==0)?"checked='checked'":""; ?>>Tắt
                                <input type="radio" name="duyet" value="1" class="radioclass" <?php echo ($data['duyet']==1)?"checked='checked'":""; ?>>Bật
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
            