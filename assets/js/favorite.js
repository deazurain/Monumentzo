var myOptions = {
	center: new google.maps.LatLng(52.3700, 4.8900),
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var googleMap = new google.maps.Map($('#map_canvas').get(0), myOptions);
var markers = [];

// Get the monuments that the user wants to display
$.getJSON($('body').attr('data-base') + 'list/favorite/markers', function(data, textStatus) {
	
	// Add the monuments as markers to the map
	$.each(data, function(key, monument) {
		var markerOptions = {
			map : googleMap,
			LatLng : new google.maps.LatLng(parseFloat(monument.Lat), parseFloat(monument.Long))
		};
		
		markers.push(new google.maps.Marker(markerOptions));
	});
});