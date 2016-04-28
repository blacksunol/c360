// JavaScript Document
jQuery(document).ready(function() {				   
	//khoi tao gmap
	var geocoder;
	var map;
	if(jQuery("#default_gmap_address").val() != "" && typeof(jQuery("#default_gmap_address").val()) != "undefined") initMap1();
	else initMap();
	//gmap					   
	jQuery("#googlemap_position").click(function(){
		if(jQuery("#default_gmap_address").val() != "" && typeof(jQuery("#default_gmap_address").val()) != "undefined") initMap1();
	else initMap();
	});
	//khoi tao gmap theo toa do lat long
	function initMap(){
			var	geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(jQuery("#lat").val(),jQuery("#long").val());
			var myOptions = {
			  zoom: 16,
			  center: latlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("load_gmap"), myOptions);
			latlng	= new google.maps.LatLng(jQuery("#lat").val(),jQuery("#long").val());
			//geocoder.getLocations(latlng, showAddress);
			geocoder.geocode({'latLng': latlng}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  if (results[1]) {
				map.setZoom(16);
				marker = new google.maps.Marker({
					position: latlng, 
					map: map
				}); 
				infowindow.setContent(results[1].formatted_address);
				infowindow.open(map, marker);
			  }
			} else {
			  alert("Geocoder failed due to: " + status);
			}
			});
	}
	//khoi tao gmap theo dia chi
	function initMap1(){
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(0, 0);
		var myOptions = {
		  zoom: 16,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
    	map = new google.maps.Map(document.getElementById("load_gmap"), myOptions);
		if (geocoder) {
		  var address	= jQuery("#default_gmap_address").val();
		  geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  map.setCenter(results[0].geometry.location);
			  var marker = new google.maps.Marker({
				  map: map, 
				  draggable: true,
				  position: results[0].geometry.location
			  });
			  google.maps.event.addListener(marker, "dragstart", function() {
				  map.closeInfoWindow();
				});			
			  google.maps.event.addListener(marker, "dragend", function() {												
					var lt =marker.position.lat().toString();
					var lng=marker.position.lng().toString();
					jQuery.lat	= lt;
					jQuery.long	= lng;
					jQuery("#gmap_position").val(lt + "," + lng);
					var infowindow = new google.maps.InfoWindow(
					  { //content: "NhĂ  cá»§a báº¡n Ä‘Æ°á»£c xĂ¡c Ä‘á»‹nh táº¡i Ä‘Ă¢y trĂªn báº£n Ä‘á»“",
						size: new google.maps.Size(30,30)
					  });
					infowindow.open(map,marker);
				});
				//map.addOverlay(marker);	
			} else {
			  alert("Geocode was not successful for the following reason: " + status);
			}
			
		  });  
		}//if
	}
});						   