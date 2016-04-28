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
            <?php
                $sql = "select * from tintuc where duyet=1 and id=".$_GET['id'];
                $data = fetchRow($sql);
            ?>
            <div class="info_page">
                <div class="title_detail"><?php echo $data['tieude'];?></div>
                <div class="noidung_detail">
                    <div class="fck_detail width_common">
                        <?php
                            echo remove_url($data['noidung']);
                        ?>
                    </div>        
                </div>
                <div class="clb"></div>
                <div class="tinkhac">
                    <div class="title_tinkhac">Tin bài khác</div>
                    <div class="list_tinkhac">
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
                            $sql = "select * from tintuc where duyet=1 and id_danhmuc in ('$arr_cid') order by sapxep asc";
                            $result = fetchAll($sql);
                            if(count($result)>0){
                        ?>
                        <ul>
                            <?php
                                foreach($result as $v){
                                    $link = 'index.php?module=news&act=detail&cid='.$v['id_danhmuc'].'&id='.$v['id'];
                            ?>
                            <li><a href="<?php echo $link;?>"><?php echo $v['tieude'];?></a>(<?php echo gmdate('d/m/y G:i:s',$v['ngaytao']+7*3600)?>)</li>
                            <?php
                                }
                            ?>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>      
		</div>
            <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>