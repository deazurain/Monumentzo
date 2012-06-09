var googleMap = new google.maps.Map($('#map_canvas').get(0), {
	center: new google.maps.LatLng(52.0995, 5.110),	// Coordinates of Utrecht
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});
var baseUrl = $('body').attr('data-base');
var markers = [];

var createMarkerShape = function() {
  return {coord: [9, 0, 6, 1, 4, 2, 2, 4, 0, 8, 0, 12, 1, 14, 2, 16, 5, 19, 7, 23, 8, 26, 9, 30, 9, 34, 11, 34, 11, 30, 12, 26, 13, 24, 14, 21, 16, 18, 18, 16, 20, 12, 20, 8, 18, 4, 16, 2, 15, 1, 13, 0], type: 'poly'};
}

var createMarker = function(url) {
	return new google.maps.MarkerImage(url,
		new google.maps.Size(20, 34),
		new google.maps.Point(0, 0),
		new google.maps.Point(10, 34)
	);
}

var createMarkerShadow = function(url) {
	return new google.maps.MarkerImage(url,
		new google.maps.Size(37, 34),
		new google.maps.Point(20, 0),
		new google.maps.Point(10, 34)
	);
}

var markerShape = createMarkerShape();
var greenMarker = createMarker(baseUrl + 'assets/img/marker_sprite_green.png');
var greenShadow = createMarkerShadow(baseUrl + 'assets/img/marker_sprite_green.png');
var yellowMarker = createMarker(baseUrl + 'assets/img/marker_sprite_yellow.png');
var yellowShadow = createMarkerShadow(baseUrl + 'assets/img/marker_sprite_yellow.png');

var listToMarker = {
	"favorite": { 'icon': null, 'shadow': null },
	"visited": { 'icon': greenMarker, 'shadow': greenShadow },
	"wish": { 'icon': yellowMarker, 'shadow': yellowShadow },
}

// Get the monuments that the user wants to display
$.getJSON(baseUrl + 'list/view/markers', function(data, textStatus) {
	
	var addMarker = function(monument, list) {
		
		// Create a new marker
		var marker = new google.maps.Marker({
			map : googleMap,
			position : new google.maps.LatLng(parseFloat(monument.Lat), parseFloat(monument.Long)),
			title : monument.Name,
			icon: listToMarker[list].icon,
			shadow: listToMarker[list].shadow
		});
		
		// Add click event that takes the user to the page
		// of the monument if he/she clicks on it
		google.maps.event.addListener(marker, 'click', function() {
			window.location = $('body').attr('data-base') + 'monument/view/' + monument.ID; 
		});
		
		// Store the marker
		markers.push(marker);
	};
	
	// Add the monuments as markers to the map
	$.each(data.favorites, function(key, monument) { addMarker(monument, 'favorite'); });
	$.each(data.visited, function(key, monument) { addMarker(monument, 'visited'); });
	$.each(data.wish, function(key, monument) { addMarker(monument, 'wish'); });
});

// Handle the resize event for the map
$(window).resize(function() {
	$('#map_canvas').height(($(window).height() - parseInt($('#content').css('padding-top')) - 20) + 'px');
}).resize();
