function fCheckComment(a){
    valid = true;
    var a=jQuery(a);
    var b=a.find(".name");
    var c=a.find(".email");
    var content=a.find(".noidung");
	var id_product = a.find(".id_product");
    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    resetFCommentPro(a);
    if(b.val()==""){
        valid = false;
        b.attr("style","border:1px solid #f90");
        a.find(".fullname_err").text("Vui lòng nhập họ tên");
    }
    if(c.val()==""){
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
    if(content.val()==""){
        valid = false;
        content.attr("style","border:1px solid #f90");
        a.find(".noidung_err").text("Vui lòng nhập nội dung"); 
    }
    
    var j=a.attr("action");    
    var k={
		fullname:b.val(),
		email:c.val(),
		content:content.val(),
		id_product:id_product.val()
   };
	jQuery.ajax({
		url:j,type:"POST",
		data:k,
		dataType:"json",
		success:function(f){
			if(f.status==true){
				//Lightboxt.showemsg('Thành công', '<b>'+f.messg+'</b>', 'Đóng');
				refreshComment(a);
				$(".list_comment").html(f.html)
			}
			a.find("div.refresh_code").trigger("click")},
			error:function(b,c,d){
				a.find(".msg").text("Máy chủ bị lỗi, xin vui lòng thử lại.").fadeIn()
			}
	});
	return valid;
}
function resetFCommentPro(a){
    a.find(".msg").text("");
    a.find(".name").attr("style","border:1px solid #ddd");
    a.find(".fullname_err").text("");
    a.find(".email").attr("style","border:1px solid #ddd");
    a.find(".email_err").text("");
    a.find(".noidung").attr("style","border:1px solid #ddd");
    a.find(".noidung_err").text("")
}
function refreshComment(a) {
	a.find("#name").val('');
	a.find("#email").val('');
	a.find("#noidung").val('');
}