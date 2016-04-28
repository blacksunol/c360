function fuc_upload_pr(obj)
{
    getId(obj.t).value=obj.p+obj.f;
    getId("divimg_"+obj.t).style.display='';
    getId("ImgV_"+obj.t).src=obj.r+obj.p+obj.f;
}
function getId(id)
{
    return document.getElementById(id);
}
function uploadImg(id,fol,val,foldf)
{
    if(val==undefined ||val=="")getId(id).value="";
    var stid=(val!=undefined && val.length>0)?'':"display:none";
    document.write('<input type="button" onclick="tinyMCE.execCommand(\'mceTrImgC\',{t: \''+id+'\',func:fuc_upload_pr,fdf: \''+foldf+'\',m:false})" value="Choose Image" class="b1"/><br> ');
    document.write('<span id="divimg_'+id+'" style="'+stid+'" class="img_upload"> <img src="'+fol+val+'" id="ImgV_'+id+'" width="126" height="100" /><br>');
    document.write('<a class="img_upload" href="javascript:;" onclick="getId(\''+id+'\').value=\'\';getId(\'divimg_'+id+'\').style.display=\'none\'" >remove</a></span>');   
}

function infoImg(pic_id,id,fol,val,foldf)
{
    if(val==undefined ||val=="")getId(id).value="";
    var stid=(val!=undefined && val.length>0)?'':"display:none";
    document.write('<span id="divimg_'+id+'" style="'+stid+'" class="img_view"> <img src="'+fol+val+'" id="ImgV_'+id+'" width="126" height="100" /><br>');
    document.write('<a class="img_upload" href="javascript:;" onclick="getId(\''+id+'\').value=\'\';getId(\''+pic_id+'\').value=\'\';getId(\'divimg_'+id+'\').style.display=\'none\'" >remove</a></span>');   
}

function getOption_3(tau){
    var url =baseurl+'/cruises/admin-feedback/ajax-option3';
    $.ajax({
        url:url,
        type:"GET",
        data:"tau="+tau,
        async:false,
        success:function()
        {
            $('#option_3').load(url+"?tau="+tau); 
        }
    });
}
function getCabin(id_cabin){
    var url =baseurl+'/activities/admin-cruisesday/ajax-cabin';
    $.ajax({
        url:url,
        type:"GET",
        data:"id_cabin="+id_cabin,
        async:false,
        beforeSend: function(){
            $('#cabin').html('<div align="center"><img src="'+baseurl+'/public/templates/shopbest/images/icon-loading.gif"></div>');
        },
        success:function()
        {
            $('#cabin').load(url+"?id_cabin="+id_cabin); 
        }
    });
}
$(document).ready(function(){
    $('#check_1').click(function(){
        $('input[name="check_1"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_2').click(function(){
        $('input[name="check_2"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_3').click(function(){
        $('input[name="check_3"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_4').click(function(){
        $('input[name="check_4"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_5').click(function(){
        $('input[name="check_5"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_6').click(function(){
        $('input[name="check_6"]').val($(this).is(':checked') ? '1' : '0' );
    });
    $('#check_7').click(function(){
        $('input[name="check_7"]').val($(this).is(':checked') ? '1' : '0' );
    });
});