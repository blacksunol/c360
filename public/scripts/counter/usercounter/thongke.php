<?php
require_once PUBLIC_PATH.'/scripts/counter/connect.php';
$s = "SELECT curdate() as date";
$query = mysql_query($s);
$data['date'] = mysql_fetch_assoc($query);
    

function KhoangCachNgay($ngayhientai,$ngayquakhu){
    
    $s = "SELECT DATEDIFF('$ngayhientai','$ngayquakhu')";
    
    $query = mysql_query($s);
    $data = mysql_fetch_assoc($query);
    return $data["DATEDIFF('$ngayhientai','$ngayquakhu')"];
}
        
	// lay thong tin thong ke
        
    
	$s_thongke = "select * from counter";
        $query = mysql_query($s_thongke);
        $data_thongke = mysql_fetch_assoc($query);
	
	$demngay		= $data_thongke['DemNgay'];
	$counter_ngay   = $data_thongke['counter_ngay'];
	$ngayngay		= $data_thongke['NgayNgay'];
	$demtuan		= $data_thongke['DemTuan'];
	$counter_tuan   = $data_thongke['counter_tuan'];
	$ngaytuan		= $data_thongke['NgayTuan'];
	$demthang		= $data_thongke['DemThang'];
	$counter_thang   = $data_thongke['counter_thang'];
	$ngaythang		= $data_thongke['NgayThang'];
	$tongluottruycap = $data_thongke['counter'];
        
	$ngayhientai = gmdate("Y-m-d",time()+7*3600);
	
	$khoangcach_ngaynngay   = KhoangCachNgay($ngayhientai,$ngayngay);
	$khoangcach_ngaytuan  	= KhoangCachNgay($ngayhientai,$ngaytuan);
	$khoangcach_ngaynthang  = KhoangCachNgay($ngayhientai,$ngaythang);
	
	//echo $khoangcach_ngaynngay.".".$counter_ngay."<br>".$khoangcach_ngaytuan."<br/>".$khoangcach_ngaynthang."<br>".$tongluottruycap;
	
	if($khoangcach_ngaynngay >= 1)
	{
		$demngay_moi = $tongluottruycap - $counter_ngay;
		$arraythongke = array("DemNgay"			=> $demngay_moi,
							  "counter_ngay"	=> $tongluottruycap,
							  "NgayNgay"		=> $ngayhientai);
                $sql = "UPDATE counter SET DemNgay='$demngay_moi',counter_ngay='$tongluottruycap',NgayNgay='$ngayhientai'";
		mysql_query($sql);
	}
	
	if($khoangcach_ngaytuan >= 8)
	{
		$demtuan_moi = $tongluottruycap - $counter_tuan;
		$arraythongke = array("DemTuan"			=> $demtuan_moi,
							  "counter_tuan"	=> $tongluottruycap,
							  "NgayTuan"		=> $ngayhientai);
                
                $sql = "UPDATE counter SET DemTuan='$demtuan_moi',counter_tuan='$tongluottruycap',NgayTuan='$ngayhientai'";
		mysql_query($sql);
               
	}
	
	if($khoangcach_ngaynthang >= 31)
	{
		$demthang_moi = $tongluottruycap - $counter_thang;
		$arraythongke = array("DemThang"		=> $demthang_moi,
							  "counter_thang"	=> $tongluottruycap,
							  "NgayThang"		=> $ngayhientai);
                
                $sql = "UPDATE counter SET DemThang='$demthang_moi',counter_thang='$tongluottruycap',NgayThang='$ngayhientai'";
		mysql_query($sql);
                
	}
	
?>