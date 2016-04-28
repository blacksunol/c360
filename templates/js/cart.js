$(function(){
	$(".label_user").click(function(){
		$(this).parent().find(".info_user").toggle();	
	});
	
    $(".btn_cart").click(function(){
        var id = $(".pid").val();
		var id_picture = $(".id_picture").val();
		var picture = $(".picture").val();
        window.location.href=baseUrl+'/news/cart/add-item/id/'+id+"/id_picture/"+id_picture+'/picture/'+picture;
    });
    $(".btn_cart_die").click(function(){
        alert("Đã hết hàng vui lòng chọn sản phẩm khác");
    });
});
function doDelete(id) {
    var url = baseUrl+'/news/cart/delete';
    jQuery.ajax({
        url: url,
        type: 'GET',
        data: {id:id},
        async:false,
        success: function(){
            jQuery('.load-delete').load(url+'?id='+id);
        }
    });
}
function doClear() {
    if(confirm('Hủy giỏ hàng')){
        var url = baseUrl+'/news/cart/clear';
        jQuery.ajax({
            url: url,
            type: 'GET',
            async:false,
            success: function(){
                jQuery('.load-delete').load(url);
            }
        });
    }
}

function doContinue() {
	window.history.back()
}

function doCheckOut() {
	window.location.href = baseUrl+'/dat-hang-truc-tuyen.html';
}
function getDistrict(id){
    var url =baseUrl+'/news/cart/ajax-district';
    jQuery.ajax({
        url:url,
        type:"POST",
        data:{id:id},
        async:false,
		dataType:"json",
        success:function(f)
        {
			if(f.error==0){
            	jQuery('.district').html(f.html);
				jQuery('.ward').html(f.html_ward); 
			}
        }
    });
}
function getWard(id){
    var url =baseUrl+'/news/cart/ajax-ward';
    jQuery.ajax({
        url:url,
        type:"POST",
        data:{id:id},
        async:false,
		dataType:"json",
        success:function(f)
        {
			if(f.error==0){
            	jQuery('.ward').html(f.html); 
			}
        }
    });
}