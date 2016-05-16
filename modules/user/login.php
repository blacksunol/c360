<?php
    if(isset($_POST['ok'])){
        if($_POST['username']==""){
            $error['username'] = 'Vui lòng nhập tên đăng nhập';
        }else{
            $username = $_POST['username'];
        }
        if($_POST['password']==""){
            $error['password'] = 'Vui lòng nhập mật khẩu';
        }else{
            $password = $_POST['password'];
        }
        
        if($username && $password){
                $sql = select('thanhvien','').
                        where(array('username'=>$username,'password'=>$password,'duyet'=>1));
                $query = mysql_query($sql);
                if(mysql_num_rows($query)==0){
                        $errorMessage="Username và Password không chính xác";
                }else{
                        $data = mysql_fetch_assoc($query);
                        $_SESSION['id']=$data['id'];
                        $_SESSION['username']=$data['username'];
                        $_SESSION['hoten']=$data['hoten'];
                        $_SESSION['id_nhom']=$data['id_nhom'];
                        header("location:index.php");
                        exit();
                }
        }
    }
?>
<div class="partmain">           
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                <h2 class="navigation">Đăng nhập</h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            
            <div class="info_page">
               	<div class="form_lienhe">
                        <form enctype="multipart/form-data" method="post">
                            
                            <div id="row" class="clr">
                                <div class="label">Tên đăng nhập:</div>
                                <div class="phuong">
                                    <input type="text" name="username" value="" placeholder="Tên đăng nhập" title="Tên đăng nhập" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['username'];?></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Mật khẩu:</div>
                                <div class="phuong">
                                    <input type="password" name="password" value="" placeholder="Mật khẩu" title="Mật khẩu" class="width_member"/>
                                </div>
                                <div class="error_member"><?php echo $error['password'];?></div>
                            </div>
                            <?php echo $errorMessage;?>
                            <div class="clr" id="row">
                                <div class="label">&nbsp;</div>
                                <div class="phuong form_btn">
                                    <input type="submit" class="btn btn-primary" value="Đăng nhập" name="ok">
                                </div>		
                            </div>
                        </form>

                    </div>
                    
                <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>