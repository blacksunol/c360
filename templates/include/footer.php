    </div>
    <div class="clr"></div>
</div>
<div class="footer">
    <div align="center" style="padding-top:10px; padding-bottom:10px;width:700px;float:left">
         <?php
            $sql = 'select * from thongtin where loai="footer"';
            $data = fetchRow($sql);
            echo remove_url($data['noidung']);
         ?>
    </div>
    <div style="float:right;padding-top:10px; padding-bottom:10px;">
    	<?php
			include_once SCRIPT_PATH.'/counter/index.php';
		?>
    </div>
    <div class="clb"></div>
    
</div>
</body>
</html>
