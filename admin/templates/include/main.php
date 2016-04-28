<link href="<?php echo ADMIN_URL;?>/templates/dashboard/css/chart.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?php echo ADMIN_URL;?>/templates/dashboard/css/dashboard.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_URL;?>/templates/dashboard/js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_URL;?>/templates/chart/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_URL;?>/templates/dashboard/chart/js/exporting.js" type="text/javascript"></script>

<div id="content-box">
    <div class="border">
        <div class="padding">
            <div class="thongke">
                <div class="block_left">
                    <div class="title_thongke">Thống kê dữ liệu</div>
                    <?php
                        $totalProduct = count(fetchAll("select * from sanpham"));
                        $totalUser = count(fetchAll("select * from thanhvien"));
                    ?>
                    <div class="main_thongke">
                        <script type="text/javascript">
                            $(function () {
                                var chart;
                                $(document).ready(function () {
                                    // Build the chart
                                    $('#container').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false
                                        },
                                        title: {
                                            text: ''
                                        },
                                        tooltip: {
                                            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                dataLabels: {
                                                    enabled: true,
                                                   // format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                },
                                                showInLegend: true
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Browser share',
                                            data: [
                                                ['Thành viên : <?php echo $totalUser;?>', <?php echo $totalUser;?>],
                                                ['Sản phẩm : <?php echo $totalProduct;?>', <?php echo $totalProduct;?>]
                                            ]
                                        }]
                                    });
                                });
                            });
                        </script>
                        <div id="container" class="chart_pie"></div>
                    </div>
                </div>
                <div class="block_right">
                    <div class="title_ghichu">Thông tin của bạn</div>
                    <div class="main_thongtin">
                        <?php
                            $sql = "SELECT u.hoten,u.dienthoai,u.diachi,u.username,u.email,n.ten as n_ten
                                    FROM thanhvien as u 
                                    LEFT JOIN nhom as n ON u.id_nhom=n.id where u.id=".$_SESSION['id']."";
                            $user = fetchRow($sql);
                        ?>
                        <div class="rows_info">
                            <div class="label_info">Họ tên</div>
                            <div><?php echo $user['hoten']; ?></div>
                        </div>
                        <div class="clr"></div>
                        <div class="rows_info">
                            <div class="label_info">Điện thoại</div>
                            <div><?php echo $user['dienthoai']; ?></div>
                        </div>
                        <div class="clr"></div>
                        <div class="rows_info">
                            <div class="label_info">Địa chỉ</div>
                            <div><?php echo $user['diachi']; ?></div>
                        </div>
                        <div class="clr"></div>
                        <div class="rows_info">
                            <div class="label_info">Email</div>
                            <div><?php echo $user['email']; ?></div>
                        </div>
                        <div class="clr"></div>
                        <div class="rows_info">
                            <div class="label_info">Username</div>
                            <div><?php echo $user['username']; ?></div>
                        </div>
                        <div class="clr"></div>
                        <div class="rows_info">
                            <div class="label_info">Nhóm thành viên</div>
                            <div><?php echo $user['n_ten'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<div id="border-bottom"><div><div></div></div></div>

