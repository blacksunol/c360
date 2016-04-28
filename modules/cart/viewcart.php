<div class="partmain">              
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                <h2 class="navigation">Giỏ hàng của bạn</h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <div class="info_cart">
                <form action="index.php?module=cart&act=update" method="post">
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
                                                <th width="30px" scope="col" class="mainBagTitle">Xóa</th>
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
                                                    <input type="text" name="itemProduct[<?php echo $product['id'];?>]" size="1" value="<?php echo $v['quantity'];?>" class="textForm qty inputCart">
                                                </td>
                                                <td width="100px" class="mainBagContent middel">
                                                    <?php echo number_format($amount,0,',','.'); ?> VNĐ
                                                </td>
                                                <td width="50px" class="mainBagContent middel">
                                                    <a href="index.php?module=cart&act=delete&id=<?php echo $product['id'];?>" class="a_xoa">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/trash.png" class="img_xoa"></a>
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
                                                }else{
                                            ?>
                                            <tr>
                                                <td height="40" colspan="7" class="error_cart">Giỏ hàng rỗng</td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                <input type="hidden" class="" value="0" name="total">
                                <div class="clr"></div>
                                </div>        
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" href="<?php echo APPLICATION_URL; ?>">Tiếp tục mua hàng</a>
                                <?php
                                    if(count($_SESSION["cart"])>0){
                                ?>
                                <a class="btn btn-warning" href="index.php?module=cart&act=delete&type=all">Hủy giỏ hàng</a>
                                <button type="submit" class="btn btn-success " name="update">Cập nhật</button>
                                <a class="btn btn-success" href="index.php?module=cart&act=order">Đặt hàng</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clb"></div>
            </div>
        </div>            
    </div>
</div>