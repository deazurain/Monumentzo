var container;
var camera, scene, renderer, projector;
var geometry, group;

var blocks = [];
var monumentNumbers = [];

window.innerHeight = 800;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

var infoUrl = $('body').attr('data-base') + 'browse/info'; 

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
			
			material = new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( $('body').attr('data-base') + monument.Image ) });
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
		renderer.render( scene, camera );
	}
	
	$(document).mousedown(function(event) {
		event.preventDefault();

		var vector = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1, 0.5 );
		projector.unprojectVector( vector, camera );

		var ray = new THREE.Ray( camera.position, vector.subSelf( camera.position ).normalize() );

		var intersects = ray.intersectObjects( blocks );

		if ( intersects.length > 0 ) {
			var clickedBlock = intersects[0].object;
			var blockIndex = blocks.indexOf(clickedBlock);
			
			window.alert("The monument number of the clicked monument is: " + monumentNumbers[blockIndex]);
		}
	});
});