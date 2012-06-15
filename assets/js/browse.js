// force reloading the javascript application
$(window).unload(function(){});

var container;
var camera, scene, renderer, projector;
var geometry, group;

var camera_angle_current = Math.PI;
var camera_angle_desired = 0;
var camera_angle_speed = Math.PI/60;
var camera_offset_x = 0;
var camera_offset_z = 0;

var blocks = [];
var monuments = [];

var width = 800;
var height = 600;

var infoUrl = '/browse/info';

var mouse = {
    x:0, 
    y:0
};
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
            p.multiplyScalar(0.1);
            zoom_block.position.addSelf(p);
            zoom_block.updateMatrix();
        }

    }

}

function doCameraUpdate() {

    var wrap = function(radians) {
        while(radians < -Math.PI) {
            radians += Math.PI*2;
        }
        while(radians >= Math.PI) {
            radians -= Math.PI*2;
        }
        return radians;
    }

    var clamp = function(value, min, max) {
        if(value < min) {
            return min;
        }
        if(value > max) {
            return max;
        }
        return value;
    }

    camera_angle_desired = wrap(camera_angle_desired);

    var diff = wrap(camera_angle_desired - camera_angle_current);
    var rot = clamp(diff, -camera_angle_speed, camera_angle_speed);

    camera_angle_current = wrap(camera_angle_current + rot);

    var m = new THREE.Matrix4()
    .rotateY(camera_angle_current)
    .translate(new THREE.Vector3(camera_offset_x, 0, camera_offset_z))
    .translate(new THREE.Vector3(mouse.x*300, mouse.y*1000 + 500, 1000));

    camera.position.getPositionFromMatrix(m);
    camera.lookAt(scene.position);
}

$(document).ready(function() {

    // HACK THAT ASS
    $("#browse-window").appendTo($("body"));
    $("#content").remove();

		// POPOVER
		$("#browse-window .hud-help").popover({
			animation: true,
			delay: {show: 10, hide: 100},
			placement: 'right',
			trigger: 'hover',
			title: function() {
				return $("#browse-window .hud-help .popover-title").html();
			},
			content: function() {
				return $("#browse-window .hud-help .popover-content").html();
			}
		});

    var resize_canvas = function() {

        var aspect = width/height;
        var w = $(window).width() - 8;
        var h = $(window).height() - 40; // $("#browse-window").offset().top;

        if(w < 320) {
            w = 320;
        }
        if(h < 200) {
            h = 200;
        }
        /*
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
		*/
        width = w;
        height = h;

        if(!camera) {
            camera = new THREE.PerspectiveCamera(60, width/height, 1, 10000);
            scene.add(camera);
        }
        else {
            camera.aspect = width/height;
            camera.updateProjectionMatrix();
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

                material = new THREE.MeshBasicMaterial( {
                    map: THREE.ImageUtils.loadTexture( $('body').attr('data-base') +
                        "assets/img/monuments/thumb/" + monument.MonumentID + ".jpg" )
                });
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


            for(var i in blocks) {
                // right bound 7.46
                // left bound 3.19
                // upper bound 53.57
                // lower bound 50.70
                var lat_upper = 53.75;
                var lat_lower = 50.70;
                var long_upper = 7.46;
                var long_lower = 3.19;

                var lat = parseFloat(monuments[i].Latitude);
                var long = parseFloat(monuments[i].Longitude);

                var lat_rel = (THREE.Math.clamp(lat, lat_lower, lat_upper) - lat_lower)/(lat_upper - lat_lower) - 0.5;
                var long_rel = (THREE.Math.clamp(long, long_lower, long_upper) - long_lower)/(long_upper - long_lower) - 0.5;

                var block = blocks[i];

                block.position.x = long_rel * 6000;
                block.position.z = -lat_rel * 6000;

                block.updateMatrix();
            }

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

            scene.add(group);

            geometry = new THREE.PlaneGeometry(6000, 6000, 1, 1);
            material = new THREE.MeshBasicMaterial({
                map: THREE.ImageUtils.loadTexture('/assets/img/netherlands.jpg')
            });
            var plane = new THREE.Mesh(geometry, material);
            plane.matrixAutoUpdate = false;
            plane.position.set(0, -500, 0);
            plane.updateMatrix();
            plane.doubleSided = true;

            scene.add(plane);

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

            $(window).keydown(function(event) {
                switch(event.keyCode) {
                    case 87:
                    case 38:
                        if(camera_offset_z >= 50) {
                            camera_offset_z += -50;
                        }
                        break;
                    case 83:
                    case 40:
                        if(camera_offset_z < 4000) {
                            camera_offset_z += 50;
                        }
                        break;
                    case 65:
                    case 37:
                        camera_angle_desired -= Math.PI/2;
                        break;
                    case 68:
                    case 39:
                        camera_angle_desired += Math.PI/2;
                        break;
                }
            });

        })();

        var doRotateRight = function() {
            camera_angle_desired += Math.PI/2;
        }
        var doRotateLeft = function() {
            camera_angle_desired -= Math.PI/2;
        }
                
        var doZoomIn = function() {
            if(camera_offset_z >= 50) {
                camera_offset_z += -100;
            }   
        }                
        var doZoomOut = function() {
            if(camera_offset_z < 4000) {
                camera_offset_z += 100;
            }    
        }

        $("#browse-window .hud-right").click(doRotateRight);
        $("#browse-window .hud-left").click(doRotateLeft);
        $("#browse-window .hud-zoomin").click(doZoomIn);
        $("#browse-window .hud-zoomout").click(doZoomOut);

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

})

