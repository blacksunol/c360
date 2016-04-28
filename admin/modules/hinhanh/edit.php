<?php
    $table = 'hinhanh';
    $module = $_GET['module'];
    
    $sql = select($table,'').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
    
    if(isset($_POST['submit_frm'])){
        if($_POST['ten']==NULL){
            $error['ten']= "Xin vui lòng nhập tên hình";
        }
        
        if($_FILES['img']['name'] != NULL){
            $img=$_FILES['img']['name'];
            preg_match('#\.[^.]+$#', $img,$match);
            
            $arrType = array('.jpg','.png');
           
            if(in_array($match[0],$arrType)){
                $img = time().$match[0];
                move_uploaded_file($_FILES['img']['tmp_name'],FILE_PATH."/news/".$img);
                if($_GET['act']=='edit'){
                    $file_curr =  $_POST['current_img'];
                    @unlink(FILE_PATH.'/news/'.$file_curr);
                }
            }else{
                $error['img']= "Chỉ được upload hình .jpg, .png";
            }
        }
        $data['ten']=$_POST['ten'];
        if($_POST['ten'] && empty($error['img'])){
            if(!empty($img)){
                $arrSet = array(
                    'ten'=>$_POST['ten'],
                    'hinhanh' =>$img,
                    'duyet' =>$_POST['duyet'],
                    'ngaytao'=>time(),
                    'sapxep'=>$_POST['sapxep'],
					'vitri'=>$_POST['vitri'],
                );
            }else{
                $arrSet = array(
                    'ten'=>$_POST['ten'],
                    'duyet' =>$_POST['duyet'],
                    'ngaytao'=>time(),
                    'sapxep'=>$_POST['sapxep'],
					'vitri'=>$_POST['vitri'],
                );
            }
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
<script type="text/javascript">
    function loadPage(area, url){
        $(area).load(url);
    }
</script>
<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
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
                                <div class="label">Hình:</div>
                                <input type="file" name="img" size="50" >
                                <input type="hidden" name='current_img' value="<?php echo $data['picture'];?>"/>
                                <div class="erro_form"><?php echo $error['img'];?></div>
                            
                            <?php
                                if(!empty($data['hinhanh'])){
                                    $linkRemove = APPLICATION_URL.'/admin/modules/hinhanh/removePic.php?id='.$_GET['id'].'&file='.$data['hinhanh'];
                            ?>
                                <div id="load-content">
                                    <?php if(!empty($error['img'])){?><div class="labeld"></div><?php }?>
                                    <img src="<?php echo FILE_URL.'/news/'.$data['hinhanh']; ?>" height="100"/>
                                    <br><div class="labeld"></div><a href="javascript:loadPage('div#load-content','<?php echo $linkRemove;?>')">Xóa</a>
                                </div>
                            <?php
                                }
                            ?>
                            </div>
                            <div id="row">
                                <div class="label">Vị trí: </div>
                                <div>
                                    <select name="vitri">
                                        <option value="0">Chọn vị trí</option>
                                        <option value="1" <?php echo ($data['vitri']==1)?'selected="selected"':'';?>>Banner</option>
                                        <option value="3" <?php echo ($data['vitri']==3)?'selected="selected"':'';?>>Logo</option>
                                    </select>
                                    <div class="erro_form"><?php echo $error['vitri'];?></div>
                                </div>
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
            