<?php
	include_once '../../define.php';
	require_once(APPLICATION_PATH."/helper/model.php");
    $conn=mysql_connect(LOCALHOST,USERNAME,PASSWORD);
    mysql_select_db(DATABASE,$conn);
    mysql_query("SET NAMES utf8");
	
	$sql = "select * from binhluan where id_sanpham=".$_GET['id'].' order by id ASC';
	$result = fetchAll($sql);
	if(count($result)>0){
		$i=0;
		foreach($result as $v){
			$i++;
?>
<div class="rows_comment <?php echo ($i%2==0)?'chan':'';?>">
	<div class="avarta">
		<div class="name_comment"><?php echo $v['hoten'];?></div>
		<div class="ngaygui">Ngày gửi : <?php echo gmdate('d/m/Y G:i:s',$v['ngaytao']+7*3600);?></div>
		<div class="ngaygui"><?php echo $v['email'];?></div>
	</div>
	<div class="info_comment">
		<?php 
			$noidung =  $v['noidung']; 
			$noidung = nl2br($noidung);
			echo $noidung;
		?>
	</div>
	<div class="clr"></div>
</div>
<?php
		}
	}
?>