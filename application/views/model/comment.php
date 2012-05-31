<?php
/*
 * Comments are placed inside of a list:
 * 		<ul class="comment-list">
 */
?>

<li class="comment" model-id="<?php echo htmlspecialchars($id); ?>">

	<div class="comment-container">

		<div class="header">
			<h3>
				<?php echo htmlspecialchars($name); ?>
				<small class="pull-right">
					<?php echo htmlspecialchars($placeDate); ?>
				</small>
			</h3>
		</div>

		<div class="row-fluid">

			<div class="span10 content">
				<p>
					<?php echo htmlspecialchars($comment); ?>
				</p>
			</div>

			<div class="span2 actions">

				<div class="btn-toolbar pull-right">
					<button class="btn btn-danger">Verwijder</button>
				</div>

			</div>

		</div>

	</div>

	<hr />

</li>
