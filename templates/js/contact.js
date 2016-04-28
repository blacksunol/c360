function capture()
{
    var a=new ActiveXObject("ActiveScreen.Capturer");
    a.CaptureScreen();
    var b=a.SaveToFile("test1.jpg");
    WScript.Echo("Image Size = "+b.toString()+"\r\n")
}
function editorBoxComment()
{
    jQuery("#content").cleditor({width:"643",height:"180"})
}
function fCheck(a)
{
    valid = true;
    var a=jQuery(a);
    var b=a.find(".name");
    var c=a.find(".email");
    var ad=a.find(".address");
    var p=a.find(".phone");
    var t=a.find(".title_hoi");
    var content=a.find(".noidung");
    var d=a.find(".macode");
    var f=a.find("#captchaID");
	var topic = a.find(".topics");
    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    resetFComment(a);
    if(b.val()=="")
    {
        valid = false;
        b.attr("style","border:1px solid #f90");
        a.find(".fullname_err").text("Vui lòng nhập họ tên");
       
    }
    
    if(ad.val()=="")
    {
        valid = false;
        ad.attr("style","border:1px solid #f90");
        a.find(".address_err").text("Vui lòng nhập địa chỉ");
       
    }
    if(p.val()=="")
    {
        valid = false;
        p.attr("style","border:1px solid #f90");
        a.find(".phone_err").text("Vui lòng nhập số điện thoại");
       
    }
    if(c.val()=="")
    {
        valid = false;
        c.attr("style","border:1px solid #f90");
        a.find(".email_err").text("Vui lòng nhập email");
       
    }else{
        if(!pattern.test(c.val())){
            valid = false;
            c.attr("style","border:1px solid #f90");
            a.find(".email_err").text("Địa chỉ email không hợp lệ");

        }
    }
    
    if(t.val()=="")
    {
        valid = false;
        t.attr("style","border:1px solid #f90");
        a.find(".title_err").text("Vui lòng nhập tiêu đề");
       
    }
    
    if(content.val()=="")
    {
        valid = false;
        content.attr("style","border:1px solid #f90");
        a.find(".noidung_err").text("Vui lòng nhập nội dung");
       
    }
    
    
    var j=a.attr("action");
    
    var k={
            fullname:b.val(),
            email:c.val(),
            address:ad.val(),
            phone:p.val(),
            title:t.val(),
            content:content.val(),
            captcha:d.val(),
            captchaID:f.val(),
            topic:topic.val()
           };
        jQuery.ajax({
            url:j,type:"POST",
            data:k,
            dataType:"json",
            
            success:function(f)
            {
                if(f.status==true)
                {
                    Lightboxt.showemsg('Thành công', '<b>Liên hệ thành công</b>', 'Đóng');
                    refresh(a);
                }
                a.find("div.refresh_code").trigger("click")},
            error:function(b,c,d)
            {
                a.find(".msg").text("Máy chủ bị lỗi, xin vui lòng thử lại.").fadeIn()
            }
        }
    );
        return valid;
}
function cancelBoxComment(a)
{
    jQuery(a).parent().parent().parent().fadeOut()
}
function hideBoxComment(a)
{
    a.parent().parent().fadeOut()
}
function resetFComment(a)
{
    a.find(".msg").text("");
    
    a.find(".name").attr("style","border:1px solid #ddd");
    a.find(".fullname_err").text("");
    
    a.find(".address").attr("style","border:1px solid #ddd");
    a.find(".address_err").text("");
    
    a.find(".phone").attr("style","border:1px solid #ddd");
    a.find(".phone_err").text("");
    
    a.find(".email").attr("style","border:1px solid #ddd");
    a.find(".email_err").text("");
    
    a.find(".title_hoi").attr("style","border:1px solid #ddd");
    a.find(".title_err").text("");
    
    a.find(".topics").attr("style","border:1px solid #ddd");
    a.find(".topics_err").text("");
    
    a.find(".macode").attr("style","border:1px solid #ddd");
    a.find(".captcha_err").text("");
    
    a.find(".noidung").attr("style","border:1px solid #ddd");
    a.find(".noidung_err").text("")
}
function refresh(a) {
        a.find("#name").val('');
        a.find("#address").val('');
        a.find("#phone").val('');
        a.find("#email").val('');
        a.find("#title").val('');
        a.find("#topics").val('');
        a.find("#file").val('');
        a.find("#noidung").val('');
        a.find("#captcha").val('');
}
function refreshCode(a)
{
    var b=jQuery(a).parent().parent();
    var c=b.find(".captchaID").val();
    var d=b.attr("rel");
    b.find("div.image_code").load(d+"/captchaID/"+c)
}
jQuery(document).ready(function(){
    jQuery("#bComment").click(function(){
        jQuery(".comment_box").html("").show();
        var a=jQuery(this).attr("action");
        var b=jQuery(this).attr("rel");
        jQuery("#dCommment").load(a,{rel:b}).show("slide",{},500)
    });
    jQuery(".btnReply").click(function(){
        jQuery(".comment_box").html("").show();
        var a=jQuery(this).attr("action");
        var b=jQuery(this).attr("rel");
        var c=jQuery(this).attr("id").replace("btnReply","");
        jQuery("#dComment"+c).load(a,{rel:b}).show("slide",{},500)
    });
    jQuery(".btnDel").click(function()
    {
        var a=jQuery(this).attr("action");
        var b=jQuery(this).attr("id").replace("btnDel","");
        jQuery.post(a,{comment:b},
        function(a)
        {
            if(a.status)
            {
                jQuery("#reply"+b).fadeOut()   
            }
            else
            {
                if(a.status==false)alert(a.msg)
            }
        },
        "json")
    })
})
function showme(the_url, the_width, the_height, the_menu) {
	if ( the_width == 0 ){
		the_width	= screen.width;
	}
	if ( the_height == 0 ){
		the_height	= screen.height;
	}

	left_val	= (the_width > 0) ? (screen.width - the_width)/2 : 0;
	top_val		= (the_height > 0) ? (screen.height - the_height)/2 - 30 : 0;
	if (top_val < 0){ top_val	= 0; }
	if (the_menu == ""){ the_menu	= "no";	}

	window.open(the_url, "", "menubar="+ the_menu +", toolbar="+ the_menu +", scrollbars=yes, resizable=yes, width="+ the_width +", height="+ the_height +", top="+ top_val +", left="+ left_val);
}