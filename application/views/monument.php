<div id="monument" class="container">
	<div class="row">
        <div class="span12">
            <div class="page-header">
	            <h1>
	                <?php echo $monument['Name'] ?>
	                
	                <?php if ($user): ?>
        			<div class="pull-right">
        				<div id="header-buttons" class="btn-toolbar">

        					<?php if (!$inList['inFavorite'] || !$inList['inVisited'] || !$inList['inWish']): ?>
        					<div class="btn-group">
        						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
        							<i class="icon-list icon-white"></i> Toevoegen aan...
        							<span class="caret"></span>
        						</a>
        						<ul class="dropdown-menu">
        							<?php if (!$inList['inFavorite']): ?>
        							<li><?php echo HTML::anchor('/list/favorite/add/' . $monument['MonumentID'], 'Favorieten'); ?></li>
        							<?php endif; ?>

        							<?php if (!$inList['inVisited']): ?>
        							<li><?php echo HTML::anchor('/list/visited/add/' . $monument['MonumentID'], 'Bezochte monumenten'); ?></li>
        							<?php endif; ?>

        							<?php if (!$inList['inWish']): ?>
        							<li><?php echo HTML::anchor('/list/wish/add/' . $monument['MonumentID'], 'Nog te bezoeken'); ?></li>
        							<?php endif; ?>
        						</ul>
        					</div>
        					<?php endif; ?>

        					<?php if ($inList['inFavorite'] || $inList['inVisited'] || $inList['inWish']): ?>
        					<div class="btn-group">
        						<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
        							<i class="icon-list icon-white"></i> Verwijderen van...
        							<span class="caret"></span>
        						</a>
        						<ul class="dropdown-menu">
        							<?php if ($inList['inFavorite']): ?>
        							<li><?php echo HTML::anchor('/list/favorite/remove/' . $monument['MonumentID'], 'Favorieten'); ?></li>
        							<?php endif; ?>

        							<?php if ($inList['inVisited']): ?>
        							<li><?php echo HTML::anchor('/list/visited/remove/' . $monument['MonumentID'], 'Bezochte monumenten'); ?></li>
        							<?php endif; ?>

        							<?php if ($inList['inWish']): ?>
        							<li><?php echo HTML::anchor('/list/wish/remove/' . $monument['MonumentID'], 'Nog te bezoeken'); ?></li>
        							<?php endif; ?>
        						</ul>
        					</div>
        					<?php endif; ?>


        				</div>
        				<!--/btn-toolbar-->
	            </h1>
	        </div>
        </div>
    </div>
    <div class="row">
		<div class="span7">
		    
			<img src="<?= url::base() . $monument['Image'] ?>" />
			
		</div><!--/span-->

		<div class="span5">
			<div>
    			<!-- Google Maps -->
                <div class="map">
                    <div id="map_canvas" 
                        data-latitude="<?php echo $monument['Latitude'] ?>"
                        data-longitude="<?php echo $monument['Longitude'] ?>">
                    </div>
                </div>
				<?php echo HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyArtULnydU1gg4DjNfCvhXZx5Sq49p1ktg&sensor=false'), PHP_EOL ?>
				<?php echo HTML::script('assets/js/map.js'), PHP_EOL ?>
				<table class="table">
					<tr>
						<td>Monumentnummer</td>
						<td><?= $monument['MonumentID'] ?></td>
					</tr>
					<tr>
						<td>Plaats</td>
						<td><?= $monument['City'] ?></td>
					</tr>
					<tr>
						<td>Straat</td>
						<td><?= $monument['Street'] ?>
							<?= $monument['StreetNumberText'] ?></td>
					</tr>
					<tr>
						<td>Provincie</td>
						<td><?= $monument['Province'] ?></td>
					</tr>
					<tr>
						<td>Gebouwd in</td>
						<td>
						    <?php if (!($monument['WikiArticle'] == NULL)) :?>
						        <?= $monument['FoundationDateText'] ?>
						    <?php else:?>
    						    Geen jaar beschikbaar
						    <?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>Lengtegraad</td>
						<td><?php echo $monument['Longitude'] ?></td>
					</tr>
					<tr>
						<td>Breedtegraad</td>
						<td><?php echo $monument['Latitude'] ?></td>
					</tr>
					<tr>
						<td>Wikipedia artikel</td>
						<td>
						<?php if (!($monument['WikiArticle'] == NULL)) :?>
						    <a href="http://nl.wikipedia.org/wiki/<?= $monument['WikiArticle'] ?>">
						         http://nl.wikipedia.org/wiki/<?= $monument['WikiArticle'] ?>
						    </a>
						<?php else:?>
						    Geen artikel beschikbaar
						<?php endif; ?>
						</td>
					</tr>
				</table>
			</div>
			<!--/row-->

			
				<!-- Tags -->
                <div class="tab-pane" id="tags">
    				<p>
    					<?php foreach($monument['TextTag'] as $tag) {
    						$href = url::base().'search/query/'.$tag['TextTag'];
    						$text = $tag['TextTag'];?>
    						<a href="<?php echo $href; ?>"><?php echo $text; ?></a>
    					<?php } ?>
    				</p>
    			</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
	    <div class="span8 offset2">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#description">Beschrijving</a></li>
                <?php if(count($events) > 0): ?>
                    <li><a href="#related-events">Gerelateerde gebeurtenissen</a></li>
                <?php endif; ?>
                <?php if(count($persons) > 0): ?>
                    <li><a href="#related-people">Gerelateerde personen</a></li>
                <?php endif; ?>
                <?php if(count($similarImages) != 0): ?>
                    <li><a href="#similar-images">Visueel gelijkende monumenten</a></li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                
                <!-- Description -->
			    <div class="tab-pane active" id="description">
    				<p><?php echo !($monument['Description'] == NULL) ? $monument['Description'] : 'Geen informatie beschikbaar'; ?></p>
    			</div>

            
                <!-- Related events -->
                <?php if(count($events) > 0): ?>
                <div class="tab-pane" id="related-events">
                    <div>
                        <table class="table table-striped">
                            <tr>
                                <th>Jaartal</th>
                                <th>Gebeurtenis</th>
                            </tr>
                            <?php foreach($events as $event): ?>
                            <tr>
                                <td><?php echo $event['Year']; ?></td>
                                <td><?php echo $event['Name']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            
                <!-- Related people -->
                <?php if(count($persons) > 0): ?>
                <div class="tab-pane" id="related-people">
                    <div>
                        <table class="table table-striped">
                            <?php foreach($persons as $person): ?>
                            <tr>
                                <td><a href="http://nl.wikipedia.org/wiki/<?php echo $person['Name']; ?>"><?php echo $person['Name']; ?></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                
                
    			
    			<!-- Similar Images -->
    			<?php if(count($similarImages) != 0): ?>
    			<div class="tab-pane" id="similar-images">
    				<div id='carousel' class='carousel slide'>
    					<!-- Carousel items -->
    					<div class='carousel-inner'>
    						<?php foreach( $similarImages as $image ) { ?>
    							<div class='item'>
    							    <a href="<?php echo '/monument/view/' . $image['MonumentID'] ?>">
    								    <img src="<?php echo url::base().$image['Path']; ?>">
    								</a>
    								<div class="carousel-caption">
    								    <h4><?php echo $image['Name']; ?></h4>
    								</div>
    							</div>
    						<?php } ?>
    					</div>
    					<a class='carousel-control left' href='#carousel' data-slide='prev'>&lsaquo;</a>
    					<a class='carousel-control right' href='#carousel' data-slide='next'>&rsaquo;</a>
    				</div>
    			</div>
    			<?php endif;?>
    			
    			
            </div>
		</div>
	</div>
    

	<!-- Start of the comments -->
	<div class="row">
		<div class="span8 offset2">
			<div class="page-header">
				<h1>Commentaar</h1>
			</div>


			<ul id='comment-list'>
				<?php if (count($comments) == 0): ?>
				<p>Er is nog geen commentaar geplaatst bij dit monument, wees de eerste! </p>
				<?php else: ?>
				<?php
				foreach ($comments as $comment) {
					$v = View::factory('model/comment');
					$v->set('id', $comment['CommentID']);
					$v->set('name', $comment['Name']);
					$v->set('placeDate', $comment['PlaceDate']);
					$v->set('comment', $comment['Comment']);
					$v->set('owner', ($user && ($user->UserID === $comment['UserID'])) ? true : false);
					echo $v;
				}
				?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<!-- Start of comment typing section -->
	<div class="row">
		<?php if ($user): ?>
		<div class="span8 offset2">
			<div class="page-header">
				<h1>Plaats commentaar</h1>
			</div>

			<div>
				<?php echo Form::open('comment/create', array('id' => 'create-comment', 'method' => 'post')); ?>

				<div class="row">
					<div class="span7">
						<dl>
							<dt><?php echo Form::hidden('MonumentID', $monument['MonumentID']); ?></dt>
							<dd><?php echo Form::textarea('Comment', '', array('rows' => 7, 'placeholder' => 'Commentaar over het monument...')); ?></dd>
						</dl>
					</div>
					<div id="comment-buttons" class="pull-right">
						<div class="btn-toolbar">
							<button type="submit" class="btn btn-info">Plaats</button>
						</div>
						<div class="btn-toolbar">
							<button type="reset" class="btn btn-danger" href="#">Annuleer</button>
						</div>
					</div>
				</div>
				<div class='error-container alert alert-error'></div>
				<div class='success-container alert alert-success'></div>

				<?php echo Form::close(); ?>
			</div>
		</div>
		<?php else: ?>
		<div class="span8 offset2">
		</div>
		<?php endif; ?>
	</div>
</div><!--/container-->
