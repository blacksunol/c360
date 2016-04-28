$(document).ready(function() {
    $('#ratelinks li a').click(function(){
        $.ajax({
            type: "POST",
            url: baseUrl+'/index.php?module=shopping&act=vote',
            data: {rating:$(this).text(),id_product:id_product,ajax:1},
            dataType:"json",
            error: function(result) {
                alert("Đã xảy ra lỗi");
            },
            beforeSend:function(){
                $('.loading_warning').show();
            },
            success: function(f) {
                $('.loading_warning').hide();
                $("#ratelinks").remove();
                $("#current-rating").css({ width: "" + f.percent + "%" });
            }
        });
    });
});
