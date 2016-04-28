<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    if(isset($_POST['go'])){
                        $_SESSION['filter_nhom'] = $_POST['id_nhom'];
                    }
                    $module = $_GET['module'];
                    $table = 'thanhvien as u';
                    require_once ("modules/$module/include/toolbar.php");
                ?>
                
                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>

                    <div class="m">
                        <div style="float:right;">
                            <select name="id_nhom">
                                <option value="0">Chọn nhóm</option>
                                <?php
                                    $slbGroup = fetchAll('select * from nhom');
                                    if(count($slbGroup)>0){
                                        foreach($slbGroup as $v){
                                ?>
                                <option value="<?php echo $v['id'];?>" <?php echo ($v['id']==$_SESSION['filter_nhom'])?'selected="selected"':'';?>><?php echo $v['ten'];?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <input type="submit" name="go" value="Filter" />
                        </div>
                        <table class="adminlist">
                            <thead>
                                <tr>
                                    <th width="43" ><input type="checkbox" name="checkbox" id="checkbox" onclick="checkedAll();"></th>
                                    <th>Tên đăng nhập</th>
                                    <th width="89">Duyệt</th>
                                    <th width="86">Sắp xếp</th>	
                                    <th width="150">Nhóm</th>
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
                            
                            
                                $coln = array(
                                    'id'=>'u.id',
                                    'username'=>'u.username',
                                    'duyet'=>'u.duyet',
                                    'id_nhom'=>'u.id_nhom',
                                    'sapxep'=>'u.sapxep',
                                    'c_ten'=>'c.ten as c_ten',
                                    'quyentruycap'=>'c.quyentruycap'
                                );
                                
                                $slbNhom  = fetchRow("select * from nhom where id=".$_SESSION['id_nhom']);
                                $quyentruycap = $slbNhom['quyentruycap'];

                                $sql = select($table,$coln);
                               $sql .=joinLeft('nhom as c','c.id = u.id_nhom');
                                if($_SESSION['filter_nhom']>0){
                                    $sql .=' where u.id_nhom = '.$_SESSION['filter_nhom'];
                                }
                                if($quyentruycap==1){
                                   $sql .=' where u.id_nhom = '.$_SESSION['id_nhom'];
                                }
                                $sql .=order('u.sapxep', 'ASC').limit($vtbd,$so_gioi_han);
                              
                                $result = mysql_query($sql);
                                if(mysql_num_rows($result)>0){
                                    
                                    while($data = mysql_fetch_assoc($result)){
                            ?>
                            <tr class="even">						
                                <td align="center"><input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" ></td>
                                <td align="left"><?php echo $data['username'];?></td>
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
                                    $giohan = '';
                                    switch ($data['quyentruycap']){
                                        case 0:
                                            $giohan = '<span style="color:red">'.$data['c_ten'].' ('.'Toàn quyền'.')<span>';
                                            break;
                                            break;
                                        case 2:
                                            $giohan = $data['c_ten'].' ('.'Không quyền'.')';
                                            break;
                                    }
                                    echo $giohan;
                                ?>
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
                                        
                                        $lnkPermission = "index.php?module=$module&act=permission&id=".$data['id'].'&group='.$data['id_nhom'].$page;
                                        $iconPermission=cmsIcon('Phân quyền',$lnkPermission,array('icon'=>'exclamation.gif'));
                                        $permission ='';
                                        if($data['quyentruycap']==1){
                                            $permission = $iconPermission;
                                        }
                                        
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
