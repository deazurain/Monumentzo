<?php
/*
 * expects
 * id - Comment ID
 * name - Username
 * placeDate - Date that the comment was placed
 * comment - The comment itself
 * owner - Whether or not the currently logged in user is the owner of the comment
 *
 * Comments are placed inside of a list:
 * 		<ul id="comment-list">
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

				<?php if($owner) { ?>
				<div class="pull-right">
					<button class="btn btn-danger">Verwijder</button>
				</div>
				<?php } ?>

			</div>

		</div>

	</div>

	<hr />

</li>
