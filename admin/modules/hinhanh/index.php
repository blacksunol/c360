<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    $module = $_GET['module'];
                    
                    require_once ("modules/$module/include/toolbar.php");
                ?>

                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>

                    <div class="m">
                        <div style="float:right;"> </div>
                        <table class="adminlist">
                            <thead>
                                <tr>
                                    <th width="43" ><input type="checkbox" name="checkbox" id="checkbox" onclick="checkedAll();"></th>
                                    <th>Tên</th>
                                    <th width="50">Hình ảnh</th>
                                    <th width="100">Vị trí</th>
                                    <th width="89">Duyệt</th>
                                    <th width="86">Sắp xếp</th>	
                                    <th width="90">Chức năng</th>
                                    <th width="34">ID</th>
                                </tr>
                            </thead>
                            <?php
                                $table = 'hinhanh as a';
                                $sql_total =select($table,'');
                                $query_total=mysql_query($sql_total);
                                $total=mysql_num_rows($query_total);

                                $ssp_td=5;
                                $sd=2;
                                $so_gioi_han=$ssp_td*$sd;
                                if($_GET['trang']=="")
                                {
                                    $vtbd=0;
                                }
                                else 
                                {
                                    $vtbd=($_GET['trang']-1)*$so_gioi_han;
                                }
                                $st=ceil($total/$so_gioi_han);
                            
                            
                                $coln = array(
                                    'id'=>'a.id',
                                    'ten'=>'a.ten',
									'hinhanh'=>'a.hinhanh',
                                    'duyet'=>'a.duyet',
                                    'sapxep'=>'a.sapxep',
									'vitri'=>'a.vitri',
                                );
                                $sql = select($table,$coln);
                                $sql .= order('a.sapxep', 'ASC');
                                $sql .= limit($vtbd,$so_gioi_han);
                                  
                                $resulti = mysql_query($sql);
                                
                                $arrdata = array();
                                while($itemsi = mysql_fetch_assoc($resulti)){
                                    $arrdata[] = $itemsi;
                                }
                                if(count($arrdata)>0){
                                    foreach($arrdata as $k=>$data){
                            ?>
                            <tr class="even">						
                                <td align="center"><input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" ></td>
                                <td align="left"><?php echo $data['ten'];?></td>
                                
                                <td align="center">
                                    <?php
                                    if(!empty($data['hinhanh'])){
                                    ?>
                                    <img src="<?php echo FILE_URL.'/news/'.$data['hinhanh'];?>" height="30"/>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <?php
                                        if($data['vitri']==1){
                                                echo "Banner";
                                        }
                                        if($data['vitri']==2){
                                                echo "Slideshow";
                                        }
                                        if($data['vitri']==3){
                                                echo "Logo";
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
                                        if(!empty($_GET['trang'])){
                                            $page = '&trang='.$_GET['trang'];
                                        }
                                        $lnkEdit = "index.php?module=$module&act=edit&id=".$data['id'].$page;
                                        $iconEdit=cmsIcon('Sửa',$lnkEdit,array('icon'=>'icon_edit.png'));

                                        $lnkDel = "index.php?module=$module&act=delete&id=".$data['id'];
                                        $iconDel=cmsIcon('Xóa',$lnkDel,array('icon'=>'icon_del.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa ".$data['username']." này không?')) return false;"));
                                        
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
                                                <?php echo ($st>1)?panigation($st):"<div class='limit'></div>";?>
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
