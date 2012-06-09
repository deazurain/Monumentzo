<div id="list-view">
    <div class="span3">
        
        <!-- Favorite list -->
        <?php if(count($favorites) > 0): ?>
        <div class="row">
            <div class="page-header">
            	<h3>
            		Favoriete monumenten
            		<small class="pull-right">(Rode markers)</small>
            	</h3>
            	
            </div>
            <table class="table striped-table">
                <tr>
                    <th>Naam</th>
                </tr>
                <?php foreach($favorites as $monument): ?>
                    <tr>
                        <td><a href="<?php echo url::base() . 'monument/view/' . $monument['MonumentID']; ?>"><?php echo $monument['Name']; ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
        
        <!-- Visited list -->
        <?php if(count($visited) > 0): ?>
        <div class="row">
            <div class="page-header">
            	<h3>
            		Bezochte monumenten
            		<small class="pull-right">
            			(Groene markers)
            		</small>
            	</h3>
            </div>
            <table class="table striped-table">
                <tr>
                    <th>Naam</th>
                </tr>
                <?php foreach($visited as $monument): ?>
                <tr>
                	<td><a href="<?php echo url::base() . 'monument/view/' . $monument['MonumentID']; ?>"><?php echo $monument['Name']; ?></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
        
        <!-- Wish list -->
        <?php if(count($wish) > 0): ?>
        <div class="row">
            <div class="page-header">
            	<h3>
            		Te bezoeken monumenten
            		<small class="pull-right">(Gele markers)</small>
            	</h3>
            </div>
            <table class="table striped-table">
                <tr>
                    <th>Naam</th>
                </tr>
                <?php foreach($wish as $monument): ?>
                    <tr>
                        <td><a href="<?php echo url::base() . 'monument/view/' . $monument['MonumentID']; ?>"><?php echo $monument['Name']; ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Google Maps -->
    <div class="<?php echo (count($favorites) <= 0 && count($visited) <= 0 && count($wish) <= 0) ? 'span12' : 'span8'; ?>">
        <div id="map_canvas"></div>
    </div>
</div>
<?php echo HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyArtULnydU1gg4DjNfCvhXZx5Sq49p1ktg&sensor=false'), PHP_EOL ?>
<?php echo HTML::script('assets/js/list.js'), PHP_EOL ?>