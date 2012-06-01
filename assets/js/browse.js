var container;
var camera, scene, renderer, projector;
var geometry, group;

var blocks = [];
var monumentNumbers = [];

window.innerHeight = 800;

var infoUrl = $('body').attr('data-base') + 'browse/info';

var mouse = {x:0, y:0};
var last_hovered = null;
var last_hovered_scale = 1.0;

document.addEventListener( 'mousemove', onDocumentMouseMove, false );

function getHoveredBlock() {

	var vector = new THREE.Vector3(mouse.x, mouse.y, 0);
	projector.unprojectVector(vector, camera);

	var ray = new THREE.Ray(camera.position, vector.subSelf(camera.position).normalize());

	var intersects = ray.intersectObjects(blocks);

	if(intersects.length > 0) {
		return intersects[0].object;
	}

	return null;

}

function highlightBlock() {

	var hovered = getHoveredBlock();

	if (hovered) {

		if(!last_hovered) {
			last_hovered = hovered;
		}

		else if(last_hovered != hovered) {

			// reset scale
			last_hovered_scale = 1.0;

			// reset last_highlighted
			last_hovered.scale.x = 1;
			last_hovered.scale.y = 1;
			last_hovered.scale.z = 1;
			last_hovered.updateMatrix();

			last_hovered = hovered;
		}

		if(last_hovered_scale < 1.2) {
			last_hovered_scale += 0.1;
		}

		hovered.scale.x = last_hovered_scale;
		hovered.scale.y = last_hovered_scale;
		hovered.scale.z = last_hovered_scale;
		hovered.updateMatrix();

	}

}

function onDocumentMouseMove(event) {

	mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
	mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;

};

$.getJSON(infoUrl, function(data, textStatus) {
	
	(function init() {
		console.log(data);
		container = $( '<div></div>' ).attr( 'id', 'browseWindow' );
		$( '.container' ).append( container );
	
		scene = new THREE.Scene();
		scene.fog = new THREE.Fog( 0xffffff, 1, 10000 );
	
		camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 1, 10000 );
		camera.position.z = 500;
		scene.add( camera );
	
		var geometry = new THREE.CubeGeometry( 100, 100, 100 );
		var material = new THREE.MeshNormalMaterial();
	
		group = new THREE.Object3D();
		
		var x = -2, y = -1.5;
		$.each(data, function(index, monument) {
			
			material = new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( $('body').attr('data-base') + 
				"assets/img/monuments/thumb/" + monument.MonumentID + ".jpg" ) });
			var mesh = new THREE.Mesh(geometry, material);
			mesh.position.x = x * 120;
			mesh.position.y = y * 120;
			mesh.position.z = 0;
			
			// Increase the x position
			x += 1;
			
			// Make the cube in a nice little square
			if(x >= 3) {
				x = -2;
				y += 1;
			}
			
			mesh.rotation.x = 0;
			mesh.rotation.y = 0;
			mesh.matrixAutoUpdate = false;
			mesh.updateMatrix();
			
			group.add(mesh);
			
			blocks.push(mesh);
			monumentNumbers.push(monument.MonumentID);
		});
	
		scene.add( group );
	
		projector = new THREE.Projector();
	
		renderer = new THREE.WebGLRenderer();
		renderer.setSize( window.innerWidth, window.innerHeight );
		renderer.sortObjects = false;
	
		container.append( renderer.domElement );
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

		camera.position.x = mouse.x * 100;
		camera.position.y = mouse.y * 100;

		camera.lookAt( scene.position );

		highlightBlock();


			
		renderer.render( scene, camera );
	}
	
	$(document).mousedown(function(event) {

		var clicked = getHoveredBlock();

		if(clicked) {

			var i = blocks.indexOf(clicked);

			var monument = monumentNumbers[i];

			window.location = '/monument/view/' + monument;

		}

	});

});