tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		editor_deselector : "noeditor",
		plugins : "style,layer,table,advhr,advlink,emotions,inlinepopups,preview,media,paste,fullscreen,noneditable,contextmenu,visualchars,template,wordcount,trplugins",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,insertimage,image,link,unlink,cleanup,code,preview,|,fullscreen",
		theme_advanced_buttons2 : "tablecontrols",
		theme_advanced_buttons3 : "",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		script_image_upload : "uploadplugin.php"

	});