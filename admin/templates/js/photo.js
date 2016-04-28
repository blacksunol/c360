var orderrow=0;
var addrow=function (obj)
{
    if(obj.id==undefined)obj.id=-1;
	tblroot=getId("tblsort").tBodies[0];
	var newtr=document.createElement("tr");
	newtr.className='row_'+(orderrow%2);
	var newtd=document.createElement("td");
	newtd.innerHTML="<img src='"+obj.r+obj.p+obj.f+"' width=30 height=30 onclick=\"openPI('file','"+obj.r+obj.p+obj.f+"',400,300)\">";
	newtr.appendChild(newtd);

	var newtd=document.createElement("td");
	var inputlname=document.createElement("input");
        var inputlid=document.createElement("input");
	inputlname.className="edit txtmedium_left";
	inputlname.name="ListName[]";
        inputlname.type="text";
        inputlname.value=obj.f;
        if(obj.n!=undefined)
        {
            inputlname.value=obj.n;
        };
	inputlname.onclick = function(){ this.select();};
        inputlid.type="hidden";
        inputlid.name="ListId[]";
        inputlid.value=obj.id;
	newtd.appendChild(inputlname);
        newtd.appendChild(inputlid);
	var inputImg=document.createElement("input");
	inputImg.type="hidden";
	inputImg.name="ListUrl[]";
	inputImg.value=obj.p+obj.f;
	newtd.appendChild(inputImg);
	newtr.appendChild(newtd);
        var inputor=document.createElement("input");
        inputor.name="listorder[]";
        inputor.id="listorder_"+orderrow;
        inputor.type="hidden";
        inputor.value=orderrow;
        newtd.appendChild(inputor);
	var newtd=document.createElement("td");
	var newa=document.createElement("a");
	newa.innerHTML="<span class='icon-remove-ajax'></span>";
	newa.style.cursor="pointer";
       
	newa.onclick=function()
	{
	   newtr.style.display='none';
        inputImg.value=-1;
	};
	newtd.appendChild(newa);
        
        
        
        
        var newtd_cate=document.createElement("td");
        if(obj.category!=undefined)
        {
            newtd_cate.innerHTML=obj.category;
        };
	newtr.appendChild(newtd_cate);
        
        
        
        
	newtr.appendChild(newtd);

	tblroot.appendChild(newtr);
	orderrow++;
};