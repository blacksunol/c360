//on page load (as soon as its ready) call JT_init
jQuery(document).ready(JT_init);

function JT_init(){
    jQuery("a.jTip")
    .bind('mouseover', function(event) {
        JT_show(this.rel, this.id, this.name, event);
    })    
    .bind('mouseout', function(event) {
        jQuery('#JT').remove();
    })
    .bind('mousemove', function(event) {
        JT_move(this.rel, this.id, this.name, event);
    })       
}

function JT_show(url, linkId, title, e) {
    if (url !== undefined) {                
	    if(title == false)title="&nbsp;";
	    var de = document.documentElement;
	    var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	    var hasArea = w - e.pageX;
	    var clickElementy = e.pageY - 10;  //set y position
    	
	    var queryString = url.replace(/^[^\?]+\??/,'');
	    var params = parseQuery( queryString );
	    if(params['width'] === undefined){params['width'] = 250};	    
    	
	    if(hasArea>((params['width']*1)+75)){
		    jQuery("body").append("<div id='JT' style='width:"+params['width']*1+"px'><div id='JT_arrow_left'></div><div id='JT_close_left'>"+title+"</div><div id='JT_copy'><div class='JT_loader'><div></div></div>");//right side
		    var arrowOffset = 20;
		    var clickElementx = e.pageX + arrowOffset; //set x position
	    }else{
		    jQuery("body").append("<div id='JT' style='width:"+params['width']*1+"px'><div id='JT_arrow_right' style='left:"+((params['width']*1)+1)+"px'></div><div id='JT_close_right'>"+title+"</div><div id='JT_copy'><div class='JT_loader'><div></div></div>");//left side
		    var clickElementx = e.pageX - ((params['width'] * 1) + 15); //set x position
	    }

	    if (url != "") {
	        jQuery('#JT').css({ left: clickElementx + "px", top: clickElementy + "px" });
	        jQuery('#JT').show();
	        jQuery('#JT_copy').load(url);
	    }
    }
}

function JT_move(url, linkId, title, e) {
    if (url !== undefined) {
        if (title == false) title = "&nbsp;";
        var de = document.documentElement;
        var w = self.innerWidth || (de && de.clientWidth) || document.body.clientWidth;
        var hasArea = w - e.pageX;
        var clickElementy = e.pageY - 10;  //set y position

        var queryString = url.replace(/^[^\?]+\??/, '');
        var params = parseQuery(queryString);
        if (params['width'] === undefined) { params['width'] = 250 };        

        if (hasArea > ((params['width'] * 1) + 75)) {            
            var arrowOffset = 20;
            var clickElementx = e.pageX + arrowOffset; //set x position
        } else {            
            var clickElementx = e.pageX - ((params['width'] * 1) + 15); //set x position
        }

        if (url != "") {
            jQuery('#JT').css({ left: clickElementx + "px", top: clickElementy + "px" });
            jQuery('#JT').show();           
        }
    }
}

function getElementWidth(objectId) {
	x = document.getElementById(objectId);
	return x.offsetWidth;
}

function getAbsoluteLeft(objectId) {
	// Get an object left position from the upper left viewport corner
	o = document.getElementById(objectId)
	oLeft = o.offsetLeft            // Get left position from the parent object
	while(o.offsetParent!=null) {   // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent    // Get parent object reference
		oLeft += oParent.offsetLeft // Add parent left position
		o = oParent
	}
	return oLeft
}

function getAbsoluteTop(objectId) {
	// Get an object top position from the upper left viewport corner
	o = document.getElementById(objectId)
	oTop = o.offsetTop            // Get top position from the parent object
	while(o.offsetParent!=null) { // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent  // Get parent object reference
		oTop += oParent.offsetTop // Add parent top position
		o = oParent
	}
	return oTop
}

function parseQuery ( query ) {
   var Params = new Object ();
   if ( ! query ) return Params; // return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function blockEvents(evt) {
              if(evt.target){
              evt.preventDefault();
              }else{
              evt.returnValue = false;
              }
}