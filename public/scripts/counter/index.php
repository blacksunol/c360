<?php
    require_once 'connect.php';

    $s_thongke = "select * from counter";
    $query = mysql_query($s_thongke);
    $data_thongke = mysql_fetch_assoc($query);
    $demngay		= $data_thongke['DemNgay'];
    $counter_ngay	= $data_thongke['counter_ngay'];
    $demtuan		= $data_thongke['DemTuan'];
    $demthang		= $data_thongke['DemThang'];
    $tongluottruycap = $data_thongke['counter'];
    $ngayhomnay	   = $tongluottruycap - $counter_ngay;   
?>
<div class="thongke">
    <div class="online">
        <b>Khách online :</b> <?php echo include("usersonline/onlinesql.php"); ?>
    </div>
    <div class="tongluot">
        <b>Tổng truy cập :</b> <?php echo $tongluottruycap; ?>
    </div>
</div>