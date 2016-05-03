<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="index.php?module=sanpham&act=index">
                <?php
                    if(isset($_POST['go'])){
                        $_SESSION['id_danhmuc'] = $_POST['id_danhmuc'];
                    }
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
                        <div style="float:right;"> 
                            <?php
                                require_once("model.php");
                                $var = array('id'=>0,'ten'=>'Chọn danh mục','level'=>1);
                                array_unshift($result, $var);
                                echo $parents = cmsSelect('id_danhmuc',$_SESSION['id_danhmuc'],null,$result);
                            ?>
                            <input type="submit" name="go" value="Filter" />
                        </div>
                        <table class="adminlist">
                            <thead>
                                <tr>
                                    <th width="43" ><input type="checkbox" name="checkbox" id="checkbox" onclick="checkedAll();"></th>
                                    <th>Tên</th>
                                    <th width="50">Hình ảnh</th>
                                    <th width="100">Giá (VNĐ)</th>
                                    <th width="57">Duyệt</th>
                                    <th width="86">Sắp xếp</th>	
                                    <th width="150">Danh mục</th>
                                    <th width="90">Chức năng</th>
                                    <th width="34">ID</th>
                                </tr>
                            </thead>
                            <?php
                                $table = 'sanpham as n';
                                $sql_total =select($table,'');
                                if($_SESSION['id_danhmuc']>0){
                                    $sql=select('danhmuc','');
                                    $arrdata = fetchAll($sql);
                                    $recursives = new recursive($arrdata);
                                    $datas = $recursives->process($_SESSION['id_danhmuc']);
                                    $cid[] = $_SESSION['id_danhmuc'];
                                    if(count($datas)>0){			
                                            foreach ($datas as $key => $val){
                                                    $cid[] = $val['id'];
                                            }
                                    }
                                    
                                    $cid = implode(',',$cid);
                                    $sql_total .=whereIN('n.id_danhmuc IN ('.$cid.')');
                                     
                                }
                               
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
                                    'id'=>'n.id',
                                    'ten'=>'n.ten',
                                    'hinhanh'=>'n.hinhanh',
                                    'duyet'=>'n.duyet',
                                    'sapxep'=>'n.sapxep',
                                    'c_ten'=>'c.ten as c_ten'
                                );
                                $sql = select($table,$coln);
                                $sql .= joinLeft('danhmuc as c','c.id = n.id_danhmuc');
                                if($_SESSION['id_danhmuc']>0){
                                    $sql .=' where n.id_danhmuc IN ('.$cid.')';
                                }
                                $sql .= order('n.sapxep', 'ASC');
                                $sql .= limit($vtbd,$so_gioi_han);
                                
                                $arrdata = fetchAll($sql);
                                if(count($arrdata)>0){
                                    foreach($arrdata as $k=>$data){
                            ?>
                            <tr class="even">						
                                <td align="center"><input type="checkbox" name="cid[]" value="<?php echo $data['id']; ?>" ></td>
                                <td align="left"><?php echo $data['ten'];?></td>
                                <td align="center">
                                <?php
									if(!empty($data['hinhanh'])){
										$hinhanh = json_decode($data['hinhanh'],true);
                                ?>
                                    <img src="<?php echo FILE_URL.'/product/'.$hinhanh[0];?>" width="50" height="30"/>
                                    <?php }?>
                                </td>
                                <td align="center">
                                <?php
									echo number_format($data['gia'],0,',','.');
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
                                <td align="center"><?php echo $data['c_ten'];?></td>
                                <td align="center">
                                    <?php
										$countComment = count(fetchAll("select * from binhluan where id_sanpham=".$data['id']." and duyet=0"));
                                        if(!empty($_GET['trang'])){
                                            $page = '&trang='.$_GET['trang'];
                                        }
										$lnkComment = "index.php?module=binhluan&act=index&pid=".$data['id'];
                                        $iconComment=cmsIcon('Bình luận',$lnkComment,array('icon'=>'comments.gif'));
										
										
                                        $lnkEdit = "index.php?module=$module&act=edit&id=".$data['id'].$page;
                                        $iconEdit=cmsIcon('Sửa',$lnkEdit,array('icon'=>'icon_edit.png'));

                                        $lnkDel = "index.php?module=$module&act=delete&id=".$data['id'];
                                        $iconDel=cmsIcon('Xóa',$lnkDel,array('icon'=>'icon_del.png','onclick'=>"if(!window.confirm('Bạn có muốn xóa ".$data['name']." này không?')) return false;"));
                                        
                                        echo $strIcon= '<span style="color:red">('.$countComment .')</span>'.$iconComment.' '.$iconEdit.' '.$iconDel;
                                    ?>
                                </td>
                                <td align="center"><?php echo $data['id'];?></td>
                            </tr>
                            <?php
                                    }
                                }else{
                            ?>
                            <tr class="even" >
                                    <td colspan='18' align='center'>Chưa có dữ liệu</td>
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
