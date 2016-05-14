jQuery(function(){
    jQuery('.btn_search').click(function(){
        var keyword = "";
        var key = jQuery(".inputSearch").val();
		
        if(key!=""){
            keyword = "&q="+key; 
        }
        window.location.href = baseUrl+"/index.php?module=shopping&act=search"+keyword;
    });
    jQuery('input.inputSearch').keypress(function(event) {
        if (event.keyCode == '13') {
                jQuery('.btn_search').click();
                return false;
        }
        return true;
    });
});

function optionSearchAjax(id_price,id_page){
	var cid = $(".cid").val();
	var url = baseUrl+"/news/index/show-option";
	$.ajax({
		type:"POST",
		url :url,
		data:{cid:cid,id_price:id_price,id_page:id_page},
		dataType:"json",
		beforeSend: function () {
			$(".load_product").html("<img src='"+TEMPLATE_URL+"/baolong/images/ajax_loader.gif' border='0'/>");
		},
		success:function(f){
			if(f.error==0){
				$(".load_product").html(f.html);
			}
		}
	});
}
function optionPrice(id_price){
	$(".optionPrice").val(id_price);
	var id_page = $(".optionPage").val();
	optionSearchAjax(id_price,id_page);
}
function optionPage(id_page){
	$(".optionPage").val(id_page);
	var id_price = $(".optionPrice").val();
	optionSearchAjax(id_price,id_page);
}
function getSegment(special,page){
	var url = baseUrl+"/news/index/load/special/"+special+"/page/"+page;
	$.ajax({
		type:"POST",
		url :url,
		data:{special:special,page:page},
		dataType:"json",
		beforeSend: function () {
			$(".load_product_"+special).html("<img src='"+TEMPLATE_URL+"/baolong/images/ajax_loader.gif' border='0'/>");
		},
		success:function(f){
			if(f.error==0){
				$(".load_product_"+special).html(f.html);
			}
		}
	});
} 
function getProductPage(page){
	var url = baseUrl+"/news/index/load-detail/page/"+page;
	var cid = $(".cid").val();
	var id = $(".product_id").val();
	$.ajax({
		type:"POST",
		url :url,
		data:{cid:cid,id:id,page:page},
		dataType:"json",
		beforeSend: function () {
			$(".load_product").html("<img src='"+TEMPLATE_URL+"/baolong/images/ajax_loader.gif' border='0'/>");
		},
		success:function(f){
			if(f.error==0){
				$(".load_product").html(f.html);
				jQuery(".content_product").animate({ scrollTop: 200 }, 600);
			}
		}
	});
}
function getProductList(page){
	var cid = $(".cid").val();
	if($(".optionPage").val()>=0 && $(".optionPrice").val()>=0){
		var url = baseUrl+"/news/index/show-option";
		var id_page = $(".optionPage").val();
		var id_price = $(".optionPrice").val();
		var k = {cid:cid,page:page,id_page:id_page,id_price:id_price};	
	}else{
		var url = baseUrl+"/news/index/load-product/page/"+page;
		var k = {cid:cid,page:page};	
	}
	$.ajax({
		type:"POST",
		url :url,
		data:k,
		dataType:"json",
		beforeSend: function () {
			$(".load_product").html("<img src='"+TEMPLATE_URL+"/baolong/images/ajax_loader.gif' border='0'/>");
		},
		success:function(f){
			if(f.error==0){
				$(".load_product").html(f.html);
				jQuery(".content_product").animate({ scrollTop: 200 }, 600);
			}
		}
	});
}