<?php
     require_once("model.php");
    $table = 'sanpham';
    $module = $_GET['module'];
    
    if($_GET['act']=='edit'){
        $sql = select($table,'').  where(array('id'=>$_GET['id']));
        $data = fetchRow($sql);
    }
    if(isset($_POST['submit_frm'])){
        if($_POST['ten']==NULL){
            $error['ten']= "Xin vui lòng nhập tên sản phẩm";
        }
        $data['ten']=$_POST['ten'];
        $data['id_danhmuc']=$_POST['id_danhmuc'];
		$j_hinhanh = '';
		if(count($_FILES['hinhanh'])>0){
			foreach($_FILES['hinhanh']['name'] as $k=>$v){
				$arrHinhanh[$k]['name'] = $v;
				$arrHinhanh[$k]['type'] = $_FILES['hinhanh']['type'][$k];
				$arrHinhanh[$k]['tmp_name'] = $_FILES['hinhanh']['tmp_name'][$k];
				$arrHinhanh[$k]['error'] = $_FILES['hinhanh']['error'][$k];
				$arrHinhanh[$k]['size'] = $_FILES['hinhanh']['size'][$k];
			}
			if($arrHinhanh[0]['name']!=NULL){
				foreach($arrHinhanh as $key=>$hinhanh){
					if($hinhanh['name']!=NULL){
						$img=$hinhanh['name'];
						preg_match('#\.[^.]+$#', $img,$match);
						$arrType = array('.jpg','.png','.gif','.jpeg');
						if(in_array($match[0],$arrType)){
							$arrImg[] = $key.time().$match[0];
						}else{
							$error['img']= "Chỉ được upload hình .jpg, .png";
						}
					}
				}
				if(empty($error['img'])){
					foreach($arrHinhanh as $key=>$hinhanh){
						move_uploaded_file($hinhanh['tmp_name'],FILE_PATH."/product/".$key.time().$match[0]);
					}
				}
				
				if(!empty($data['hinhanh']) && empty($error['img'])){
					$data_hinhanh = json_decode($data['hinhanh'],true);
					$arrHinh = array_merge($arrImg,$data_hinhanh);
				}else{
					$arrHinh = $arrImg;
				}
				$j_hinhanh = json_encode($arrHinh);
			}
		}
        if($_POST['ten'] && empty($error['img']) && $_POST['id_danhmuc']){
            if(!empty($j_hinhanh)){
                $arrSet = array(
                    'ten'=>$_POST['ten'],
                    'hinhanh' =>$j_hinhanh,
                    'duyet' =>$_POST['duyet'],
                    'ngaytao'=>time(),
                    'sapxep'=>$_POST['sapxep'],
                    'thongtin'=>$_POST['thongtin'],
                    'noidung' =>$_POST['noidung'],
                    'id_danhmuc'=>$_POST['id_danhmuc'],
                );
            }else{
                $arrSet = array(
                    'ten'=>$_POST['ten'],
                    'duyet' =>$_POST['duyet'],
                    'ngaytao'=>time(),
                    'sapxep'=>$_POST['sapxep'],
                    'thongtin'=>$_POST['thongtin'],
                    'noidung' =>$_POST['noidung'],
                    'id_danhmuc'=>$_POST['id_danhmuc'],
                );
            }
            if($_GET['act']=='edit'){
                $sql = update($table,$arrSet).where(array('id'=>$_GET['id']));
            }else{
                if($_GET['act']=='add'){
                    $sql = insert($table,$arrSet);
                }
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
<script>
   $(function() {
        $('#addScnt').live('click', function() {
            var html = '<div class="item_rule">';
                    html +='<input type="file" id="p_scnt" name="hinhanh[]"/>';
                    html +='<div id="remScnt" class="btn_remove">Remove</div>';
                    html +='<div class="clr"></div>';
                html +='</div>';
            $(html).appendTo($('#p_scents'));
            return false;
        });
		$('#remScnt').live('click', function() { 
            $(this).parents('div.item_rule').remove();
            return false;
        });
		$('.delete_img').click(function(){
			var file=$(this).attr("rel");
			var id = '<?php echo $_GET['id'];?>';
			var url = '<?php echo APPLICATION_URL;?>/admin/modules/sanpham/removePic.php';
			$.ajax({
				url:url,
				type:"POST",
				data:{file:file,id:id},
				async:false,
				dataType:"json",
				success:function(f){
					if(f.error==0){
						$('.load_img').html(f.html); 
					}
				}
			});
		});
	});
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
                           
                     <div class="tabcontents">
                        <div id="view1" class="tabcontent">   
                            <div id="row">
                                <div class="label">Tên sản phẩm:</div>
                                <input type="text" name="ten" value="<?php echo $data['ten'];?>" class="txtlong">
                                <div class="erro_form"><?php echo $error['tieude'];?></div>
                            </div>
                            <div id="row">
                            	<style>
									.item_rule input{
										float: left;
										padding-right: 5px;
										margin-top:5px;
									}
									.item_rule > .btn_remove{
										float: left;
										margin-top: 10px;
										padding-left:5px;
										cursor: pointer;
										color: green;
									}
								</style>
                                <div class="label">Hình ảnh:</div>
                                <div style="margin-left:175px;">
                                    <div id="addScnt" class="btn btn-success">Thêm hình</div>
                                    <div id="p_scents">
                                       <div class="item_rule">
                                            <input type="file" id="p_scnt" name="hinhanh[]"/>
                                            <div id="remScnt" class="btn_remove">Remove</div>
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                    <div class="erro_form"><?php echo $error['img'];?></div>
                                    <div class="listhinhanh load_img">
                                    	<?php
											$hinhanh = json_decode($data['hinhanh'],true);
											if(count($hinhanh)>0){
												foreach($hinhanh as $k=>$v){
										?>
											<div style="float: left; margin-left: 10px; margin-top: 10px;" id="listItem_<?php echo $v['id'];?>">
												<img src="<?php echo FILE_URL.'/product/'.$v;?>" height="100"/>
												<div class="chucnang" align="center">
												   
												  
														
													<a href="javascript:;" rel="<?php echo $v;?>" class="delete_img" title="Xóa ảnh">
															<img src="<?php echo ADMIN_TEMPLATE_URL?>/images/trash.png" width="16" height="16" border="0"/>
														</a>
												   
												  
												</div>
											</div>		
										<?php
												}
											}
										?>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                            </div>
                           <div id="row">
                                <div class="label">Danh mục:</div>
                                <?php
                                   
                                    $var = array('id'=>0,'ten'=>'Danh mục gốc','level'=>1);
                                    array_unshift($result, $var);
                                    echo $parents = cmsSelect('id_danhmuc',$data['id_danhmuc'],array('size'=>10,'style'=>'200px'),$result);
                                ?>
                                <div class="erro_form" style="margin-left: 175px;"><?php echo $error['id_danhmuc'];?></div>
                            </div>
                            <div id="row">
                                <div class="label">Mô tả</div>
                                <div style="margin-left: 175px;">
                                    <textarea style="height:350px; width:100%;"  id="thongtin" name="thongtin" >
                                        <?php echo showText($data['thongtin']);?>
                                    </textarea>
                                </div>		
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
                                <div class="label">Duyệt:</div>
                                <input type="radio" name="duyet" value="0" class="radioclass" <?php echo ($data['duyet']==0)?"checked='checked'":""; ?>>Tắt
                                <input type="radio" name="duyet" value="1" class="radioclass" <?php echo ($data['duyet']==1)?"checked='checked'":""; ?>>Bật
                            </div>
                            <div id="row">
                                <div class="label">Sắp xếp:</div>
                                <input type="text" name="sapxep" value="<?php echo $data['sapxep'];?>" class="txtlong">
                            </div>
                        </div>
                       
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
            