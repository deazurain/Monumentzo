// force reloading the javascript application
$(window).unload(function(){});

var container;
var camera, scene, renderer, projector;
var geometry, group;

var camera_angle_current = Math.PI;
var camera_angle_desired = 0;
var camera_angle_speed = Math.PI/60;

var blocks = [];
var monuments = [];

var width = 800;
var height = 600;

var infoUrl = $('body').attr('data-base') + 'browse/info';

var mouse = {x:0, y:0};
var last_hovered = null;
var last_hovered_scale = 1.0;
var last_hovered_rotation = 0.0;

var zoom_block_start_position = null;
var zoom_block_last = null;
var zoom_block = null;

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
		var link = '<a href="' + $('body').attr('data-base') + 'monument/view/' + monument.MonumentID + '">' + monument.Name + '</a>';
		$('#browse-window .hud-title').html(link);
	}

	last_hovered = hovered;
}

function doZoomBlockReset() {
	zoom_block = null;
	doZoomBlock();
}

function doZoomBlock() {

	if(zoom_block != zoom_block_last) {
		if(zoom_block_last) {
			zoom_block_last.position.copy(zoom_block_start_position);
			zoom_block_last.updateMatrix();
		}
		if(zoom_block) {
			zoom_block_start_position = zoom_block.position.clone();
		}
		zoom_block_last = zoom_block;
	}

	if(zoom_block) {

		var p = camera.position.clone();
		p.subSelf(zoom_block.position);

		if(p.length() > 160) {
			p.normalize().multiplyScalar(30);
		 	zoom_block.position.addSelf(p);
			zoom_block.updateMatrix();
		}

	}

}

function doCameraUpdate() {

	var wrap = function(radians) {
		while(radians < -Math.PI) { radians += Math.PI*2; }
		while(radians >= Math.PI) { radians -= Math.PI*2; }
		return radians;
	}

	var clamp = function(value, min, max) {
		if(value < min) { return min; }
		if(value > max) { return max; }
		return value;
	}

	camera_angle_desired = wrap(camera_angle_desired);

	var diff = wrap(camera_angle_desired - camera_angle_current);
	var rot = clamp(diff, -camera_angle_speed, camera_angle_speed);

	camera_angle_current = wrap(camera_angle_current + rot);

	var m = new THREE.Matrix4()
		.rotateY(camera_angle_current)
		.translate(new THREE.Vector3(-mouse.x*200, mouse.y*1000, -1000));

	camera.position.getPositionFromMatrix(m);
	camera.lookAt(scene.position);
}

$(document).ready(function() {

	var resize_canvas = function() {

		var aspect = width/height;
		var w = $(window).width() - 80;
		var h = $(window).height() - $("#browse-window").offset().top - 10;

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

		if(!camera) {
			camera = new THREE.PerspectiveCamera(60, width/height, 1, 10000);
			camera.position.z = 700;
			scene.add(camera);
		}
		else {
			camera.aspect = width/height;
			camera.updateProjectionMatrix();
			camera.position.z = 700;
		}

		renderer.setSize(width, height);

		$("#browse-window")
			.css("width", width + "px")
			.css("height", height + "px")
			.css("margin", "0 auto");

	}

	$(window).resize(resize_canvas);

	$.getJSON(infoUrl, function(data, textStatus) {

		(function init() {

			scene = new THREE.Scene();
			scene.fog = new THREE.Fog( 0xffffff, 1, 10000 );

			var geometry = new THREE.CubeGeometry( 100, 100, 100 );
			var material = new THREE.MeshNormalMaterial();

			group = new THREE.Object3D();

			var nx = 10, ny = 1, nz = 10;
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


			// sort blocks by time
			for(var i in blocks) {
				var year = monuments[i].Year;
				if(year === null) {
					year = 2000;
				}
				else {
					year = THREE.Math.clamp(year, 1000, 2000) - 1000;
				}
				blocks[i].position.y = (year-500)/1.5
				blocks[i].updateMatrix();
			}


			scene.add( group );

			projector = new THREE.Projector();

			renderer = new THREE.WebGLRenderer();
			renderer.sortObjects = true;

			resize_canvas();

			$("#browse-window").append(renderer.domElement);

			$(window).mousemove(function (event) {
				var o = $("#browse-window canvas").offset();
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

		var doRotateRight = function() {
			camera_angle_desired += Math.PI/2;
		}
		var doRotateLeft = function() {
			camera_angle_desired -= Math.PI/2;
		}

		$("#browse-window .hud-right").click(doRotateRight);
		$("#browse-window .hud-left").click(doRotateLeft);

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
			doCameraUpdate();
			highlightBlock();
			doZoomBlock();

			renderer.render( scene, camera );
		}

		$("#browse-window canvas").mousedown(function(event) {

			var clicked = getHoveredBlock();

			if(clicked) {

				var i = blocks.indexOf(clicked);

				var monument = monuments[i].MonumentID;

				zoom_block = clicked;

				setTimeout(function() {
					window.location = $('body').attr('data-base') + 'monument/view/' + monument;
				}, 500);

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

