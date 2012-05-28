var myOptions = {
	center: new google.maps.LatLng(-34.397, 150.644),
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map_canvas = $('#map_canvas').width($(this).parent().width())
									.height($(this).parent().height());
var map = new google.maps.Map(map_canvas.get(0), myOptions);

$(window).resize(function() {
	map_canvas.width($(this).parent().width())
				.height($(this).parent().height());
}).resize();

