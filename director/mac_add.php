<?php
	ob_start(); // Turn on output buffering
	system('ipconfig /all'); //Execute external program to display output
	$mycom 	= ob_get_contents(); // Capture the output into a variable
	ob_clean(); // Clean (erase) the output buffer
	$findme = "IPv4";
	$pmac 	= strpos($mycom, $findme); // Find the position of Physical text
	$mac	=substr($mycom,($pmac+36),13); // Get Physical Address
	echo $mac;
?>
