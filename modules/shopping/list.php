<div class="partmain">                    
    <div class="center_main">
        <div class="main_product main_white">
            <div class="title_block">
                <?php
                    $cid = $_GET['cid'];
                    $sql = "select * from danhmuc where duyet=1 order by sapxep asc";
                    $items = fetchAll($sql); 
                    $recursive = new recursive($items);
                    $arr_cid =$recursive->getParentsIdArray($cid);
                    $recursive->process($cid);
                    $arr_cid[] = $cid;
                    $arr_cid = implode("','", $arr_cid);
                    
                    $sql = "select * from danhmuc where duyet=1 and id in ('$arr_cid') order by sapxep asc";
                    $result = fetchAll($sql);
                ?>
                <span class="arrow_title"></span>
                <?php
                    if(count($result)>0){
                        $i=0;
                        $demNavi = count($result);
                        foreach($result as $v){
                            $i++;
                            $link = 'index.php?module=shopping&act=list&cid='.$v['id'];
                ?>
                <h2 class="navigation"><a href="<?php echo $link;?>"><?php echo $v['ten'];?></a></h2>
                <?php
                    if($i<$demNavi){
                ?>
                <div class="arrow_navi"> > </div>
                <?php } ?>
                <?php
                        }
                    }
                ?>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <div class="list_product">
                <?php
                    $cid = $_GET['cid'];
                    $sql = "select * from danhmuc where duyet=1";
                    $items = fetchAll($sql); 
                    $recursive = new recursive($items);
                   
                    $data = $recursive->process($cid);
                    $arr_cid = array($cid);
                    if(count($data)>0){			
                        foreach ($data as $key => $val){
                            $arr_cid[] = $val['id'];
                        }
                    }
					//echo "<pre>";print_r($arr_cid);die();
                    $arr_cid = implode("','", $arr_cid);
                    
                    /*dem */
                    $sql = "select * from sanpham where duyet=1 and id_danhmuc in ('$arr_cid') order by sapxep asc";
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
                    
                    $sql = "select * from sanpham where duyet=1 and id_danhmuc in ('$arr_cid') order by sapxep asc limit $position, $totalItemsPerPage";
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
        </div>
        <script language="javascript">
            jQuery(document).ready(function (){
                jQuery(".list_product .imgCenterP img").resizeImg({maxWidth: 180,maxHeight: 180});
                jQuery(".list_product .i-Thumb img").imgCenter({scaleToFit:false});
            }); 
        </script>            
    </div>
</div>