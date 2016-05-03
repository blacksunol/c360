<?php
	require('../../../define.php');
	$conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
    require('../../../helper/model.php');
	$sql = select('sanpham','').  where(array('id'=>$_GET['id']));
    $data = fetchRow($sql);
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