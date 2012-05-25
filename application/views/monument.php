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
            <div class="row">
                <div class="btn-group">
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-list icon-white"></i> Toevoegen aan... 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo HTML::anchor('/list/favorite/add/' . $monument['MonumentID'], 'Favorieten'); ?></li>
                        <li><?php echo HTML::anchor('/list/visited/add/' . $monument['MonumentID'], 'Bezochte monumenten'); ?></li>
                        <li><?php echo HTML::anchor('/list/wish/add/' . $monument['MonumentID'], 'Nog te bezoeken'); ?></li>
                    </ul>
                </div><!--/btn-group-->
            </div><!--/row-->
			<div class="row">
				<h2>Beschrijving</h2>
				<p><?php echo isset($monument) ? $monument['Description'] : 'Undefined' ?></p>
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
    <div class="row">
    	<div class="span2">&nbsp;</div>
        <div class="span8">
        	<div class="page-header">
            	<h1>Commentaar</h1>
            </div>
        
        	<?php foreach($comments as $comment): ?>
            <div>
            	<div class="comment-header">
                	<h3>
					<?php echo htmlspecialchars($comment['Name']); ?>
                        <small class="pull-right">
						<?php echo htmlspecialchars($comment['PlaceDate']); ?>
                        </small>
					</h3>
				</div>
                <div class="comment-content">
                	<p>
                	<?php echo htmlspecialchars($comment['Comment']); ?>
                    </p>
                </div>
            </div>
            <hr />
			<?php endforeach; ?>
        </div>
     	<div class="span2">&nbsp;</div>
    </div>
</div><!--/container-->
