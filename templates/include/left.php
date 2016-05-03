<div class="left_main">
    <div class="block main_white">
        <div class="title_block">
            <span class="arrow_title"></span>Top sản phẩm xem nhiều nhất
        </div>
        <div class="line_block"></div>
        <div class="partner">
            <?php
                $sql = "select * from sanpham where duyet=1 order by sapxep asc limit 3";
                $result = fetchAll($sql);
                if(count($result)>0){
                    foreach($result as $v){
                        $link = 'index.php?module=shopping&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
            ?>
            <div class="row_pro_block">
                <a href="<?php echo $link;?>">
                    <div class="i-Thumb">
                        <?php
							if(!empty($v['hinhanh'])){
								$hinhanh = json_decode($v['hinhanh'],true);
						?>
						<img src="<?php echo FILE_URL.'/product/'.$hinhanh[0]; ?>" border="0" class="img_main"/>
						<?php
							}
						?>
                    </div>
                </a>
                <h2 class="name_home_pro"><a href="<?php echo $link;?>"><?php echo $v['ten'];?></a></h2>
                <div class="price">Lượt xem : 5</div>				   
            </div>
            <?php
                    }
                }
            ?>
            <div class="addmore"><a href="index.php?module=shopping&act=topview">Xem thêm</a></div>
        </div>
    </div>