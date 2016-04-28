<link href="<?php echo TEMPLATE_URL;?>/css/order.css" media="screen" rel="stylesheet" type="text/css" >
<div class="partmain">              
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                <h2 class="navigation">Chi tiết đơn đặt hàng</h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <?php
                $sql = select('donhang','').  where(array('id'=>$_GET['id']));
                $data = fetchRow($sql);
            ?>
            <div class="info_cart">
                <div class="l_main"> 
                    <div id="header">
                        <div class="mains clearfix">
                            <h3 class="title">HÓA ĐƠN MUA HÀNG <br>
                                <span class="code">(Mã số <b><?php echo $data['id'];?></b>, Ngày <?php echo gmdate('d/m/Y G:i:s',$data['ngaytao']);?>)</span>
                            </h3>
                        </div>
                    </div>
                        <!--end nav-->
                    <div id="content">
                        <div class="mains clearfix">
                            <div class="col-385">
                                <div class="boxModule">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" class="bor">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="green">NGƯỜI MUA HÀNG</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" class="text-left">Họ tên </td>
                                                <td width="80%" class="text-left"><?php echo $data['hoten'];?></td>
                                            </tr>

                                            <tr>
                                                <td class="text-left">Điện thoại</td>
                                                <td class="text-left"><?php echo $data['dienthoai'];?> &nbsp; <span class="icon-mobile">&nbsp;</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Email</td>
                                                <td class="text-left"><?php echo $data['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Địa chỉ</td>
                                                <td class="text-left"><?php echo $data['diachi'];?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Nội dung</td>
                                                <td class="text-left"><?php echo $data['noidung'];?></td>
                                            </tr>
                                            <?php
                                                if($data['id_thanhtoan']>0){
                                            ?>
                                            <tr>
                                                <td class="text-left">Hình thức thanh toán</td>
                                                <td class="text-left">
                                                    <?php
                                                        $sql = "select * from thanhtoan where id=".$data['id_thanhtoan'];
                                                        $pay = fetchRow($sql);
                                                        echo $pay['ten'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if($data['id_vanchuyen']>0){
                                            ?>
                                            <tr>
                                                <td class="text-left">Hình thức vận chuyển</td>
                                                <td class="text-left">
                                                    <?php
                                                        $sql = "select * from vanchuyen where id=".$data['id_vanchuyen'];
                                                        $pay = fetchRow($sql);
                                                        echo $pay['ten'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="clear"></div>
                            <div class="boxModule">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%" class="bor">
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="green">THÔNG TIN ĐƠN HÀNG</td>
                                    </tr>
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td width="20%">Hình ảnh</td>
                                        <td width="17%">Đơn giá (VND)</td>
                                        <td width="16%">Số lượng</td>
                                        <td width="17%">Thành tiền (VND)</td>
                                    </tr>
                                    <?php
                                        $sql = "select ct.soluong,ct.dongia,p.ten,p.hinhanh,p.id,p.id_danhmuc from chitietdonhang as ct 
                                                INNER JOIN sanpham as p ON p.id=ct.id_sanpham
                                                where ct.id_donhang=".$data['id'];
                                        $result = fetchAll($sql);
                                        if(count($result)>0){
                                            $total =0;
                                            foreach($result as $data){
                                                $amount = $data['dongia']*$data['soluong'];
                                                $total += $amount;
                                    ?>
                                    <tr>
                                        <td class="text-left"><a target="_blank" href="<?php echo APPLICATION_URL; ?>/index.php?module=shopping&act=detail&cid=<?php echo $data['id_danhmuc'];?>&id=<?php echo $data['id'];?>"><?php echo $data['ten'];?></a>                       
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($data['hinhanh'])){
                                            ?>
                                            <a href="<?php echo APPLICATION_URL; ?>/index.php?module=shopping&act=detail&cid=<?php echo $data['id_danhmuc'];?>&id=<?php echo $data['id'];?>">
                                            <img height="27" src="<?php echo FILE_URL.'/news/'.$data['hinhanh']; ?>" border="0">
                                            </a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo number_format($data['dongia'],'0',',','.'); ?></td>
                                        <td><?php echo $data['soluong'];?></td>
                                        <td>
                                            <?php 
                                                echo number_format($amount,'0',',','.'); 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <tr class="sum">
                                        <td colspan="4" class="text-right">TỔNG THANH TOÁN</td>
                                        <td>
                                            <span class="red-bold">
                                                <?php 
                                                    echo number_format($total,'0',',','.'); 
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</div>