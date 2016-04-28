<div id="content-box">
    <div class="border">
        <div class="padding">
        <?php
            $module = $_GET['module'];
            require_once ("modules/$module/include/toolbar.php");
        ?>

<div class="clr"></div><!-- BEGIN: CONTENT -->
<div id="element-box">
    <div class="t">
        <div class="t">
            <div class="t"></div>
        </div>
    </div>
    <?php
                $sql = "SELECT n_p.id_phanquyen,n_p.id_nhom FROM nhom_phanquyen as n_p where id_nhom=".$_GET['group'];
                $slbPermission = fetchAll($sql);
                $arrPerId = array();
                if(count($slbPermission)>0){
                    foreach($slbPermission as $k=> $per){
                        $arrPerId[$k]=$per['id_phanquyen'];
                    }
                }
                $strPer  = implode("','", $arrPerId);
               
		$sql_user = "select id_phanquyen from thanhvien_phanquyen as p where id_thanhvien=".$_GET['id'];
		$query_user = mysql_query($sql_user);
		$rows_user = array();
		while($data_user = mysql_fetch_assoc($query_user)){
			$rows_user[] = $data_user;
		}
		$checkUser = array();
		if(count($rows_user)>0){
			foreach($rows_user as $v){
				$checkUser[$v['id_phanquyen']] = $v['id_phanquyen']; 
			}
		}
		//echo "<pre>";print_r($checkUser);
		//danh sach tat ca
		$module = array(
			'thanhvien'=>'Thành viên',
			'donhang'=>'Đơn hàng',
                        'tintuc'=>'Tin tức',
                        'hinhanh'=>'Hình ảnh',
                        'lienhe'=>'Liên hệ',
                        'hotro'=>'Hỗ trợ',
                        'binhluan'=>'Bình luận',
                        'sanpham'=>'Sản phẩm',
                        'danhmuc'=>'Danh mục',
		);
		$sql = "select * from phanquyen as p where p.id IN ('".$strPer."')";
		$query = mysql_query($sql);
		while($data = mysql_fetch_assoc($query)){
			$rows[] = $data;
		}
		$result = array();
		$i=0;
		if(count($rows)>0){
                    foreach($rows as $table){
                            $i++;
                            $result[$table['module']]['title'] = array(
                                    'title'=>$module[$table['module']],
                                    'module'=>$table['module']
                            );
                            $result[$table['module']]['data'][$i] = $table;
                    }
                }
		$arr_listItems = partition($result,2);
                
	?>
    
    
    <div class="m table_permisssion loadPermisssion">
    	<?php
            if(count($arr_listItems)>0){
                $i=0;
                foreach($arr_listItems as $table){
                    $i++;
         ?>
        <table cellspacing="0" cellpadding="3" border="0">
        	<?php
				if(count($table)>0){
					$j=0;
					foreach($table as $key){
						$j++;
			?>
        	<thead>
                <tr class="le">
                    <td width="300" align="left"><span><span class="baiviet">+ <?php echo !empty($key['title']['title'])?$key['title']['title']:'Đang cập nhật';?> :</span></span><a name="article"></a></td>
                    <td width="150" align="center" class="baiviet">Chức năng
                    </td>
                </tr>
        	</thead>
            <tbody>
            	<?php
					if(count($key)>0){ 
						foreach($key['data'] as $val){	
				?>
                <tr class="even le">               
                    <td align="left" class="title_per">- <?php echo $val['ten'];?></td>
                    <td align="center">
                    	<?php 
							if (in_array($val['id'], $checkUser)){
						?>
                        <a href="javascript:;" onclick="loadFunction('<?php echo APPLICATION_URL.'/admin/modules/thanhvien/inactive.php';?>',<?php echo $_GET['id'];?>,<?php echo $val['id'];?>);">
                            <img border="0" src="templates/images/tick.png">
                        </a>
                        <?php
							}else{
						?>
                        <a href="javascript:;" onclick="loadFunction('<?php echo APPLICATION_URL.'/admin/modules/thanhvien/active.php';?>',<?php echo $_GET['id'];?>,<?php echo $val['id'];?>);">
                            <img border="0" src="templates/images/tick2.png">
                        </a>
                        <?php
							}
						?>
                    </td>
                </tr>
                <?php
						}
					}
				?>
            </tbody>
            <?php
					}
				}
			?>
        </table>
        <?php
                }
            }
            if(count($result)==0){
        ?>
        <div style="color:red;text-align: center">Nhóm này chưa cấp quyền</div>
        <?php
            }
        ?>
                
                <div class="clr"></div>
            </div>
            <div class="b">
                <div class="b">
                    <div class="b"></div>
                </div>
            </div>
        </div>
        <!-- END: 	CONTENT -->                    
		<div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>