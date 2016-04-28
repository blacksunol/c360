
(function() {
	tinymce.create('tinymce.plugins.TrinhPlugin', {
	    
		init : function(ed, url) {
			// Register commands			
			ed.addCommand('mceTrImgC', function(arg) {
                if(arg && arg.m==undefined)
                {
                    arg.m=true;
                }
				ed.windowManager.open({
					file : url + '/index.htm',
					width : 870 ,
					height : 450,
					inline : 1
				}, {
					plugin_url     : url,
					option_o	   : -1,
					target_elm     : arg.t,
					func_callback  : arg.func,
                    folder         : arg.fdf,
                    multi_select   : arg.m
				});
			});
			ed.addCommand('mceTrImg', function() {
				// Internal image object like a flash placeholder
				if (ed.dom.getAttrib(ed.selection.getNode(), 'class').indexOf('mceItem') != -1)
					return;

				ed.windowManager.open({
					file : url + '/index.htm',
					width : 870 ,
					height : 450,
					inline : 1
				}, {
					plugin_url : url,
					multi_select : true
				});
			});

			// Register buttons
			ed.addButton('insertimage', {
				title : 'advimage.image_desc',
				cmd : 'mceTrImg',
				image : url+'/img/sample.png'
			});
		},

		getInfo : function() {
			return {
				longname : 'Advanced image',
				author : 'pntrinh',
				authorurl : 'pntrinh',
				infourl : 'pntr',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('trplugins', tinymce.plugins.TrinhPlugin);
})();