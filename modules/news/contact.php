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
                            $link = 'index.php?module=news&act=contact&cid='.$v['id'];
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
                <div class="clr height10"></div>
                <div class="info_contact_left">
                    <div class="title_success"></div>
                    <div class="form_lienhe">
                        <form onsubmit="fCheck(this);return false;" enctype="multipart/form-data" method="post" action="<?php echo APPLICATION_URL.'/modules/news/ajax-lienhe.php';?>" id="fComments" name="fComments">
                            <div id="row">
                                <div class="label">Họ tên:</div>
                                <div class="phuong">
                                    <input type="text" name="name" id="name" value="" class="name text_hoidap" placeholder="Họ tên" title="Họ tên">
                                </div>
                                <div class="fullname_err error_hoidap"></div>
                            </div>

                            <div class="clr" id="row">
                                <div class="label">Địa chỉ:</div>
                                <div class="phuong">
                                    <input type="text" name="address" id="address" value="" class="address text_hoidap" placeholder="Địa chỉ" title="Địa chỉ">
                                </div>	
                                <div class="address_err error_hoidap"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Điện thoại:</div>
                                <div class="phuong">
                                    <input type="text" name="phone" id="phone" value="" class="phone text_hoidap" placeholder="Điện thoại" title="Điện thoại">
                                </div>	
                                <div class="phone_err error_hoidap"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Email:</div>
                                <div class="phuong">
                                    <input type="text" name="email" id="email" value="" class="email text_hoidap" placeholder="Email" title="Email">
                                </div>	
                                <div class="email_err error_hoidap"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">Tiêu đề:</div>
                                <div class="phuong">
                                    <input type="text" name="title" id="title" value="" class="title_hoi text_hoidap" placeholder="Tiêu đề" title="Tiêu đề">
                                    </div>	
                                <div class="title_err error_hoidap"></div>
                            </div>

                            <div class="clr" id="row">
                                <div class="label">Nội dung</div>
                                <div class="phuong">
                                    <textarea name="noidung" placeholder="Nội dung" title="Nội dung" rows="10" id="noidung" class="noidung noidung_frm" cols="50"></textarea>
                                </div>
                                <div class="noidung_err error_hoidap_other"></div>
                            </div>
                            <div class="clr" id="row">
                                <div class="label">&nbsp;</div>
                                <div class="phuong form_btn">
                                    <input type="submit" class="btn btn-primary" value="Gửi đi" name="ok">
                                    <input type="reset" class="btn" value="Hủy" name="huy">
                                </div>		
                            </div>
                        </form>

                    </div>
                    <script language="javascript">
                        jQuery("#phone").keydown(function(event) {
                        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 32 || (event.keyCode == 65 && event.ctrlKey === true) ||(event.keyCode >= 35 && event.keyCode <= 39)) 
                        {
                            jQuery(this).val(jQuery.trim(jQuery(this).val()));
                            return;
                        }else {
                                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                                event.preventDefault(); 
                            }   
                        }
                        });
                    </script>
                </div>
                <div class="clr"></div>
            </div>
        </div>            
    </div>
</div>