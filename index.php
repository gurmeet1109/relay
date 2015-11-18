<!DOCTYPE html>
<!-- This is enhanced version of TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>Relay Module Control Panel</title>
    </head>
 
    <body style="background-color:gray;">

	<?php


	$val_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
	$pin_array();
	$dev_array();
	$surge_array();

	//MySQL code to fetch values from Database
	//---------------------------------------

	//Database connection
	$conn = new mysqli(localhost, "root", "welcome", "relaydb");
	if ($conn->connect_error) {
		die("Connection failed ".$conn->connect_error);
	}
	
	//Read data - Select Queries
	$rspins = $conn->query("Select pins from tblpins");
	$rsdevices = $conn->query("Select devices from tbldevices");
	$rssurge = $conn->query("Select protection_enalbed from tblsurgeprotection"):

	
	//GPIO Pin data from database
	$i=0;
	if($rspins->num_rows > 0) {
		while($row = $rspins->fetch_assoc()) {
			$pin_array[i] = $row["pins"];
			i++;
		}
	} else {
		echo ("Error fetching pin data from database");
	}

	//Pre-configured connected Device data from database
	$i = 0;
	if($rsdevices->num_rows > 0) {
		while($row = $rsdevices->fetch_assoc()) {
			$dev_array[i] = $row["devices"];
			i++;
		}
	} else {
		echo ("Error fetching device data from database");
	}
	
	
	//Surge protection data from database
	$i = 0;
	if($rssurge->num_rows > 0) {
		while($row = $rssurge->fetch_assoc()) {
			$surge_array[i] = $row["protect_enabled"];
			i++;
		}
	}
	
	
	
	//Close database connection. We are done selecting rows from database
	$conn->close();
	
	//---------------------------------------------------------------
	//Done database code


	//Page initialization - Initialize GPIO pins to OUT
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
