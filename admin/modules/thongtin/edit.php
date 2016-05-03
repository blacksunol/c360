<?php
    $table = 'thongtin';
    $module = $_GET['module'];
    $sql = select($table,'').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
    if(isset($_POST['submit_frm'])){
        if($_POST['ten']==NULL){
            $error['ten']= "Xin vui lòng nhập tên";
        }
        if($_POST['ten'])
        {
            $arrSet = array(
                'ten'=>$_POST['ten'],
                'noidung'=>$_POST['noidung'],
                'loai'=>$_POST['loai'],
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
                                <div class="label">Tên:</div>
                                <input type="text" name="ten" value="<?php echo $data['ten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['ten'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Nội dung</div>
                                <div style="margin-left: 175px;">
                                    <textarea style="height:350px; width:100%;"  id="noidung" name="noidung" >
                                        <?php echo showText($data['noidung']);?>
                                    </textarea>
                                </div>		
                            </div>
                            <div id="row">
                                <div class="label">Loại:</div>
                                <select name="loai">
                                    <option value="">Chọn loại</option>
                                    <option value="footer" <?php echo $data['loai']=='footer'?'selected="selected"':'';?>>Footer</option>
                                </select>
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
            