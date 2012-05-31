var googleMap = new google.maps.Map($('#map_canvas').get(0), {
	center: new google.maps.LatLng(52.3700, 4.8900),	// Coordinates of Amsterdam
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});
var markers = [];

// Get the monuments that the user wants to display
$.getJSON($('body').attr('data-base') + 'list/favorite/markers', function(data, textStatus) {
	
	// Add the monuments as markers to the map
	$.each(data, function(key, monument) {
		
		// Create a new marker
		var marker = new google.maps.Marker({
			map : googleMap,
			position : new google.maps.LatLng(parseFloat(monument.Lat), parseFloat(monument.Long)),
			title : monument.Name,
		});
		
		// Add click event that takes the user to the page
		// of the monument if he/she clicks on it
		google.maps.event.addListener(marker, 'click', function() {
			window.location = $('body').attr('data-base') + 'monument/view/' + monument.ID; 
		});
		
		// Store the marker
		markers.push(marker);
	});
});