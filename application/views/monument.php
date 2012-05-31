<div id="monument" class="container">
	<div class="row">
		<div class="span5">
    		<?php echo isset($monument) ? "<img src='/".$monument['Image']."' />" : 'Undefined' ?>
		</div><!--/span-->
		<div class="span7">
			<div class="row">
				<h1><?php echo isset($monument) ? $monument['Name'] : 'Undefined' ?></h1>
				<table class="table">
					<tr>
						<td>Monumentnummer</td>
						<td><?php echo isset($monument) ? $monument['MonumentID'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Plaats</td>
						<td><?php echo isset($monument) ? $monument['City'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Straat</td>
						<td><?php echo isset($monument) ? $monument['Street'] : 'Undefined' ?>
						<?php echo isset($monument) ? $monument['StreetNumberText'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Provincie</td>
						<td><?php echo isset($monument) ? $monument['Province'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Gebouwd in </td>
						<td><?php echo isset($monument) ? $monument['FoundationDateText'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Lengtegraad</td>
						<td><?php echo isset($monument) ? $monument['Longitude'] : 'Undefined' ?></td>
					</tr>
					<tr>
						<td>Breedtegraad</td>
						<td><?php echo isset($monument) ? $monument['Latitude'] : 'Undefined' ?></td>
					</tr>
				</table>
			</div><!--/row-->
            
            <?php if($user): ?>
            <div class="row">
            	<div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-list icon-white"></i> Toevoegen aan... 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        	<?php if(!$inList['inFavorite']): ?>
                            <li><?php echo HTML::anchor('/list/favorite/add/' . $monument['MonumentID'], 'Favorieten'); ?></li>
                            <?php endif; ?>
                            
                            <?php if(!$inList['inVisited']): ?>
                            <li><?php echo HTML::anchor('/list/visited/add/' . $monument['MonumentID'], 'Bezochte monumenten'); ?></li>
                            <?php endif; ?>
                            
                            <?php if(!$inList['inWish']): ?>
                            <li><?php echo HTML::anchor('/list/wish/add/' . $monument['MonumentID'], 'Nog te bezoeken'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                    <div class="btn-group">
                        <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-list icon-white"></i> Verwijderen van...
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        	<?php if($inList['inFavorite']): ?>
                            <li><?php echo HTML::anchor('/list/favorite/remove/' . $monument['MonumentID'], 'Favorieten'); ?></li>
                            <?php endif; ?>
                            
                            <?php if($inList['inVisited']): ?>
                            <li><?php echo HTML::anchor('/list/visited/remove/' . $monument['MonumentID'], 'Bezochte monumenten'); ?></li>
                            <?php endif; ?>
                            
                            <?php if($inList['inWish']): ?>
                            <li><?php echo HTML::anchor('/list/wish/remove/' . $monument['MonumentID'], 'Nog te bezoeken'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div><!--/btn-toolbar-->
            </div><!--/row-->
            <?php endif; ?>
            
			<div class="row">
				<h2>Beschrijving</h2>
				<p><?php echo isset($monument) ? $monument['Description'] : 'Geen informatie beschikbaar' ?></p>
			</div><!--/row-->
			<div class="row">
			    <p>
				<?php foreach($monument['TextTag'] as $tag) {
					echo "<a href='/search/query/".$tag['TextTag']."'>".$tag['TextTag']."</a>, ";
				}?>
    			</p>
			</div><!--/row-->
		</div><!--/span-->
	</div><!--/row-->
    
    <!-- Start of the comments -->
    <?php if(count($comments) > 0): ?>
    <div class="row">
        <div class="span8 offset2">
        	<div class="page-header">
            	<h1>Commentaar</h1>
            </div>

					<ul class='comment-list'>
						<?php
							foreach($comments as $comment) {
								$v = View::factory('model/comment');
								$v->set('id', $comment['CommentID']);
								$v->set('name', $comment['Name']);
								$v->set('placeDate', $comment['PlaceDate']);
								$v->set('comment', $comment['Comment']);
								echo $v;
							}
						?>
					</ul>

        </div>
    </div>
    <?php endif; ?>
    
    <!-- Start of comment typing section -->
    <div class="row">
		<?php if($user): ?>
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
