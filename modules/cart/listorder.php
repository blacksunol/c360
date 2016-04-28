<div class="partmain">              
    <div class=" center_main">
        <div class="block main_white">
            <div class="title_block">
                <span class="arrow_title"></span>
                <h2 class="navigation">Danh sách đơn đặt hàng</h2>
                <div class="clr"></div>
            </div>
            <div class="line_block"></div>
            <div class="info_cart">
                <table cellspacing="0" cellpadding="4" border="1" width="100%" style="background-color: White; border-color: #000; border-width: 1px; border-style: solid; width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr class="mainBagBillingTitle">
                            <th width="10%" style="text-align: center;" class="mainBagTitle">STT</th>
                            <th class="mainBagTitle">Số đơn hàng</th>
                            <th width="20%" class="mainBagTitle">Ngày đặt</th>
                            <th width="20%" class="mainBagTitle">Tình trạng</th>
                            <th width="25%" class="mainBagTitle">Thanh toán</th>
                        </tr>
                        <?php
                            $sql = "select * from donhang where id_user=".$_SESSION['id']." order by ngaytao DESC";
                            $data = fetchAll($sql);
                            if(count($data)>0){
                                $i=0;
                                foreach($data as $v){
                                    $i++;
                        ?>
                        <tr class="bg_cart">
                            <td style="vertical-align: middle; text-align: center;" class="mainBagContent"><?php echo $i;?></td>
                            <td style="vertical-align: middle;" class="mainBagContent">
                                <a title="Đơn hàng số <?php echo $v['id'];?>" href="index.php?module=cart&act=detailorder&id=<?php echo $v['id'];?>"><?php echo $v['id'];?></a>
                            </td>
                            <td style="vertical-align: middle; text-align:center;" class="mainBagContent">
                                <?php echo gmdate('d/m/Y G:i:s',$v['ngaytao']+7*3600);?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;" class="mainBagContent">
                                <?php
                                    switch ($v['duyet']){
                                        case 0:
                                            echo "Chưa xử lý";
                                            break;
                                        case 1:
                                            echo "Đã xử lý";
                                            break;
                                    }
                                ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;" class="mainBagContent">
                                <?php echo number_format($v['tongtien'],0,',','.'); ?> VNĐ
                            </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>            
    </div>
</div>