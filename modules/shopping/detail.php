<script src="<?php echo TEMPLATE_URL;?>/js/starrating.js" type="text/javascript"></script>
<link href="<?php echo TEMPLATE_URL;?>/css/starrating.css" rel="stylesheet" type="text/css"/>
<div class="partmain">           
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                
                <h2 class="navigation"><a href="<?php echo APPLICATION_URL;?>">Trang chủ</a></h2>
                <div class="arrow_navi"> > </div>
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
            <?php
                $sql_solanxem = "update `sanpham` set lanxem=lanxem + 1 where id=".$_GET['id'];
                mysql_query($sql_solanxem);
                $sql = "select * from sanpham where duyet=1 and id=".$_GET['id'];
                $data = fetchRow($sql);
            ?>
            <div class="line_block"></div>
            <div class="detail_product">
                <div class="detail_left">
                    <img itemprop='image' src="<?php echo FILE_URL.'/news/'.$data['hinhanh']; ?>" style='border: 1px solid #e5e5e5; width:250px'/>  
                    
                </div>
                <div class="detail_right">
                    <h1 class="title_product"><?php echo $data['ten'];?></h1>          
                     <div class="mota">
                    	<?php echo $data['thongtin'];?>
                    </div>
                    <div>Lượt xem : <?php echo $data['lanxem']; ?></div>
                    <div class="starpoint" style="margin-top:5px;">
                        <div style="display:inline;float:left;margin-top: 4px;">Đánh giá : </div>
                        <ul class='star-rating'>
                            <li class="current-rating" id="current-rating" style="width:<?php echo (@round($data['diem_chon'] / $data['lan_chon'],1)) * 20;?>%"></li>
                            <span id="ratelinks">
                                <li><a href="javascript:void(0)" title="1 star out of 5" class="one-star">1</a></li>
                                <li><a href="javascript:void(0)" title="2 stars out of 5" class="two-stars">2</a></li>
                                <li><a href="javascript:void(0)" title="3 stars out of 5" class="three-stars">3</a></li>
                                <li><a href="javascript:void(0)" title="4 stars out of 5" class="four-stars">4</a></li>
                                <li><a href="javascript:void(0)" title="5 stars out of 5" class="five-stars">5</a></li>
                            </span>
                        </ul>
                        <script language="javascript" type="text/javascript" > 
                            var id_product = <?php echo $_GET['id'];?>
                        </script>
                    </div>
                </div>
                <div class="clr"></div>
                <div class="content_product">
                    <div class="title_content">Nội dung :</div>
                    <div class="info_content_pro clr">
                        <?php 
                            if(!empty($data['noidung'])){    
                                echo remove_url($data['noidung']);
                            }else{
                        ?>
                        <div class="error_data">Đang cập nhật dữ liệu</div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
				
                <div class="clr"></div>
                <div class="content_product">
                	<div class="title_content">Danh sách bình luận :</div>
                    <div class="list_comment">
                    	<?php
                            $sql = "select * from binhluan where duyet=1 and id_sanpham=".$_GET['id'];
                            $result = fetchAll($sql);
                            if(count($result)>0){
                                $i=0;
                                foreach($result as $v){
                                    $i++;
                        ?>
                    	<div class="rows_comment <?php echo ($i%2==0)?'chan':'';?>">
                        	<div class="avarta">
                            	<div class="name_comment"><?php echo $v['hoten'];?></div>
                                <div class="ngaygui">Ngày gửi : <?php echo gmdate('d/m/Y',$v['ngaytao']+7*3600);?></div>
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
                        
                    </div>
                    <div class="clr"></div>
                    <div class="content_comment">
                    	<form onsubmit="fCheckComment(this);return false;" enctype="multipart/form-data" method="post" action="<?php echo APPLICATION_URL.'/modules/shopping/ajax-comment.php';?>" id="fComments" name="fComments">
                        	<input type="hidden" class="id_product" value="<?php echo $data['id'];?>" />
                            <div id="row">
                                <div class="label">Họ tên:</div>
                                <div class="phuong">
                                    <input type="text" name="name" id="name" value="" class="name text_hoidap" placeholder="Họ tên" title="Họ tên">
                                </div>
                                <div class="fullname_err error_hoidap"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Email:</div>
                                <div class="phuong">
                                    <input type="text" name="email" id="email" value="" class="email text_hoidap" placeholder="Email" title="Email">
                                </div>	
                                <div class="email_err error_hoidap"></div>
                            </div>
                            
                            <div class="clr" id="row">
                                <div class="label">Nội dung</div>
                                <div class="phuong comment">
                                    <textarea name="noidung" placeholder="Nội dung" title="Nội dung" rows="10" id="noidung" class="noidung noidung_frm" cols="25"></textarea>
                                </div>
                                <div class="noidung_err error_hoidap_other"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">&nbsp;</div>
                                <div class="phuong form_btn">
                                    <input type="submit" class="btn btn-primary" value="Bình luận" name="ok">
                                    <input type="reset" class="btn" value="Hủy" name="huy">
                                </div>		
                            </div>
                        </form>
                    </div>
                </div>
            </div>	
        </div>
        <!-- other -->
    </div>
</div>