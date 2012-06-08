<div id="list-view">
    <div class="span3">
        
        <!-- Favorite list -->
        <div class="row">
            <div class="page-header"><h3>Favorieten</h3></div>
            <table class="table striped-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                <?php foreach($favorites as $monument): ?>
                    <tr>
                        <td><?php echo $monument['MonumentID']; ?></td>
                        <td><?php echo $monument['Name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
        <!-- Visited list -->
        <div class="row">
            <div class="page-header"><h3>Bezochte monumenten</h3></div>
            <table class="table striped-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                <?php foreach($visited as $monument): ?>
                    <tr>
                        <td><?php echo $monument['MonumentID']; ?></td>
                        <td><?php echo $monument['Name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
        <!-- Wish list -->
        <div class="row">
            <div class="page-header"><h3>Te bezoeken monumenten</h3></div>
            <table class="table striped-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                <?php foreach($wish as $monument): ?>
                    <tr>
                        <td><?php echo $monument['MonumentID']; ?></td>
                        <td><?php echo $monument['Name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    
    <!-- Google Maps -->
    <div class="span8">
        <div id="map_canvas"></div>
    </div>
</div>
<?php echo HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyArtULnydU1gg4DjNfCvhXZx5Sq49p1ktg&sensor=false'), PHP_EOL ?>
<?php echo HTML::script('assets/js/list.js'), PHP_EOL ?>