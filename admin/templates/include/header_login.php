<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Controller Panel</title>
<script>
    var baseurl= '<?php echo APPLICATION_URL; ?>';    
</script>
    
<link href="templates/css/menuTiny.css" rel="stylesheet" type="text/css" />
<link href="templates/css/rounded.css" rel="stylesheet" type="text/css" /> 
<link href="templates/css/general.css" rel="stylesheet" type="text/css" />
<link href="templates/css/icon.css" rel="stylesheet" type="text/css" />
<link href="templates/css/menu.css" rel="stylesheet" type="text/css" />
<link href="templates/css/style.css" rel="stylesheet" type="text/css" />
<link href="templates/css/ui.all.css" rel="stylesheet" type="text/css" />
<link href="templates/css/jquery.datepick.css" rel="stylesheet" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
<script src="templates/js/menuTiny.js" type="text/javascript"></script>
<script src="templates/js/submit.js" type="text/javascript"></script>
<script src="templates/js/jquery.datepick.js" type="text/javascript"></script>

     

<script type="text/javascript">
jQuery(document).ready(function() {
        $('#popupDatepicker').datepick();
        $('#rateDatepicker').datepick();
        $('#from').datepick();
        $('#to').datepick();
});

</script>

<script src="<?php echo ADMIN_URL;?>/templates/js/tablednd.js" type="text/javascript"></script>
<script src="<?php echo SCRIPT_URL;?>/tiny_mce3/tiny_mce.js" type="text/javascript"></script>
<script src="<?php echo SCRIPT_URL;?>/tiny_mce3/tiny_mce_init.js" type="text/javascript"></script>
<script>
    tinyMCE.settings.script_image_upload="<?php echo SCRIPT_URL;?>/tiny_mce3/uploadplugin.php";
</script>
</head>
    
<body id="minwidth-body">
    <div id="border-top" class="h_green">
        <div>
            <div>
                <span class="version">Version 1.0 Alpha</span>
                <span class="title" style="padding-left:20px">Seahog cms</span>
            </div>
        </div>
    </div>
    

       