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
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
    window.___gcfg = {lang: 'vi'};

    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>
</body>
</html>
