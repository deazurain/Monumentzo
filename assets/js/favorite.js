var myOptions = {
	center: new google.maps.LatLng(-34.397, 150.644),
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map_canvas = $('#map_canvas');
var map = new google.maps.Map(map_canvas.get(0), myOptions);

$(window).resize(function() {
	map_canvas.css('left', 0)
				.css('top', 60)
				.width($(window).width())
				.height($(window).height() - 60);
}).resize();

