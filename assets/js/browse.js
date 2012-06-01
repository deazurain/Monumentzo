var container;
var camera, scene, renderer, projector;
var geometry, group;

var blocks = [];
var monumentNumbers = [];

window.innerHeight = 800;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

var infoUrl = $('body').attr('data-base') + 'browse/info'; 

var mouseX = 0, mouseY = 0;

document.addEventListener( 'mousemove', onDocumentMouseMove, false );

function onDocumentMouseMove(event) {

	mouseX = ( event.clientX - windowHalfX ) * 10;
	mouseY = ( event.clientY - windowHalfY ) * 10;

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
	
	$(document).mousedown(function(event) {
		event.preventDefault();
		
		
		var vector = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1, 0.5 );
		projector.unprojectVector( vector, camera );

		var ray = new THREE.Ray( camera.position, vector.subSelf( camera.position ).normalize() );

		var intersects = ray.intersectObjects( blocks );
		
		if ( intersects.length > 0 ) {

            SELECTED = intersects[ 0 ].object;
			
			for(var i=0; i<objects.length; i++) { 
		    	if(SELECTED.position.x == objects[i].position.x){
					thisObject = i;
					//var blockIndex = blocks.indexOf(i);
					
					window.alert("The monument number of the clicked monument is: " + monumentNumbers[i]);
		 		}	
		    }
			
            var intersects = ray.intersectObject( plane );
            offset.copy( intersects[ 0 ].point ).subSelf( plane.position );

            container.style.cursor = 'move';

        }
		
		if ( intersects.length > 0 ) {
			var clickedBlock = intersects[0].object;
			
			var blockIndex = blocks.indexOf(clickedBlock);

		}
	});
});

/*
 * Browse menu
 */
$('.browse-menu-body button:contains(\'Reset\')').click(function() {
	$('.browse-menu-body button.active').removeClass('selected');
});