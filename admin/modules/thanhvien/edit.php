<?php
    $table = 'thanhvien';
    $module = $_GET['module'];
	$sql = select($table,'').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
    if(isset($_POST['submit_frm'])){
        if($_POST['username']==NULL){
            $error['username']= "Xin vui lòng nhập username";
        }
        $dienthoai=$_POST['dienthoai'];
        $diachi=$_POST['diachi'];
        $email=$_POST['email'];
        $hoten=$_POST['hoten'];
        $username=$_POST['username'];
        $sapxep=$_POST['sapxep'];
        $password=$_POST['password'];
        $duyet=$_POST['duyet'];
        $id_nhom=$_POST['id_nhom'];
        if($username)
        {
            if(!empty($password)){
                $arrSet = array(
                    'username'=>$username,
                    'hoten'=>$hoten,
                    'dienthoai'=>$dienthoai,
                    'diachi'=>$diachi,
                    'email'=>$email,
                    'password'=>$password,
                    'duyet' =>$duyet,
                    'id_nhom'=>$id_nhom,
                    'sapxep'=>$sapxep,
                    'ngaysinh'=>$_POST['ngaysinh'],
                    'gioitinh'=>$_POST['gioitinh'],
                );
            }else{
                $arrSet = array(
                    'hoten'=>$hoten,
                    'dienthoai'=>$dienthoai,
                    'diachi'=>$diachi,
                    'email'=>$email,
                    'username'=>$username,
                    'duyet' =>$duyet,
                    'id_nhom'=>$id_nhom,
                    'sapxep'=>$sapxep,
                    'ngaysinh'=>$_POST['ngaysinh'],
                    'gioitinh'=>$_POST['gioitinh'],
                );
            }
            if($_GET['act']=='edit'){
                $sql = update($table,$arrSet).where(array('id'=>$_GET['id']));
            }else{
                $sql = insert($table,$arrSet);
            }
            mysql_query($sql);
            if($_GET['act']=='add'){
                $id_thanhvien = mysql_insert_id();
            }else{
                $id_thanhvien = $_GET['id'];
            }
            if(count($_POST['sothich'])>0){
                if($_GET['id']>0){
                    mysql_query(delete('thanhvien_sothich').where(array('id_thanhvien'=>$_GET['id'])));
                }
                foreach($_POST['sothich'] as $id_sothich){
                    $arrSet = array(
                        'id_thanhvien'=>$id_thanhvien,
                        'id_sothich'=>$id_sothich,
                    );
                    $sql = insert('thanhvien_sothich',$arrSet);
                    mysql_query($sql);
                }
            }
            if(!empty($_GET['trang'])){
                $page = '&trang='.$_GET['trang'];
            }
            header("location:index.php?module=$module&act=index".$page);
            exit();	
        }
    }
    
?>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/timepicker.css" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/jquery-ui-1.10.3.custom.min.css" />
 <script src="<?php echo TEMPLATE_URL;?>/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>/js/jquery-ui-timepicker-addon.js"></script>
<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    $module = $_GET['module'];
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
                                <div class="label">Nhóm:</div>
                                <select name="id_nhom" id="id_nhom" class="selectboxclass">
                                    <?php
                                        $nhom = fetchAll("select * from nhom");
                                        if(count($nhom)>0){
                                            foreach($nhom as $v){
                                                $giohan = '';
                                                switch ($v['quyentruycap']){
                                                    case 0:
                                                        $giohan = 'Toàn quyền';
                                                        break;
                                                    case 2:
                                                        $giohan = 'Không cho phép';
                                                        break;
                                                }
                                    ?>
                                    <option value="<?php echo $v['id'];?>" <?php echo ($v['id']==$data['id_nhom'])?"selected='selected'":""?>><?php echo $v['ten'].' ('.$giohan.')';?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>				
                            </div>
                            <div class="clr"></div>
                            
                            <div id="row">
                                <div class="label">Tên dăng nhập:</div>
                                <input type="text" name="username" value="<?php echo $data['username'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['username'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Mật khẩu:</div>
                                <input type="password" name="password" value="" class="txtlong">	
                                <div class="erro_form"><?php echo $error['password'];?></div>
                            </div>
                            <div class="clr"></div>
                            <div id="row">
                                <div class="label">Họ tên:</div>
                                <input type="text" name="hoten" value="<?php echo $data['hoten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['hoten'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Điện thoại:</div>
                                <input type="text" name="dienthoai" value="<?php echo $data['dienthoai'];?>" class="txtlong dienthoai">
                                <div class="erro_form"><?php echo $error['dienthoai'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Địa chỉ:</div>
                                <input type="text" name="diachi" value="<?php echo $data['diachi'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['diachi'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Email:</div>
                                <input type="text" name="email" value="<?php echo $data['email'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['email'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Duyệt:</div>
                                <input type="radio" name="duyet" value="0" class="radioclass" <?php echo ($data['duyet']==0)?"checked='checked'":""; ?>>Tắt
                                <input type="radio" name="duyet" value="1" class="radioclass" <?php echo ($data['duyet']==1)?"checked='checked'":""; ?>>Bật
                            </div>
                            <div id="row">
                                <div class="label">Ngày sinh:</div>
                                <input type="text" name="ngaysinh" value="<?php echo $data['ngaysinh'];?>" placeholder="Ngày sinh" title="Ngày sinh" class="width_member ngaysinh">
                            </div>
                            <div id="row">
                                <div class="label">Giới tính:</div>
                                <select name="gioitinh">
                                    <option value="nam" <?php echo $data['gioitinh']=='nam'?'selected="selected"':'';?>>Nam</option>
                                    <option value="nu" <?php echo $data['gioitinh']=='nu'?'selected="selected"':'';?>>Nữ</option>
                                </select>
                            </div>
                            <div id="row">
                                <div class="label">Sở thích:</div>
                                <div class="multi_sothich">
                                    <?php
                                        if($_GET['id']>0){
                                            $sql_sothich = 'select * from thanhvien_sothich where id_thanhvien='.$_GET['id'];
                                            $checksothich = fetchAll($sql_sothich); 
                                        }
                                        $checked_sothich = array();
                                        if(count($checksothich)>0){
                                            foreach($checksothich as $v){
                                                $checked_sothich[$v['id_sothich']] = $v['id_sothich'];
                                            }
                                        }
                                        $sql = "select * from sothich order by sapxep asc";
                                        $sothich = fetchAll($sql); 
                                        if(count($sothich)>0){
                                            foreach($sothich as $v){
                                    ?>
                                    <div class="rows_check">
                                        <input type="checkbox" name="sothich[]" <?php echo ($v['id']==$checked_sothich[$v['id']])?'checked="checked"':'';?> value="<?php echo $v['id'];?>" />
                                        <div class="check_label"><?php echo $v['ten'];?></div>
                                   </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="clr"></div>
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
<script language="javascript">
jQuery(".dienthoai").keydown(function(event) {
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 32 || (event.keyCode == 65 && event.ctrlKey === true) ||(event.keyCode >= 35 && event.keyCode <= 39)) 
    {
        jQuery(this).val(jQuery.trim(jQuery(this).val()));
        return;
        }else {
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault(); 
        }   
    }
});
$('.ngaysinh').datepicker({
    dateFormat: 'dd-mm-yy'
});
</script>