var path_Curent="";
var path_root ="";
var page_Curent=1;
var url_root=tinyMCEPopup.getWindowArg('plugin_url');
var script_upload=tinyMCE.settings.script_image_upload;
var multi_select =tinyMCEPopup.getWindowArg('multi_select');
var folderdf    = tinyMCEPopup.getWindowArg('folder');
function init()
{
    if(path_Curent=="" && folderdf!=undefined)
    {
        path_Curent=folderdf;
    }
	LoadFolderByFolderP();
	if(multi_select==true)
	{
		getId("multi_select_div").innerHTML='<input type="button" class="b1" value="Insert" onclick="multiInsertClick()" />';
	}
}
function getId(id)
{
	try{
		obj=document.getElementById(id);
		vl=obj.value;
	}catch(e)
	{
		obj=false;
	}
	return obj;
}
function GetXmlHttpObject()
{
    var xmlHttp = null;
    try {
        xmlHttp = new XMLHttpRequest()
    }
    catch (e)
    {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")
        }
        catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request")
    }
    return xmlHttp
}
function ajaxLoader(url, post, loader, alertdiv, func,img)
{
    http = GetXmlHttpObject();
    if (post == "") {
        http.open("GET", url, true)
    }
    else
    {
        http.open("POST", url, true);
        http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    }
    http.onreadystatechange = function ()
    {
        if (http.readyState == 1)
        {
            try
            {
				if(img==undefined)img="img/loading2.gif";
                getId(alertdiv).innerHTML = '<img src="'+img+'" border=0/>'
            }
            catch (e) {}
        }
        if (http.readyState == 4)
        {
            var datares = http.responseText;
            try {
                getId(alertdiv).innerHTML = ''
            }
            catch (e) {}
            try {
                eval(func + "(datares)")
            }
            catch (e) {}
            try {
                getId(loader).innerHTML = datares
            }
            catch (e) {}
            try
            {
                arrscr = (datares).split("<script>");
                arrscr = (arrscr[1]).split("</script>");
                eval(arrscr[0])
            }
            catch (e) {}
        }
    };
    http.send(post)
}

function openPI(url,w,h) {
    var wm = tinyMCE.activeEditor.windowManager;
    wm.open(
        {
            file : url_root+"/"+url,
            width : w,
            height : h,
            inline : 1
        },
        {
            plugin_url : url_root, // Plugin absolute URL
            func : function (e)
            {
               LoadFolderByFolderP();
            }
        }
    );
}

function LoadFolderByFolderP(folderP)
{
	if(folderP==undefined)folderP=path_Curent;
	post="folderP="+folderP+"&page="+page_Curent;	
	Html="<img src='img/loading2.gif'>";
	getId('listfolder').innerHTML=Html;
	getId('listfile').innerHTML=Html;
	ajaxLoader(script_upload+"?opt=listfolder",post,"", "","proLoadFolder");
}

function proLoadFolder(str)
{
	arr=str.split("(*_*)");
	path_root=arr[1];
	path_Curent=arr[2];
	list_folder=arr[3];
	list_file=arr[4];
	getId("selectedfolder").innerHTML="/"+path_Curent;
	ShowListFolder(list_folder);
	ShowListFile(list_file);
}
function ShowListFolder(list)
{
	arr=list.split("|");
	Html="";
	for(i=0;i<arr.length-1;i++)
	{
		foldern=arr[i];
		Html+="<div><a class='folder' href='#' onclick='LoadFolderByFolderP(\""+path_Curent+foldern+"\")'>"+foldern+"</a><div style='float:right'><a href=# onclick='deletefolder(\""+foldern+"\")'>del</a></div></div>";
	}
	getId('listfolder').innerHTML=Html;
}
function ShowListFile(list)
{
	arr=list.split("|");
	Html="";
	if(arr.length==1)
	{
		Html+="Not found Image File in this Folder!";
	}
	for(i=0;i<arr.length-1;i++)
	{
		arr2=(arr[i]).split("^^");
		filen=arr2[0];
		imgw=arr2[1];
		imgh=arr2[2];
		pdt=100/2-imgh/2;
		Html+="<div class='fileimg'><div class='bok' align=center>";
		Html+="<div class='dimg' style='padding-top: "+pdt+"px;padding-bottom: "+pdt+"px'>";
		Html+="<img onclick='insertimg(\""+path_Curent+"\",\""+filen+"\")' ";
		Html+="src='"+path_root+path_Curent+"thumbs/"+filen+"' title='Click to add'";
		Html+=" width='"+imgw+"' height='"+imgh+"'></div>";
		Html+="<div class='fimgname'>"+filen.substr(0,20)+"</div>";
		Html+="<div>";
		if(multi_select==true)
		{
			Html+="<div style='float:left'><input id='seli_"+i+"' type='checkbox' value='"+filen+"'/></div>";
			Html+="<input type='hidden' id='pathh_"+i+"' value='"+path_Curent+"'/>";
		}
		Html+="<a href=#>Edit</a> - <a href=# onclick='deleteimg(\""+filen+"\")'>Delete</a></div>";
		Html+="</div></div>";
	}
	getId('listfile').innerHTML=Html;
}
function deletefolder(fname)
{
	if(confirm("Do you want delete?")==false)return;
	post="folderP="+path_Curent+"&fname="+fname;	
	ajaxLoader(script_upload+"?opt=deletefolder",post,"", "","proDelete");
}
function proDelete(str)
{
	arr=str.split("(*_*)");
	if(arr[1]=="ok")
	{
		LoadFolderByFolderP();
		alert(arr[2]);
	}else
	{
		alert(arr[2]);
	}
}
function deleteimg(fname)
{
	if(confirm("Do you want delete?")==false)return;
	post="folderP="+path_Curent+"&file="+fname;	
	ajaxLoader(script_upload+"?opt=deletefile",post,"", "","proDelete");
}


function checkcreatefolder(f)
{
	if(f.foldercreate.value=="")
	{
		alert("Please enter folder name");
		return false;
	}
	f.action=script_upload+'?opt=createfolder';
}

function creatfolsuccess(bl,msg)
{
	if(bl==true)
	{
		f = tinyMCEPopup.getWindowArg('func');
		tinyMCEPopup.restoreSelection();
		if (f)f();
		tinyMCEPopup.close();
		return;
	}
	document.getElementById("error").innerHTML=msg;
}
function popupCreateFolder(w,h)
{
	var wm = tinyMCE.activeEditor.windowManager;
    wm.open(
        {
            file : url_root+'/createfolder.htm',
            width : w,
            height : h,
            inline : 1
        },
        {
            plugin_url : url_root, // Plugin absolute URL
			path_parent: path_Curent,
			func : function (e)
            {
               LoadFolderByFolderP();
            }
        }
    );
}

function popupUpload(w,h)
{
	var wm = tinyMCE.activeEditor.windowManager;
    wm.open(
        {
            file : url_root+'/upload.htm',
            width : w,
            height : h,
            inline : 1
        },
        {
            plugin_url : url_root, // Plugin absolute URL
			path_upload: path_Curent,
            func : function (e)
            {
               LoadFolderByFolderP();
            }
        }
    );
}

function insertimg(path,file)
{	
	insertImgtoEditer(path,file);
	tinyMCEPopup.close();
}

function insertImgtoEditer(path,file) {
	option_o=tinyMCEPopup.getWindowArg('option_o');
	func_callback=tinyMCEPopup.getWindowArg('func_callback');
	target_elm=tinyMCEPopup.getWindowArg('target_elm');
	if(option_o==-1)
	{
		func_callback({r:path_root,p:path,f:file,t:target_elm});
		return;
	}
	var ed = tinyMCEPopup.editor;
	var v, args = {}, el;
	tinyMCEPopup.restoreSelection();

	// Fixes crash in Safari
	if (tinymce.isWebKit)
		ed.getWin().focus();
		
	tinymce.extend(args, {
			src : path_root+path+file
		});

	el = ed.selection.getNode();

	if (el && el.nodeName == 'IMG') {
		ed.dom.setAttribs(el, args);
	} else {
		ed.execCommand('mceInsertContent', false, '<img id="__mce_tmp" />', {skip_undo : 1});
		ed.dom.setAttribs('__mce_tmp', args);
		ed.dom.setAttrib('__mce_tmp', 'id', '');
		ed.undoManager.add();
	}
}

function multiInsertClick()
{
	count=0;
	for(i=0;i<100;i++)
	{
		if((obj=getId('seli_'+i))==false)break;
		if(obj.checked)
		{
			var filet=obj.value;
			var patht=getId('pathh_'+i).value;			
			insertImgtoEditer(patht,filet);
			count++;
		}
	}
	if(count==0)
	{
		alert("Please choose Image");
		return false;
	}
	tinyMCEPopup.close();
}