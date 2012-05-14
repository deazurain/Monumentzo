
<div id="monument" class="container">
	<div class="row">
		<div class="span7">
    		<?php echo isset($monument) ? "<img src='/".$monument['Image']."' />" : 'Undefined' ?>
		</div><!--/span-->
		<div class="span5">
			<div class="row">
				<h1><?php echo isset($monument) ? $monument['Name'] : 'Undefined' ?></h1>
				<table class="table">
					<tr>
						<td>Monumentnummer</td>
						<td><?php echo isset($monument) ? $monument['MonumentID'] : 'Undefined' ?></td>
					<tr>
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
					<tr>
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
				<h2>Beschrijving</h2>
				<p><?php echo isset($monument) ? $monument['Description'] : 'Undefined' ?></p>
			</div><!--/row-->
		</div><!--/span-->
        <div class="row">
        	<?php echo HTML::anchor('/list/add_favorite/' . $monument['MonumentID'], 'Toevoegen aan favorieten'); ?>
        </div>
	</div><!--/row-->
</div><!--/container-->
