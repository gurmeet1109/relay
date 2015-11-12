<!DOCTYPE html>
<!-- This is borrowed from and enhanced version of TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>Relay Module Control Panel</title>
    </head>
 
    <body style="background-color: black;">
    <!-- On/Off button's picture -->
	<?php
	
	$pin_array = array(17,27,22,5,18,23,24,25,12,13,19,26);
	$val_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
	

	//this php script generate the first page in function of the file
	for ( $i= 0; $i<12; $i++) {
		//set the pin's mode to output and read them
		system("gpio -g mode ".$pin_array[$i]." out");
		exec ("gpio -g read ".$pin_array[$i], $val_array[$i], $return );
	}
	
	//for loop to read the value and output corresponding image
	$i =0;
	for ($i = 0; $i < 12; $i++) {
		//if off
		if ($val_array[$i][0] == 0 ) {
			echo ("<img id='button_".$i."' src='data/img/red/red.jpg' onclick='change_pin (".$pin_array[$i].");'/>");
		}
		//if on
		if ($val_array[$i][0] == 1 ) {
			echo ("<img id='button_".$i."' src='data/img/green/green.jpg' onclick='change_pin (".$pin_array[$i].");'/>");
		}	 
	}
	?>
	 
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>
