var longitude = $('#map_canvas').attr('data-longitude')
var latitude = $('#map_canvas').attr('data-latitude')

var googleMap = new google.maps.Map($('#map_canvas').get(0), {
	center: new google.maps.LatLng(latitude, longitude),	// Coordinates of Utrecht
	zoom: 10,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});

var marker = new google.maps.Marker({
	map : googleMap,
	position : new google.maps.LatLng(
		parseFloat(latitude), 
		parseFloat(longitude))
});
