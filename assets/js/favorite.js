var myOptions = {
	center: new google.maps.LatLng(52.3700, 4.8900),
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map_canvas = $('#map_canvas');/*.width($(this).parent().width())
									.height($(this).parent().height());*/
var googleMap = new google.maps.Map(map_canvas.get(0), myOptions);
var markers = [];

// Get the monuments that the user wants to display
$.getJSON($('body').attr('data-base') + 'list/favorite/markers', function(data, textStatus) {
	
	// Add the monuments as markers to the map
	$.each(data, function(key, monument) {
		var markerOptions = {
			map : googleMap,
			LatLng : new google.maps.LatLng(monument.Lat, monument.Long)
		};
		
		var marker = new google.maps.Marker(markerOptions);
	});
});

/*$(window).resize(function() {
	map_canvas.width($(this).parent().width())
				.height($(this).parent().height());
}).resize();*/

