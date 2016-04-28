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
    $data = '';
    $data .= '
    <table  class="tbl_thongke">
    <tr>
            <td style="text-align:left"> Trực tuyến :
            <span style=" font-weight:bold; text-align:left ">&nbsp;';
            $data.=include("usersonline/onlinesql.php");
            $data.='
            </span></td>
    </tr>
    <tr>
        <td> Hôm nay:
            <span style=" font-weight:bold;  text-align:left">&nbsp;'.$ngayhomnay.'</span></td>
    </tr>
    <tr>
        <td> Hôm qua:
            <span style=" font-weight:bold;  text-align:left">&nbsp;'.$demngay.'</span></td>
    </tr>
    <tr>
        <td>Tuần:
            <span style=" font-weight:bold;  text-align:left">&nbsp;'.$demtuan.'</span></td>
    </tr>
    <tr>
        <td>Tháng:
            <span style=" font-weight:bold;  text-align:left">&nbsp;'.$demthang.'</span></td>
    </tr>
    <tr>
        <td> Tất cả:
            <span style=" font-weight:bold;  text-align:left">&nbsp;'.$tongluottruycap.'</span></td>
    </tr>
    </table>';

 echo $data;

?>