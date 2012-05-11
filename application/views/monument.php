
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span7">
    		<img src="assets/img/1.jpg">
		</div><!--/span-->
		<div class="span5">
			<div class="row">
				<h1><?php echo isset($monument) ? $monument->name ?></h1>
				<p><?php echo isset($monument) ? $monument->city ?></p>
				<p><?php echo isset($monument) ? $monument->street ?> <?php echo isset($monument) ? $monument->streetNumberText ?></p>
				<p><?php echo isset($monument) ? $monument->foundationDateText ?></p>
			</div><!--/row-->
			<div class="row">
				<h2>Beschrijving</h2>
				<p><?php echo isset($monument) ? $monument->discription ?></p>
			</div><!--/row-->
		</div><!--/span-->
	</div><!--/row-->
</div><!--/container-->
