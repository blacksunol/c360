<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    $module = $_GET['module'];
                    require_once ("modules/$module/include/toolbar.php");
                    require_once("model.php");
                ?>

                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>

                    <div class="m">
                        <table class="adminlist">
                            <thead>
                                <tr>
                                    <th width="43" ><input type="checkbox" name="checkbox" id="checkbox" onclick="checkedAll();"></th>
                                    <th>Tên</th>
                                    <th width="120">Trang</th>
                                    <th width="89">Duyệt</th>
                                    <th width="86">Sắp xếp</th>	
                                    <th width="86">Phân cấp</th>
                                    <th width="90">Chức năng</th>
                                    <th width="34">ID</th>
                                </tr>
                            </thead>
                            <?php
				$category = category($_GET);			
                                if(count($category)>0){
                                  foreach($category as $k=>$data){ 
                                        if($data['level'] == 1){
                                            $name = '<div> <strong>+ ' . $data['ten'] . '</strong></div>';
                                        }else{
                                                $x = 25 * ($data['level']-1);
                                                $css = 'padding-left: ' . $x . 'px;';
                                                $name = '<div style="' . $css . '">- ' . $data['ten'] . '</div>';
                                        }
                            ?>
                            <tr class="even">						
                                <td align="center"><input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" ></td>
                                <td align="left"><?php echo $name;?></td>
                                <td align="center">
                                	<?php
										if($data['taotrang']==1){
											echo "Trang chủ";
										}
										if($data['taotrang']==2){
											echo "Trang sản phẩm";
										}
										if($data['taotrang']==3){
											echo "Trang tin tức";
										}
										if($data['taotrang']==4){
											echo "Trang bài viết";
										}
										if($data['taotrang']==5){
											echo "Liên hệ";
										}
									?>
                                </td>
                                <td align="center">
                                    <?php
                                        $attribs= array('icon'=>'inactive.png','iconDir'=>"templates/images/icon/",);
                                        if($data['duyet']==1){
                                                $attribs['icon'] = 'active.png';
                                        }
                                        $lnkStatus="index.php?module=$module&act=status&id=".$data['id']."&s=".$data['duyet'];
                                        echo $status=cmsIcon('Duyệt',$lnkStatus,$attribs);
                                    ?>
                                    
                                </td>

                                <td align="center">
                                    <input type="text" name="sapxep[]" style="width: 30px; text-align: center;" value="<?php echo $data['sapxep'];?>">
                                </td>
                                <td align="center"><?php echo $data['phancap'];?></td>
                                <td align="center">
                                    <?php
                                        $lnkEdit = "index.php?module=$module&act=edit&id=".$data['id'];
                                        $iconEdit=cmsIcon('Sửa',$lnkEdit,array('icon'=>'icon_edit.png'));

                                        $lnkDel = "index.php?module=$module&act=delete&id=".$data['id'];
                                        $iconDel=cmsIcon('Xóa',$lnkDel,array('icon'=>'icon_del.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa ".$data['ten']." này không?')) return false;"));
                                        
                                        echo $strIcon= $iconEdit.' '.$iconDel;
                                    ?>
                                </td>
                                <td align="center"><?php echo $data['id'];?></td>
                            </tr>
                            <?php
                                    }
                                }else{
                            ?>
                            <tr class="even" >
                                    <td colspan='8' align='center'>Chưa có dữ liệu</td>
                            </tr>	
                            <?php
                                }
                            ?>
                            <tfoot>
                                <tr>
                                    <td colspan="9">
                                        <div class="container">
                                            <div class="pagination">
                                                <div class='limit'></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>					
                            </tfoot>				
                        </table>
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>
