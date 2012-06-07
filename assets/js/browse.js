var container;
var camera, scene, renderer, projector;
var geometry, group;

var blocks = [];
var monuments = [];

var width = 800;
var height = 600;

var infoUrl = $('body').attr('data-base') + 'browse/info';

var mouse = {x:0, y:0};
var last_hovered = null;
var last_hovered_scale = 1.0;
var last_hovered_rotation = 0.0;

function getHoveredBlock() {

	var vector = new THREE.Vector3(mouse.x, mouse.y, 1);
	projector.unprojectVector(vector, camera);

	var v = vector.subSelf(camera.position).normalize();
	var ray = new THREE.Ray(camera.position, v);

	var intersects = ray.intersectObjects(blocks);

	if(intersects.length > 0) {
		return intersects[0].object;
	}

	return null;

}

function highlightBlock() {

	var hovered = getHoveredBlock();

	// reset last hovered if it was an object and it
	// is not being hovered anymore.
	if(last_hovered && last_hovered != hovered) {

		// reset scale
		last_hovered_scale = 1.0;
		last_hovered_rotation = 0.0;

		// reset last_highlighted
		last_hovered.scale.x = last_hovered_scale;
		last_hovered.scale.y = last_hovered_scale;
		last_hovered.scale.z = last_hovered_scale;
		last_hovered.rotation.y = last_hovered_rotation;
		last_hovered.updateMatrix();
	}

	if(hovered) {

		hovered.scale.x = last_hovered_scale;
		hovered.scale.y = last_hovered_scale;
		hovered.scale.z = last_hovered_scale;
		hovered.rotation.y = last_hovered_rotation;
		hovered.updateMatrix();

		if(last_hovered_scale < 1.2) {
			last_hovered_scale += 0.02;
		}
		last_hovered_rotation += 0.02;

		var monument_index = blocks.indexOf(hovered);
		var monument = monuments[monument_index];
		var link = "<a href=\"/monument/view/" + monument.MonumentID + "\">" + monument.Name + "</a>";
		$('#browse-window .hud-title').html(link);
	}

	last_hovered = hovered;
}

$(document).ready(function() {

	var resize_canvas = function() {

		var aspect = width/height;
		var w = $(window).width() - 80;
		var h = $(window).height() - 100;
		if(w < 320) { w = 320; }
		if(h < 200) { h = 200; }
		if(h != 0) {
			if(aspect > w/h) {
				//width limits height
				width = w;
				height = w/aspect;
			}
			else {
				//height limits width
				height = h;
				width = h*aspect;
			}
		}

		if(camera) {
			scene.remove(camera);
		}
		camera = new THREE.PerspectiveCamera(60, width/height, 1, 10000);
		camera.position.z = 700;
		scene.add(camera);

		renderer.setSize(width, height);

		$("#browse-window")
			.css("width", width + "px")
			.css("height", height + "px")
			.css("margin", "0 auto");

	}

	$(window).resize(resize_canvas);

	$.getJSON(infoUrl, function(data, textStatus) {

		(function init() {
			console.log(data);

			scene = new THREE.Scene();
			scene.fog = new THREE.Fog( 0xffffff, 1, 10000 );

			var geometry = new THREE.CubeGeometry( 100, 100, 100 );
			var material = new THREE.MeshNormalMaterial();

			group = new THREE.Object3D();

			var nx = 6, ny = 5, nz = 6;
			var x = 0, y = 0, z = 0;
			$.each(data, function(index, monument) {

				material = new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( $('body').attr('data-base') +
					"assets/img/monuments/thumb/" + monument.MonumentID + ".jpg" ) });
				var mesh = new THREE.Mesh(geometry, material);

				mesh.position.x = (x - (nx - 1)/2) * 120;
				mesh.position.y = (y - (ny - 1)/2) * 120;
				mesh.position.z = (z - (nz - 1)/2) * 120;

				mesh.matrixAutoUpdate = false;
				mesh.updateMatrix();

				group.add(mesh);

				blocks.push(mesh);
				monuments.push(monument);

				// Increase the x position
				x += 1;

				// Make the cube in a nice little square
				if(x >= nx) {
					x = 0;
					y += 1;
				}

				if(y >= ny) {
					y = 0;
					z += 1;
				}

			});

			scene.add( group );

			projector = new THREE.Projector();

			renderer = new THREE.WebGLRenderer();
			renderer.sortObjects = true;

			resize_canvas();

			$("#browse-window").append(renderer.domElement);

			$("#browse-window canvas").mousemove(function (event) {
				var o = $(this).offset();
				var x = event.pageX - o.left;
				var y = event.pageY - o.top;

				if(x >= 0 && x < width) {
					mouse.x = (x * 2.0) / width - 1;
				}
				if(y >= 0 && y < height) {
					mouse.y = (-y * 2.0) / height + 1;
				}
			});

		})();


		(function animate() {

			requestAnimationFrame( animate );
			render();
		})();



		function render() {
			/*
			 var time = Date.now() * 0.001;

			 var rx = Math.sin( time * 0.7 ) * 0.5,
			 ry = Math.sin( time * 0.3 ) * 0.5,
			 rz = Math.sin( time * 0.2 ) * 0.5;

			 group.rotation.x = rx;
			 group.rotation.y = ry;
			 group.rotation.z = rz;
			 */

			camera.position.x = mouse.x * 200;
			camera.position.y = mouse.y * 200;

			camera.lookAt( scene.position );

			highlightBlock();

			renderer.render( scene, camera );
		}

		$(document).mousedown(function(event) {

			var clicked = getHoveredBlock();

			if(clicked) {

				var i = blocks.indexOf(clicked);

				var monument = monuments[i].MonumentID;

				window.location = '/monument/view/' + monument;

			}

		});
	});

	/*
	 * Browse menu
	 */
	var selectedCount = 0;
	function toggleButton(eventObject) {

		// Check if the button is being toggled or being untoggled
		// This function is called before the bootstrap library is called so,
		// if this hasClass that means it is being untoggled, if it hasn't
		// got this class that means it is being toggled.
		if($(this).hasClass('active')) {
			selectedCount -= 1;
		} else {
			selectedCount += 1;

			if(selectedCount > 3) {
				eventObject.stopPropagation();
				selectedCount = 3;
			}
		}

	}

	$('.browse-menu-body button:contains(\'Plaats\')').click( toggleButton );
	$('.browse-menu-body button:contains(\'Tijd\')').click( toggleButton );
	$('.browse-menu-body button:contains(\'Categorie\')').click( toggleButton );
	$('.browse-menu-body button:contains(\'Attribuut\')').click( toggleButton );

	$('.browse-menu-body button:contains(\'Reset\')').click(function() {
		$('.browse-menu-body button.active').removeClass('active');
		selectedCount = 0;
	});

})

