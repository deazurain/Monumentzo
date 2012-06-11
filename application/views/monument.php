<div id="monument" class="container">
	<div class="row">

		<div class="span5">
			<?php echo isset($monument) ? "<img src='" . url::base() . $monument['Image'] . "' />" : 'Undefined' ?>

			<section id="similar-images">
				<div class="page-header">
					<h1>Visueel gelijkende monumenten</h1>
				</div>
				<div id='carousel' class='carousel slide'>
					<!-- Carousel items -->
					<div class='carousel-inner'>
						<?php foreach( $similarImages as $image ) { ?>
							<div class='item'>
								<img src="<?php echo url::base().$image['Path']; ?>">
							</div>
						<?php } ?>
					</div>
					<a class='carousel-control left' href='#carousel' data-slide='prev'>&lsaquo;</a>
					<a class='carousel-control right' href='#carousel' data-slide='next'>&rsaquo;</a>
				</div>
			</section>
		</div><!--/span-->

		<div class="span7">
			<div>
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
						<td>Gebouwd in</td>
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
			</div>
			<!--/row-->

			<?php if ($user): ?>
			<div class="row">
				<div class="btn-toolbar">

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
			</div><!--/row-->
			<?php endif; ?>

			<div>
				<h2>Beschrijving</h2>

				<p><?php echo isset($monument) ? $monument['Description'] : 'Geen informatie beschikbaar' ?></p>
			</div>

			<div>
				<p>
					<?php foreach($monument['TextTag'] as $tag) {
						$href = url::base().'search/query/'.$tag['TextTag'];
						$text = $tag['TextTag'];?>
						<a href="<?php echo $href; ?>"><?php echo $text; ?></a>
					<?php } ?>
				</p>
			</div>
			<!--/row-->
            
            <!-- Related events -->
            <div id="related-events">
                <div class="page-header">
                    <h3>Gerelateerde gebeurtenissen</h3>
                </div>
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
            
            <!-- Related people -->
            <div id="related-people">
                <div class="page-header">
                    <h3>Gerelateerde personen</h3>
                </div>
                <div>
                    <table class="table table-striped">
                        <?php foreach($persons as $person): ?>
                        <tr>
                            <td><?php echo $person['Name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
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
