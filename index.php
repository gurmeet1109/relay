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

	//Initialization
        $val_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
	

        //Database code - Population of Master Data
        $dbhandle = sqlite_open('relaydb');
        $pin_resultset = sqlite_array_query($dbhandle, 'Select pins from tblpins', SQLITE_ASSOC);
        $dev_resultset = sqlite_array_query($dbhandle, 'Select devices from tbldevices', SQLITE_ASSOC);
        &surge_resultset = sqlite_array_query($dbhandle, 'Select protect_enabled from tblsurgeprotection', SQLITE_ASSOC);
	sqlite_close($dbhandle);

	for ($i=0; i<12; i++) {
	}

	foreach ($surge_resultset AS surges) {
	}	


	//this php script generate the first page in function of the file
	for ( $i= 0; $i<12; $i++) {
		//set the pin's mode to output and read them
		system("gpio -g mode ".$pin_array[0][$i]." out");
		exec ("gpio -g read ".$pin_array[0][$i], $val_array[$i], $return );
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
//		echo ( $pin_array[0][$i] );
//		echo ( "&nbsp" );
//		echo ( $val_array[$i][0] );
	}

	//if on
	if ($val_array[$i][0] == 1 ) {
	echo ("<td><img id='button_".$i."' src='data/img/green/green.jpg' onclick='change_pin($pin_array[$i]);'/><br>$dev_array[$i]<br>$surge_array[$i]<br>.</td>");

//		echo ( $pin_array[0][$i] );
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
