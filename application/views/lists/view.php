<div class="span4">
	
    <!-- Favorite list -->
    <div class="row">
    	<table class="table striped-table">
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
            <?php foreach($favorites as $favorite): ?>
            	<tr>
                	<td><?php echo $favorite['MonumentID']; ?></td>
                    <td><?php echo $favorite['Name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
    <!-- Visited list -->
    <div class="row">
    	<table class="table striped-table">
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </table>
    </div>
    
    <!-- Wish list -->
    <div class="row">
    	<table class="table striped-table">
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </table>
    </div>
</div>
<div class="span8">
	<div id="map_canvas"></div>
</div>
<?php echo HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyArtULnydU1gg4DjNfCvhXZx5Sq49p1ktg&sensor=false'), PHP_EOL ?>
<?php echo HTML::script('assets/js/favorite.js'), PHP_EOL ?>