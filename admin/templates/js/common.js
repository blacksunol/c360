function SendToFriend(bol)
{
var frame=document.getElementById("send");
if(frame)
{
frame.src="ascx/SendToFriend.aspx";
if(bol==true)
frame.style.display="";
else  frame.style.display="none";
}
}
var Javascript={
formCheck: function(theform)
{
var alertMsg =" Thông tin chưa đầy đủ. (*) là thông tin bắt buộc.";
if (document.all||document.getElementById)
{
for (i=0;i<theform.length;i++)
{
var __obj=theform.elements[i];
if(__obj && __obj.type)
{
switch(__obj.type.toLowerCase())
{
case "text":
case "password":
case "textarea":
{
var isnull=__obj.getAttribute? __obj.getAttribute("isnull") : "";
if(isnull && isnull=="False")
{
if(__obj.value=="" || __obj.value==null)
{
alert(alertMsg);
__obj.focus();
return false;
}
}
var compare=__obj.getAttribute? __obj.getAttribute("compare") : "";
if (compare)
{
var array=compare.split("|");
var id0=array[0];
var id1=array[1];
if(id0 && id1)
{
if(document.getElementById(id0).value!=document.getElementById(id1).value)
{
alert("Xác nhận mật khẩu không chính xác");
document.getElementById(id1).focus();
return false;
}
}
}
var __mode=__obj.getAttribute? __obj.getAttribute("mode") : "";
if(__mode && __mode=="0-9")
{
var validcode=/^[0-9]$/i;
if(__obj && validcode.test(__obj.value)==false)
{
alert("Kiểm tra kiểu số nhập vào");
__obj.focus();
__obj.style.color='red';
return false;
}
else __obj.style.color='black';
}
if(__mode && __mode=="a-z0-9")
{
var az=/^[a-z0-9_]+$/;
if(__obj && az.test(__obj.value)==false)
{
alert("Tên truy cập phải là ký tự từ a->z và từ 0->9, ký tự _, viết liền, viết không dấu. ");
__obj.focus();
__obj.style.color='red';
return false;
}
else __obj.style.color='black';
}
var __minlen=__obj.getAttribute? __obj.getAttribute("minlen") : "";
if(__minlen && __minlen=="6")
{
var len=/^.{6,}$/;
if(__obj && len.test(__obj.value)==false)
{
alert("Mật khẩu ít nhất phải 6 kí tự.");
__obj.focus();
__obj.style.color='red';
return false;
}
else __obj.style.color='black';
}
var __minlen1=__obj.getAttribute? __obj.getAttribute("minlen1") : "";
if(__minlen1 && __minlen1=="6")
{
var len1=/^.{6,}$/;
if(__obj && len1.test(__obj.value)==false)
{
alert("Tên tài khoản phải ít nhất 6 kí tự.");
__obj.focus();
__obj.style.color='red';
return false;
}
else __obj.style.color='black';
}
if(__mode && __mode=="number")
{
var number=/^\d+$/;
if(__obj && number.test(__obj.value)==false)
{
alert("Kiểu số không hợp lệ");
__obj.focus();
__obj.style.color='red';
return false;
}
else __obj.style.color='black';
}
if(__mode && __mode=="name")
{
var personname=/^([a-záàảãạăắằẳẵặâấầẩẫậđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ]+(?: |$)){2,}$/i;
if (__obj && personname.test(__obj.value)==false)
{
alert("Tên không hợp lệ");
__obj.focus();
__obj.style.color='red';
return false;
}	else __obj.style.color='black';
}
if(__mode && __mode=="email")
{
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
if (__obj && emailfilter.test(__obj.value)==false)
{
alert("Email không hợp lệ.");
__obj.focus();
__obj.style.color='red';
return false;
}	else __obj.style.color='black';
}
if(__mode && __mode=="date")
{
var _date=/^((?:(?:0?[1-9]|[1-2]\d|30|31)\/(?:0?[13578]|10|12))|(?:(?:0?[1-9]|[1-2]\d|30)\/(?:0?[459]|11))|(?:(?:0?[1-9]|[1-2]\d)\/0?2))\/\d{4}$/;
if (__obj && _date.test(__obj.value)==false)
{
alert("Ngày tháng không hợp lệ. Ngày phải là: dd/mm/yyyy.");
__obj.focus();
__obj.style.color='red';
return false;
}	else __obj.style.color='black';
}
}
break;
case "select-one":
var ___isnull=__obj.getAttribute? __obj.getAttribute("isnull") : "";
if(___isnull && ___isnull=="False")
{
if ( __obj.options[__obj.selectedIndex].text == "")
{
__obj.focus();
alert(alertMsg);
return false;
}
}
break;
case "select-multiple":
var ___isnull1=__obj.getAttribute? __obj.getAttribute("isnull") : "";
if(___isnull1 && ___isnull1=="False")
{
if (__obj.selectedIndex == -1)
{
alert(alertMsg);
return false;
}
}
break;
case "checkbox":
var __isnull=__obj.getAttribute? __obj.getAttribute("isnull") : "";
if(__isnull && __isnull=="False")
{
if(__obj.checked==false)
{
alert("Bạn phải đồng ý với điều khoản");
return false;
}
}
break;
}
}
}
}
},
ReSizeIframe: function(obj)
{
if(obj)
{
obj.width="99%";
if(navigator.userAgent.indexOf("Opera")!=-1)
{
obj.height=obj.contentWindow.document.body.scrollHeight;
}
else  obj.height=obj.contentWindow.document.body.scrollHeight+340;
}
},
Bookmarksite: function(title,url)
{
if (window.sidebar)
window.sidebar.addPanel(title, url, "");
else if(window.opere && window.print){
var elem = document.createElement('a');
elem.setAttribute('href',url);
elem.setAttribute('title',title);
elem.setAttribute('rel','sidebar');
elem.click();
}
else if(document.all)
window.external.AddFavorite(url, title);
},
win:null,
NewWindow: function(url,name,w,h,scroll,pos)
{
if(pos=="random")
{
LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;
TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;
}
if(pos=="center")
{
LeftPosition=(screen.width)?(screen.width-w)/2:100;
TopPosition=(screen.height)?(screen.height-h)/2:100;
}
else if((pos!="center" && pos!="random") || pos==null)
{
LeftPosition=0;
TopPosition=20
}
settings='width='+ w +',height='+ h +',top='+ TopPosition +',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(url,name,settings);
}
};
function textLimit(field, maxlen) {
if (field.value.length > maxlen + 1)
if (field.value.length > maxlen)
field.value = field.value.substring(0, maxlen);
}