var container;
var camera, scene, renderer;
var geometry, group;
var mouseX = 0, mouseY = 0;

window.innerHeight = 800;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

$(document).on('mousemove', function (event) {
	mouseX = ( event.clientX - windowHalfX ) * 10;
	mouseY = ( event.clientY - windowHalfY ) * 10;
});

$.get('/browse/info', function(responseText) {
	
	console.log(responseText);
	
	(function init() {
	
		container = $( '<div></div>' ).attr( 'id', 'browseWindow' );;
		$(document.body).append( container );
	
		scene = new THREE.Scene();
		scene.fog = new THREE.Fog( 0xffffff, 1, 10000 );
	
		camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 1, 10000 );
		camera.position.z = 500;
		scene.add( camera );
	
		var geometry = new THREE.CubeGeometry( 100, 100, 100 );
		var material = new THREE.MeshNormalMaterial();
	
		group = new THREE.Object3D();
	
		$.each(data, function(index, monument) {
			var mesh = new THREE.mesh(geometry, material);
			mesh.position.x = (index % 5) * 120;
			mesh.position.y = (index % 5) * 120;
			mesh.position.z = 0;
			
			mesh.rotation.x = 0;
			mesh.rotation.y = 0;
			mesh.matrixAutoUpdate = false;
			mesh.updateMatrix();
			
			group.add(mesh);
		});
	
		scene.add( group );
	
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
	
		var time = Date.now() * 0.001;
	
		var rx = Math.sin( time * 0.7 ) * 0.5,
			ry = Math.sin( time * 0.3 ) * 0.5,
			rz = Math.sin( time * 0.2 ) * 0.5;
	
		camera.position.x += ( mouseX - camera.position.x ) * .05;
		camera.position.y += ( - mouseY - camera.position.y ) * .05;
	
		camera.lookAt( scene.position );
	
		group.rotation.x = rx;
		group.rotation.y = ry;
		group.rotation.z = rz;
	
		renderer.render( scene, camera );
	}
});