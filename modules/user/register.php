<?php
    if(isset($_POST['ok'])){
        if($_POST['hoten']==""){
            $error['hoten'] = 'Vui lòng nhập họ tên';
        }else{
            $hoten = $_POST['hoten'];
        }
        if($_POST['username']==""){
            $error['username'] = 'Vui lòng nhập tên đăng nhập';
        }else{
            $username = $_POST['username'];
        }
        if($_POST['password']==""){
            $error['password'] = 'Vui lòng nhập mật khẩu';
        }else{
            if($_POST['password']!=$_POST['re-password']){
                $error['re-password'] = 'Password và Re-password không giống nhau';
            }else{
                $password = $_POST['password'];
            }
        }
        if($_POST['dienthoai']==""){
            $error['dienthoai'] = 'Vui lòng nhập số điện thoại';
        }else{
            $dienthoai = $_POST['dienthoai'];
        }
        if($_POST['diachi']==""){
            $error['diachi'] = 'Vui lòng nhập địa chỉ';
        }else{
            $diachi = $_POST['diachi'];
        }
        if($_POST['email']==""){
            $error['email'] = 'Vui lòng nhập email';
        }else{
            if ((strpos($_POST['email'], '..') !== false) or (!preg_match('/^(.+)@([^@]+)$/', $_POST['email'], $matches))) {
                $error['email'] = 'Email không hợp lệ';
            }else{
                $email = $_POST['email'];
            }
        }
        
        if($hoten && $username && $password && $dienthoai && $diachi && $email){
            $arrSet = array(
                    'hoten'=>$hoten,
                    'password'=>$password,
                    'dienthoai'=>$dienthoai,
                    'diachi'=>$diachi,
                    'email'=>$email,
                    'username'=>$username,
                    'ngaysinh'=>$_POST['ngaysinh'],
                    'gioitinh'=>$_POST['gioitinh'],
                    'duyet' =>1,
                    'id_nhom'=>7,
                    'sapxep'=>0,
                );
            $sql = insert('thanhvien',$arrSet);
            mysql_query($sql);
            $id_thanhvien = mysql_insert_id();
            if(count($_POST['sothich'])>0){
                foreach($_POST['sothich'] as $id_sothich){
                    $arrSet = array(
                        'id_thanhvien'=>$id_thanhvien,
                        'id_sothich'=>$id_sothich,
                    );
                    $sql = insert('thanhvien_sothich',$arrSet);
                    mysql_query($sql);
                }
            }
            header("location:index.php?module=user&act=register-success");
            exit();
        }
    }
?>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/timepicker.css" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/jquery-ui-1.10.3.custom.min.css" />
 <script src="<?php echo TEMPLATE_URL;?>/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>/js/jquery-ui-timepicker-addon.js"></script>
<div class="partmain">           
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                <h2 class="navigation">Đăng ký</h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            
            <div class="info_page">
               	<div class="form_lienhe">
                        <form enctype="multipart/form-data" method="post">
                            <div id="row">
                                <div class="label">Họ tên:</div>
                                <div class="phuong">
                                    <input type="text" name="hoten" value="<?php echo $_POST['hoten'];?>" placeholder="Họ tên" title="Họ tên" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['hoten'];?></div>
                            </div>
                            <div id="row" class="clr">
                                <div class="label">Tên đăng nhập:</div>
                                <div class="phuong">
                                    <input type="text" name="username" value="<?php echo $_POST['username'];?>" placeholder="Tên đăng nhập" title="Tên đăng nhập" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['username'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Mật khẩu:</div>
                                <div class="phuong">
                                    <input type="password" name="password" value="<?php echo $_POST['password'];?>" placeholder="Mật khẩu" title="Mật khẩu" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['password'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Nhập lại mật khẩu:</div>
                                <div class="phuong">
                                    <input type="password" name="re-password" value="<?php echo $_POST['re-password'];?>" placeholder="Nhập lại mật khẩu" title="Nhập lại mật khẩu" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['re-password'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Điện thoại:</div>
                                <div class="phuong">
                                    <input type="text" name="dienthoai" class="dienthoai width_member" value="<?php echo $_POST['dienthoai'];?>" placeholder="Điện thoại" title="Điện thoại">
                                </div>	
                                <div class="error_member"><?php echo $error['dienthoai'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Địa chỉ:</div>
                                <div class="phuong">
                                    <input type="text" name="diachi" value="<?php echo $_POST['diachi'];?>"  placeholder="Địa chỉ" title="Địa chỉ" class="width_member">
                                </div>	
                                <div class="error_member"><?php echo $error['diachi'];?></div>
                            </div>
                            
                            <div class="clr" id="row">
                                <div class="label">Email:</div>
                                <div class="phuong">
                                    <input type="text" name="email" value="<?php echo $_POST['email'];?>" placeholder="Email" title="Email" class="width_member">
                                </div>	
                                <div class="error_member"><?php echo $error['email'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Ngày sinh:</div>
                                <div class="phuong">
                                    <input type="text" name="ngaysinh" value="<?php echo $_POST['ngaysinh'];?>" placeholder="Ngày sinh" title="Ngày sinh" class="width_member ngaysinh">
                                </div>	
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Giới tính:</div>
                                <div class="phuong">
                                    <select name="gioitinh">
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                    </select>
                                </div>	
                            </div>
                           <div class="clr" id="row">
                                <div class="label">Sở thích:</div>
                                <div class="phuong multi_sothich">
                                    <?php
                                        $sql = "select * from sothich order by sapxep asc";
                                        $sothich = fetchAll($sql); 
                                        if(count($sothich)>0){
                                            foreach($sothich as $v){
                                    ?>
                                    <div class="rows_check">
                                        <input type="checkbox" name="sothich[]" value="<?php echo $v['id'];?>" />
                                        <div class="check_label"><?php echo $v['ten'];?></div>
                                   </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>	
                            </div>
                            <div class="clr"></div>
                            <div id="row" style="margin-top:10px;">
                                <div class="label">&nbsp;</div>
                                <div class="phuong form_btn">
                                    <input type="submit" class="btn btn-primary" value="Đăng ký" name="ok">
                                    <input type="reset" class="btn" value="Hủy" name="huy">
                                </div>		
                            </div>
                        </form>

                    </div>
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
                    </script>
                
                <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>
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