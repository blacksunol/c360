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
                            $link = 'index.php?module=news&act=page&cid='.$v['id'];
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
                <?php
                    $sql = "select * from tintuc where duyet=1 and id_danhmuc=".$_GET['cid'];
                    $data = fetchRow($sql);
                    if(!empty($data['noidung'])){
                        echo $data['noidung'];
                    }else{
                ?>
                <div class="error_data">Đang cập nhật dữ liệu</div>
                <?php
                    }
                ?>
                <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>