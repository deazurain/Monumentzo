<div id='resultsWindow' class='row-fluid'>

<?php

$i = 0;
foreach($results as $monument) {

	$id = $monument['MonumentID'];
	$image = '/' . $monument['Image'];
	$name = $monument['Name'];
	$place = $monument['Place'];

	if($i == 0) {
		echo "<div class='row-fluid '>";
	}

?>
	
	<a href="<?php echo url::base(); ?>monument/view/<?php echo $id;?>" class="span3">
		<div class="well result">
			<div class="row-fluid"><div class="span12"><img src="<?php echo '/assets/img/monuments/thumb/'.$id.'.jpg';?>"/></div></div>
			<div class="row-fluid"><div class="span12"><p><?php echo $name;?></p></div></div>
			<div class="row-fluid"><div class="span12"><p><?php echo $place;?></p></div></div>
		</div>
	</a>
		
<?php

	$i++;
	if($i == 4) {
		echo "</div>";
		$i = 0;
	}
}

/* close fluid div when the number of
 * results is not an exact multiple of 4 */
if($i != 0) {
	echo "</div>";
}

?>

</div>
