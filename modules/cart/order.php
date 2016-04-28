<?php
    $item = fetchRow('select * from thanhvien where id='.$_SESSION['id']);  
    if(isset($_POST['order'])){
        if($_POST['id_payment']==0){
            $error['id_payment']='<div class="error_order">Vui lòng chọn 1 hình thức</div>';
        }
        if($_POST['id_vanchuyen']==0){
            $error['id_vanchuyen']='<div class="error_order">Vui lòng chọn 1 hình thức vận chuyển</div>';
        }
        if($_POST['id_payment']==1){
            if($_POST['fullname']==NULL){
                    $error['fullname']='<div class="error_order">Vui lòng nhập họ tên</div>';
                }
                if($_POST['phone']==NULL){
                    $error['phone']='<div class="error_order">Vui lòng nhập số điện thoại</div>';
                }
                
                if($_POST['fullname'] && $_POST['phone'] && $_POST['id_payment']>0 && $_POST['id_vanchuyen']>0){
                    $data  = array(
                        'hoten'=>$_POST['fullname'],
                        'dienthoai'=>$_POST['phone'],
                        'tongtien'=>$_POST['total'],
                        'ngaytao'=>time(),
                        'duyet'=>0,
                        'id_user'=>$_SESSION['id'],
                        'sapxep'=>0,
                        'id_thanhtoan'=>$_POST['id_payment'],
                        'id_vanchuyen'=>$_POST['id_vanchuyen'],
                    );
                    $sql = insert('donhang',$data);
                    mysql_query($sql);
                    $id = mysql_insert_id();
                    if(count($_SESSION["cart"])>0){
                        foreach($_SESSION["cart"] as $v){
                            $data = array(
                                'soluong'=>$v['quantity'],
                                'dongia'=>$v['price'],
                                'id_sanpham'=>$v['id'],
                                'id_donhang'=>$id
                            );
                            $sql = insert('chitietdonhang',$data);
                            mysql_query($sql);
                        }
                    }
                    unset($_SESSION["cart"]);
                    header("location:index.php?module=cart&act=order-success");
                    exit();
                }
            
            }else{
                if($_POST['fullname']==NULL){
                $error['fullname']='<div class="error_order">Vui lòng nhập họ tên</div>';
            }
            if($_POST['phone']==NULL){
                $error['phone']='<div class="error_order">Vui lòng nhập số điện thoại</div>';
            }
            if($_POST['email']==NULL){
                $error['email']='<div class="error_order">Vui lòng nhập email</div>';
            }
            if($_POST['address']==NULL){
                $error['address']='<div class="error_order">Vui lòng nhập đại chỉ</div>';
            }
            if($_POST['fullname'] && $_POST['phone'] && $_POST['email'] && $_POST['address'] && $_POST['id_payment']>0 && $_POST['id_vanchuyen']>0){
                $data  = array(
                    'hoten'=>$_POST['fullname'],
                    'dienthoai'=>$_POST['phone'],
                    'email'=>$_POST['email'],
                    'diachi'=>$_POST['address'],
                    'noidung'=>$_POST['content'],
                    'tongtien'=>$_POST['total'],
                    'ngaytao'=>time(),
                    'duyet'=>0,
                    'id_user'=>$_SESSION['id'],
                    'sapxep'=>0,
                    'id_thanhtoan'=>$_POST['id_payment'],
                    'id_vanchuyen'=>$_POST['id_vanchuyen'],
                );
                $sql = insert('donhang',$data);
                mysql_query($sql);
                $id = mysql_insert_id();
                if(count($_SESSION["cart"])>0){
                    foreach($_SESSION["cart"] as $v){
                        $data = array(
                            'soluong'=>$v['quantity'],
                            'dongia'=>$v['price'],
                            'id_sanpham'=>$v['id'],
                            'id_donhang'=>$id
                        );
                        $sql = insert('chitietdonhang',$data);
                        mysql_query($sql);
                    }
                }
                            unset($_SESSION["cart"]);
                header("location:index.php?module=cart&act=order-success");
                exit();
            }
        }
        $item['hoten'] = $_POST['fullname'];
        $item['dienthoai'] = $_POST['phone'];
        $item['email'] = $_POST['email'];
        $item['diachi'] = $_POST['address'];
    }
?>
<div class="partmain">              
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                
                <span class="arrow_title"></span>
                
                <h2 class="navigation">Đặt hàng</h2>
                
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <div class="info_cart">
                
                <form action="index.php?module=cart&act=order" method="post">
                    <div class="title_order">Hình thức thanh toán</div>
                    
                    <div class="form_order" style="margin-left: 87px;">
                        <?php echo $error['id_payment'];?>
                        <?php
                            $sql = "select * from thanhtoan";
                            $payment = fetchAll($sql);
                            if(count($payment)>0){
                                foreach($payment as $v){
                        ?>
                        <div class="rows_pay">
                            <input type="radio" name="id_payment" value="<?php echo $v['id'];?>" class="id_payment intpay" <?php echo ($_POST['id_payment']==$v['id'])?'checked="checked"':'';?>/> 
                            <span class="textpay"><?php echo $v['ten'];?> </span>
                            <div class="clr"></div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    
                    <div class="title_order">Thông tin nhận hàng</div>
                    <div class="form_order" style="margin-left: 87px;">
                        <table cellspacing="0" cellpadding="3" border="0" style="width:100%;">
                            <tbody>
                            
                                <tr>
                                    <td class="label_order">
                                        Họ tên<span class="span_batbuoc">*</span>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $item['hoten'];?>" name="fullname" style="width:400px;">
                                        <?php echo $error['fullname'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label_order">
                                        Điện thoại<span class="span_batbuoc">*</span>
                                    </td>
                                    <td>
                                        <input type="text" name="phone" value="<?php echo $item['dienthoai'];?>" style="width:400px;">
                                        <?php echo $error['phone'];?>
                                    </td>
                                </tr>
                                
                                <tr class="nhanh">
                                    <td class="label_order">
                                        Email <span class="span_batbuoc">*</span>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $item['email'];?>" name="email" style="width:400px;">
                                        <?php echo $error['email'];?>
                                    </td>
                                </tr>
                                <tr class="nhanh">
                                    <td class="label_order">
                                        Địa chỉ<span class="span_batbuoc">*</span>
                                    </td>
                                    <td>
                                        <input type="text" name="address" value="<?php echo $item['diachi'];?>" style="width:400px;">
                                        <?php echo $error['address'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label_order">
                                        Hình thức vận chuyển
                                    </td>
                                    <td>
                                        <?php
                                                $sql = "select * from vanchuyen";
                                                $vanchuyen = fetchAll($sql);
                                                if(count($vanchuyen)>0){
                                                    foreach($vanchuyen as $v){
                                            ?>
                                            
                                                <input type="radio" name="id_vanchuyen" value="<?php echo $v['id'];?>" <?php echo ($_POST['id_vanchuyen']==$v['id'])?'checked="checked"':'';?>/> 
                                                <?php echo $v['ten'];?>
                                               
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            <div style="margin-top: 10px;">
                                                <?php echo $error['id_vanchuyen'];?>
                                            </div>
                                    </td>
                                </tr>
                                <tr class="nhanh">
                                    <td class="label_order">Nội dung</td>
                                    <td>
                                        <textarea name="content" class="content_order" style="width:400px;"><?php echo $_POST['content'];?></textarea>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>


                    <div class="title_order">Giỏ hàng của bạn</div>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myCart">
                        <div id="frmMain">

                            <div class="modal-body">
                                <div >
                                    <table width="100%" cellspacing="0" cellpadding="3" border="0" class="form_cart tablepopupcart">
                                        <tbody>
                                            <tr class="mainBagBillingTitle">
                                                <th width="30px" scope="col" class="mainBagTitle">STT</th>
                                                <th width="70px" scope="col" class="mainBagTitle">Hình ảnh</th>
                                                <th scope="col" class="mainBagTitle">Tên sản phẩm</th>
                                                <th width="50px" scope="col" class="mainBagTitle">Giá</th>
                                                <th width="70px" scope="col" class="mainBagTitle">Số lượng</th>
                                                <th width="100px" scope="col" class="mainBagTitle">Thành tiền</th>
                                            </tr>
                                            <?php
                                                if(count($_SESSION["cart"])>0){
                                                    $i=0;
                                                    $total =0;
                                                    foreach($_SESSION["cart"] as $v){
                                                        $i++;
                                                        $sql = "select * from sanpham as p where id=".$v['id'];
                                                        $product = fetchRow($sql);
                                                        $amount = $product['gia']*$v['quantity'];
                                                        $total = $total+$amount;
                                            ?>
                                            <tr class="bg_cart">
                                                <td width="30px" class="mainBagContent middel"><?php echo $i;?></td>
                                                <td width="70px" class="mainBagContent middel">
                                                    <?php
                                                        if(!empty($product['hinhanh'])){
                                                    ?>
                                                    <a href="index.php?module=shopping&act=detail&cid=<?php echo $product['id_danhmuc'];?>&id=<?php echo $product['id'];?>">
                                                        <img height="56" src="<?php echo FILE_URL.'/news/'.$product['hinhanh']; ?>">
                                                    </a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td align="center" class="mainBagContent middel">
                                                    <a href="index.php?module=shopping&act=detail&cid=<?php echo $product['id_danhmuc'];?>&id=<?php echo $product['id'];?>"><?php echo $product['ten'];?></a>
                                                </td>
                                                <td width="90px" class="mainBagContent middel">
                                                    <?php echo number_format($product['gia'],0,',','.'); ?> VNĐ
                                                </td>
                                                <td width="40px" align="center" class="mainBagContent middel">
                                                <?php echo $v['quantity'];?>
                                                </td>
                                                <td width="100px" class="mainBagContent middel">
                                                    <?php echo number_format($amount,0,',','.'); ?> VNĐ
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                            ?>
                                            <tr>
                                                <td height="40" colspan="3"></td>
                                                <td class="middel_right" colspan="2"><b>Thành tiền :</b></td>
                                                <td colspan="2" class="middel_right middel_total">
                                                    <?php
                                                        echo number_format($total,0,',','.');
                                                    ?> VNĐ
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                <input type="hidden" value="<?php echo $total;?>" name="total">
                                <div class="clr"></div>
                                </div>        
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn_order" name="order">Đặt hàng</button>

                            </div>
                        </div>
                    </div>
                
                </form>
                <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>
<script>
    $(function(){
        <?php
            if($_POST['id_payment']==1){
        ?>
         $(".nhanh").hide();  
        <?php }else{ ?>
        $(".nhanh").show();
        <?php } ?>
        $(".id_payment").click(function(){
            var id_payment = $(this).val();
            if(id_payment==1){
                $(".nhanh").hide();
            }else{
                $(".nhanh").show();
            }
        });
    });
</script>