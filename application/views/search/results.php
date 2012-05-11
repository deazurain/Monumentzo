<?php
echo "<div id='resultsWindow' class='row-fluid'>";
$i = 0;
foreach($results as $result){
	if($i == 0) echo "<div class='row-fluid '>";
	echo "<div class='span3'>";
	echo "<div class='well result'>";
	echo "<div class='row'>";
	echo "<img src='/".$result['image']."' />";
	echo "</div><div class='row'><p>";
	echo $result['name'];
	echo "</p></div><div class='row'><p>";
	echo $result['place'];
	echo "</p></div></div></div>";
	$i++;
	if($i == 4) {
		echo "</div>";
		$i = 0;
	}
}
echo "</div>";
?>