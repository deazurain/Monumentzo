<?php

echo "<div id='resultsWindow' class='row-fluid'>";
$i = 0;
foreach($results as $result){
	if($i == 0) echo "<div class='row-fluid '>";
	echo "<a href='/monument/view/".$result['MonumentID']."' class='span3'>";
	echo "<div class='well result'>";
	echo "<div class='row'>";
	echo "<img src='/".$result['Image']."'/>";
	echo "</div><div class='row'><p>";
	echo $result['Name'];
	echo "</p></div><div class='row'><p>";
	echo $result['Place'];
	echo "</p></div></div></a>";
	$i++;
	if($i == 4) {
		echo "</div>";
		$i = 0;
	}
}
echo "</div>";
?>
