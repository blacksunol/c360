<?php
ob_start();
session_start();
require('../config/connect.php');
require_once("../define.php");
require_once("../helper/string.php");
require_once("../helper/cmsButton.php");
require_once("../helper/panigation.php");
require_once("../helper/model.php");

require_once("templates/include/header_login.php");
$error='';
if(isset($_POST['submit'])){
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];
        if($user_name && $password){
                $sql = select('thanhvien','').
                        where(array('username'=>$user_name,'password'=>$password,'duyet'=>1));
                $query = mysql_query($sql);
                if(mysql_num_rows($query)==0){
                        $error="Username và Password không chính xác";
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
 <div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" method="post" action="" enctype="multipart/form-data">
                <div id="toolbar-box">
                    <div class="t"><div class="t"><div class="t"></div></div></div>
                    <div class="m">
                        <div id="toolbar" class="toolbar" >	

                            <div class="clr"></div>
                        </div>
                        <div class="header icon-48-install">
                            Login
                        </div>

                        <div class="clr"></div>
                    </div>
                    <div class="b"><div class="b"><div class="b"></div></div></div>
                </div>
                <div class="clr"></div>
                <div id="element-box">
                    <div class="t"><div class="t"><div class="t"></div></div></div>
                    <div class="m">
                        <div id="adminfieldset">
                            <div class="adminheader">Detail</div>
                                <div style="padding-bottom: 5px; color: red;"><?php echo $error;?></div>
                                Username: <input type="text" name="user_name" id="user_name" value="" class="txtmedium">				<br></br>
                                Password : <input type="password" name="password" id="password" value="" class="txtmedium">				<br></br>

                                <input type="submit" name="submit" id="submit" value="Đăng nhập">
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="b"><div class="b"><div class="b"></div></div></div>
                    <div class="clr"></div>
                </div>
            </form>  
            <div class="clr"></div>
        </div>
    </div>
 </div>
<div id="border-bottom"><div><div></div></div></div>
<?php
require_once("templates/include/footer.php");
ob_end_flush();
?>
