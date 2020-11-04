<?php
	
function randomName() {
	// Get the  files
	$first = file_get_contents('random_name/first.txt');
	$second = file_get_contents('random_name/second.txt');
	
	// Here we split it into lines
	$first = explode("\n", $first);
	shuffle($first);
	$second = explode("\n", $second);
	shuffle($second);
	
	while(strstr($second[0],$first[0])) {
		shuffle($first);
		shuffle($second);
	}
	
	return $first[0] . ' ' . $second[0];
	//return 'fart';
}

?>	