var Lightboxt = {
    domain_image:'',
    selector: null,
    isInit: false,
    delay : null,
    type : "html", // default type
    init : function() {
        if (jQuery('#box').length > 0) {
            jQuery('#box').appendTo('body');
        } else {
            Lightboxt.generate();
        }

        if (jQuery("#box").css("position") == "absolute") {
            jQuery(window).scroll(function () {
                jQuery("#box").css("top", jQuery(document).scrollTop() + "px");
            });
        }
        this.isInit = true;
    },
    setConfig: function(data) {
        if (typeof(data.selector) != 'undefined') {
            this.selector = data.selector;
        }

        if (data.type) {
            this.type = data.type;
        }
    },
    generate: function() {
        jQuery('body').append('<div class="bigbox" id="box">'
            + '<iframe frameborder="0" class="windowmask"></iframe><div class="windowmask"></div>'
            + '<div class="contentbox Lightboxt contLightboxt01" id="Lightboxt">'
            + '<div class="lbcont" id="lbcontent">'
			+ '<div class="Lightboxt-border">'
			+ '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
			+ '<tr><td class="tl"></td><td class="b"></td><td class="tr"></td></tr>'
			+ '<tr><td class="b"></td><td class="bbody"><div class="Lightboxt-boxhead"><div class="tlc"><div class="trc"><div class="boxhead-content"><div class="right_box"><a href="javascript:;" onclick="Lightboxt.hide()" ><img src="'+TEMPLATE_URL+'/images/buttons/blank_img.gif" alt="" height="1" width="1" class="close-btn" align="right" border="0" /></a></div><div class="boxhead-content-main"></div></div></div></div></div><div class="Lightboxt-boxbody"></div></td><td class="b"></td></tr>'
            + '<tr><td class="bl"></td><td class="b"></td><td class="br"></td></tr>'
            + '</table>'
			+ '</div>'
			+ '</div>'
			+ '</div>'
            );
    },
    setWidth: function(lbgWidth) {
        jQuery('#Lightboxt').css('width', lbgWidth ? lbgWidth : 'auto');
    },
    setHeight: function(lbgHeight) {
        jQuery('.Lightboxt-boxbody').css('height', lbgHeight ? lbgHeight : 'auto');
    },
    show : function(boxId,title, msgWidth, msgHeight) {

        jQuery('.boxhead-content-main').html(title);

        if (this.type == 'iframe') {
            var url = boxId;
            if (!url){
                return false;
            } else {
                var width = (msgWidth) ? parseInt(msgWidth) - 20 : 430;
                var height = (msgHeight) ? parseInt(msgHeight) : 300;
                var html = "<iframe width='" + width + "' height='" + height + "' src='" + url + "' style='border: none' frameborder='0'></iframe>";
                jQuery('.Lightboxt-boxbody').html(html);
            }
        } else {

            if (msgHeight) {
                this.setHeight(parseInt(msgHeight));
            }
            
            if(this.type == 'html') {
                jQuery('.Lightboxt-boxbody').html(jQuery("#" + boxId).html());
            } else if(this.type == 'text') {
                jQuery('.Lightboxt-boxbody').text(jQuery("#" + boxId).html());
            }// define more type here
        }
        
        
        Lightboxt.setWidth(parseInt(msgWidth)+18 || 300);
        var elem = jQuery('#Lightboxt');

        elem.parent(this).fadeIn(200);
        jQuery(window).bind("resize", function(){
            Lightboxt.setPos(elem);
        });
        
        Lightboxt.setPos(elem);        

        if (jQuery('.btngreen:first', elem).focus()[0] == undefined) {
            if (jQuery('span.btngray:first > input', elem).focus()[0] == undefined) {
                jQuery('input.cancel:first', elem).focus();
            }
        }
    },
    hide:function() {
        jQuery('#Lightboxt').parent(this).fadeOut(200);
    },
    setPos: function(elem){
        
        var top = (document.documentElement.clientHeight - elem.height()) / 2;
        var left = (document.documentElement.clientWidth - elem.width()) / 2;
        if (top < 0) top = 0;
        if (left < 0) left = 0;
        elem.css({
            'left' : left + 'px',
            'top' : top + 'px'
        });
    },
    showemsg: function(title, content, namebtn){
        var errbox =
        '<div class="main_content_suscess">'
        +   '<div class="box_title">'+content+'</div><div class="nut_dong">'
        +   '<table width="28%" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;" class="list-button">'
        +    '<tr>'
        +     '<td><div class="sidebutton"><div class="txt_bottom txt_note txt_center"><input name="huy" type="button" value="'+namebtn+'" class="nbutton" onclick="Lightboxt.hide()"  /></div></div></td>'
        +    '</tr>'
        +   '</table>'
        +  '</div></div>';

        jQuery('.boxhead-content-main').html(title);
        jQuery('.Lightboxt-boxbody').html(errbox);

        Lightboxt.setWidth(38);
        var elem = jQuery('#Lightboxt');
        elem.parent(this).fadeIn(200);
        Lightboxt.setPos(elem);
    }
};

jQuery(document).ready(function(){
    if (!Lightboxt.isInit) {
        Lightboxt.init();
    }

    jQuery("[Lightboxt]").click(function(){
        if (!jQuery(this).attr("onclick")) {
            Lightboxt.setConfig({
                selector: jQuery(this),
                type: jQuery(this).attr("rel") || "html"
            });
            var params = jQuery.map(jQuery(this).attr("Lightboxt").split(","), jQuery.trim);                                    
            Lightboxt.show(params[0], params[1], params[2]);
        }
    });
});