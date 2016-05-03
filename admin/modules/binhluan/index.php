<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    $module = $_GET['module'];
                    $table = 'binhluan as c';
                    require_once ("modules/$module/include/toolbar.php");
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
                                    <th>Họ Tên</th>
                                    <th width="150">Email</th>
                                    <th width="150">Ngày tạo</th>	
                                    <th width="89">Duyệt</th>
                                    <th width="90">Chức năng</th>
                                    <th width="34">ID</th>
                                </tr>
                            </thead>
                            <?php
                                $sql_total=select($table,'');
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
                            
                            
                                $sql = select($table,'').where(array('id_sanpham'=>$_GET['pid'])).order('c.ngaytao', 'DESC').limit($vtbd,$so_gioi_han);
                                $result = mysql_query($sql);
                                if(mysql_num_rows($result)>0){
                                    while($data = mysql_fetch_assoc($result)){
                            ?>
                            <tr class="even">						
                                <td align="center">
                                	<input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" >
                                </td>
                                <td align="left"><?php echo $data['hoten'];?></td>
                                <td align="center"><?php echo $data['email'];?></td>
                                <td align="center"><?php echo gmdate('d/m/Y G:i:s',$data['ngaytao']+7*3600);?></td>
                                <td align="center">
                                    <?php
                                        $attribs= array('icon'=>'inactive.png','iconDir'=>"templates/images/icon/",);
                                        if($data['duyet']==1){
                                                $attribs['icon'] = 'active.png';
                                        }
                                        $lnkStatus="index.php?module=$module&act=status&id=".$data['id']."&s=".$data['duyet'].'&pid='.$_GET['pid'];
                                        echo $status=cmsIcon('Duyệt',$lnkStatus,$attribs);
                                    ?>
                                    
                                </td>
                                <td align="center">
                                    <?php
                                        if(!empty($_GET['trang'])){
                                            $page = '&trang='.$_GET['trang'];
                                        }
                                        $lnkEdit = "index.php?module=$module&act=edit&id=".$data['id'].$page.'&pid='.$_GET['pid'];
                                        $iconEdit=cmsIcon('Sửa',$lnkEdit,array('icon'=>'icon_edit.png'));

                                        $lnkDel = "index.php?module=$module&act=delete&id=".$data['id'].'&pid='.$_GET['pid'];
                                        $iconDel=cmsIcon('Xóa',$lnkDel,array('icon'=>'icon_del.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa ".$data['hoten']." này không?')) return false;"));
                                        
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
