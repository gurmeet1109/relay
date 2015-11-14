<!DOCTYPE html>
<!-- This is enhanced version of TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>Relay Module Control Panel</title>
    </head>
 
    <body style="background-color:gray;">

    <!-- On/Off button's picture -->
	<?php
	
	$pin_array = array(17,27,22,5,18,23,24,25,12,13,19,26);
	$val_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
	$dev_array = array("Motor", "Pedestal Fan", "CFL", "Cooler", "Chanting Machine", "Bulb Cluster", "Incasedent Bulb", "LED Lamp", "Bulb Cluster", "Table 
Fan", "Ceiling Fan", "Tube Light" );
	$surge_array = array("Surge Protection - IC", "Surge Protection - IC", "Surge Protection - IC", "Surge Protection - IC", "Unprotected", "Unprotected", 
"Unprotected", "Unprotected", "Surge Protection - RC", "Surge Protection - RC", "Surge Protection - RC", "Surge Protection - RC");  

	//this php script generate the first page in function of the file
	for ( $i= 0; $i<12; $i++) {
		//set the pin's mode to output and read them
		system("gpio -g mode ".$pin_array[$i]." out");
		exec ("gpio -g read ".$pin_array[$i], $val_array[$i], $return );
	}
	

	echo ("<table>");

	echo ("<tr>");

	//for loop to read the value and output corresponding image
	//First for loop set for the 0-3 gpio pins
	for ($i = 0; $i < 12; $i++) {
	
	//if off
	if ($val_array[$i][0] == 0 ) {
	
		echo ("<td><img id='button_".$i."' src='data/img/red/red.jpg' onclick='change_pin($pin_array[$i]);'/><br>$dev_array[$i]<br>$surge_array[$i] 
<br>.</td>");
//		echo ( $pin_array[$i] );
//		echo ( "&nbsp" );
//		echo ( $val_array[$i][0] );
	}

	//if on
	if ($val_array[$i][0] == 1 ) {
	echo ("<td><img id='button_".$i."' src='data/img/green/green.jpg' 
onclick='change_pin($pin_array[$i]);'/><br>$dev_array[$i]<br>$surge_array[$i]<br>.</td>");

//		echo ( $pin_array[$i] );
//		echo ( "&nbsp" );
//		echo ( $val_array[$i][0] );
	}

	if( ($i+1)%4 == 0) {
		echo ("\n</tr><tr>");
		}	 
	}
	
	echo ("\n</tr>");

	echo ("\n</table>");

?>
	 
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>
