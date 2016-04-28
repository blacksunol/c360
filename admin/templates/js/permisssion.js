function loadFunction(url,id_user,id_permisssion){
    $.ajax({
        url:url,
        type:"POST",
        data:{id_user:id_user,id_permisssion:id_permisssion},
        dataType:"json",
        success:function(f){
            location.reload(); 
        }
    });
}
function loadModuleFunction(url,id_user,module){
    $.ajax({
        url:url,
        type:"POST",
        data:{id_user:id_user,module:module,multi:"multi"},
        dataType:"json",
        success:function(f){
             //location.reload(); 
        }
    });
}