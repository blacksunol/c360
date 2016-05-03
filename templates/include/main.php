<div class="center_main">
    <div class="main_product main_white">
        <div class="title_block">
        <span class="arrow_title"></span>Danh sách phim</div>
        <div class="line_block"></div>
        <div class="list_product load_product_2">
            <?php
                $sql = "select * from sanpham as p where p.duyet=1 order by p.sapxep asc limit 16";
                $result = fetchAll($sql);
                if(count($result)>0){
                    foreach($result as $v){
                        $link = 'index.php?module=shopping&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
            ?>
            <div class="row_pro">
                <div class=" i-Thumb">
                    <a href="<?php echo $link;?>" class="imgCenterP">
                        <?php
							if(!empty($v['hinhanh'])){
								$hinhanh = json_decode($v['hinhanh'],true);
						?>
						<img src="<?php echo FILE_URL.'/product/'.$hinhanh[0]; ?>" border="0"/>
						<?php
							}
						?>
                    </a>
                </div>
                <h2 class="name_home_pro"><a href="<?php echo $link;?>"><?php echo $v['ten'];?></a></h2>
                <div class="price">Lượt xem : <?php echo $v['lanxem']; ?></div>
            </div>
            <?php
                    }
                }
            ?>

            <div class="clr"></div>
        </div> 
    </div>
    <script language="javascript">
        jQuery(document).ready(function (){
            jQuery(".list_product .imgCenterP img").resizeImg({maxWidth: 180,maxHeight: 180});
            jQuery(".list_product .i-Thumb img").imgCenter({scaleToFit:false});
        }); 
    </script>   
</div>
    