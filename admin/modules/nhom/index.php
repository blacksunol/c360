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
                                    <th width="120">Quyền truy cập</th>
                                    <th width="89">Duyệt</th>
                                    <th width="86">Sắp xếp</th>	
                                    <th width="90">Chức năng</th>
                                    <th width="34">ID</th>
                                </tr>
                            </thead>
                            <?php
				$result = caegory($_GET);		
                                if(count($result)>0){
                                  foreach($result as $k=>$data){ 
                                        
                            ?>
                            <tr class="even">						
                                <td align="center"><input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" ></td>
                                <td align="left"><?php echo $data['ten'];?></td>
                                
                                <td align="center">
                                    <?php
                                        switch ($data['quyentruycap']){
                                            case 0:
                                                echo "Toàn quyền admin";
                                                break;
                                            case 1:
                                                echo "Giới hạn admin";
                                                break;
                                            case 2:
                                                echo "Không vào admin";
                                                break;
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
                                <td align="center">
                                    <?php
                                        $lnkEdit = "index.php?module=$module&act=edit&id=".$data['id'];
                                        $iconEdit=cmsIcon('Sửa',$lnkEdit,array('icon'=>'icon_edit.png'));

                                        $lnkDel = "index.php?module=$module&act=delete&id=".$data['id'];
                                        $iconDel=cmsIcon('Xóa',$lnkDel,array('icon'=>'icon_del.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa ".$data['ten']." này không?')) return false;"));
                                        
                                        $lnkPermission = "index.php?module=$module&act=permission&id=".$data['id'].$page;
                                        $iconPermission=cmsIcon('Phân quyền',$lnkPermission,array('icon'=>'exclamation.gif'));
                                        $permission='';
                                        if($data['quyentruycap']==1){
                                                $permission = $iconPermission;
                                        }
                                        
                                        echo $strIcon= $permission.' '.$iconEdit.' '.$iconDel;
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
