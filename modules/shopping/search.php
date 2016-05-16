<div class="partmain">           
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                
                <h2 class="navigation">Kết quả tìm kiếm <?php echo (!empty($_GET['q']))?' từ khóa : '.$_GET['q']:'';?></h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <div class="info_page">
                <div class="list_product">
                    <?php
                        /*dem */
                        $sql_product = "select * from sanpham where duyet=1 and ten like '%".$_GET['q']."%' order by ngaytao desc";
                        $result = fetchAll($sql);
                        $totalItems = count($result);
                        $_pagination	= array(
                                            'totalItemsPerPage'	=> 12,
                                            'pageRange'		=> 2,
                                        );
                        $_pagination['currentPage']	= (isset($_GET['page'])) ? $_GET['page'] : 1;
                        $position	= ($_pagination['currentPage']-1)*$_pagination['totalItemsPerPage'];
                        $totalItemsPerPage = $_pagination['totalItemsPerPage'];
                        /*ket thuc thuat toan phan trang */

                        $sql = "select * from sanpham where duyet=1 and ten like '%".$_GET['q']."%' order by sapxep asc limit $position, $totalItemsPerPage";
                        $result = fetchAll($sql);
                        if(count($result)>0){
                            foreach($result as $v){
                                $link = 'index.php?module=shopping&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
                    ?>
                    <div class="row_pro">
                        <div class=" i-Thumb">
                            <a href="<?php echo $link;?>" class="imgCenterP">
                                <img src="<?php echo FILE_URL.'/news/'.$v['hinhanh']; ?>" border="0"/>
                            </a>
                        </div>
                        <h2 class="name_home_pro"><a href="<?php echo $link;?>"><?php echo $v['ten'];?></a></h2>
                        <div class="price">Lượt xem : <?php echo $v['lanxem']; ?></div>
                    </div>
                    <?php
                            }
                        }else{
                    ?>  
                    <div class="error_data">Đang cập nhật dữ liệu</div>
                    <?php
                        }
                    ?>
                    <div class="clr"></div>
                    <?php
                        $pagination = new Pagination($totalItems, $_pagination);
                        echo $pagination->showPagination('index.php?module=shopping&act=list&cid='.$_GET['cid']);
                    ?>
                </div> 
                
            <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>
<script language="javascript">
    jQuery(document).ready(function (){
        jQuery(".list_product .imgCenterP img").resizeImg({maxWidth: 180,maxHeight: 180});
        jQuery(".list_product .i-Thumb img").imgCenter({scaleToFit:false});
    }); 
</script>   