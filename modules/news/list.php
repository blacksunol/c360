<div class="partmain">           
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <?php
                    $cid = $_GET['cid'];
                    $sql = "select * from danhmuc where duyet=1";
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
                            $link = 'index.php?module=news&act=list&cid='.$v['id'];
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
            <div class="info_page">
                <div class="list_news">
                    <?php
                        $cid = $_GET['cid'];
                        $sql = "select * from danhmuc where duyet=1";
                        $items = fetchAll($sql); 
                        $recursive = new recursive($items);
                        $arr_cid =$recursive->getParentsIdArray($cid);
                        $data = $recursive->process($cid);
                        $arr_cid[] = $cid;
                        if(count($data)>0){			
                            foreach ($data as $key => $val){
                                $arr_cid[] = $val['id'];
                            }
                        }
                        $arr_cid = implode("','", $arr_cid);

                        /*dem */
                        $sql = "select * from tintuc where duyet=1 and id_danhmuc in ('$arr_cid') order by sapxep asc";
                        $result = fetchAll($sql);
                        $totalItems = count($result);
                        $_pagination	= array(
                                            'totalItemsPerPage'	=> 8,
                                            'pageRange'		=> 2,
                                        );
                        $_pagination['currentPage']	= (isset($_GET['page'])) ? $_GET['page'] : 1;
                        $position	= ($_pagination['currentPage']-1)*$_pagination['totalItemsPerPage'];
                        $totalItemsPerPage = $_pagination['totalItemsPerPage'];
                        /*ket thuc thuat toan phan trang */

                        $sql = "select * from tintuc where duyet=1 and id_danhmuc in ('$arr_cid') order by sapxep asc limit $position, $totalItemsPerPage";
                        $result = fetchAll($sql);
                        if(count($result)>0){
                            foreach($result as $v){
                                $link = 'index.php?module=news&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
                    ?>
                    <div class="rows_news">
                        <?php
                            if(!empty($v['hinhanh'])){
                        ?>
                        <a href="<?php echo $link;?>">
                            <img width="120" height="100" align="left" class="img-subject" src="<?php echo FILE_URL.'/news/'.$v['hinhanh']; ?>"/>
                        </a>
                        <?php } ?>
                        <div class="title_list_news">
                            <a href="<?php echo $link;?>" class="link-title"><?php echo $v['tieude'];?></a>
                        </div>
                        <div class="info_list_news">
                            <?php
                                $content = remove_all_html($v['noidung']);
                                $content = cut_string($content,20);
                                echo showText($content);
                            ?>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="dot_bottom"></div>
                    <?php
                            }
                        }else{
                    ?>
                    <div class="error_data">Đang cập nhật dữ liệu</div>
                    <?php
                        }
                    ?>
                    <div class="clr height10"></div>  
                    <?php
                        $pagination = new Pagination($totalItems, $_pagination);
                        echo $pagination->showPagination('index.php?module=news&act=list&cid='.$_GET['cid']);
                    ?>
                </div>
            <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>