<!DOCTYPE html>
<!-- This is enhanced version of TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>Relay Module Control Panel</title>
    </head>
 
    <body style="background-color:gray;">

	<?php

	//Initialization
//        $val_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
//	$pin_array = array();	
//	$dev_array = array();
	$surge_array = array();

	

        //Database code - Population of Master Data
        $dbhandle = sqlite_open('relaydb.sqlite');
//        $pin_resultset = sqlite_array_query($dbhandle, 'Select pins from tblpins', SQLITE_ASSOC);
  //      $dev_resultset = sqlite_array_query($dbhandle, 'Select devices from tbldevices', SQLITE_ASSOC);
      &surge_resultset = sqlite_array_query($dbhandle, 'Select protect_enabled from tblsurgeprotection', SQLITE_ASSOC);
	sqlite_close($dbhandle);


//	$counter = 0
//	while ($pin_rs = $pin_resultset->fetchArray(SQLITE_ASSOC)) {
//		$pin_array[$counter] = $pin_rs['pins'];
//		++counter;
//	}

	$counter = 0;
	foreach ($surge_resultset AS $surge_entry) {
		$surge_array[$counter] = $surge_entry['protect_enabled'];
		++counter;
	}	


	echo ("<table>");
	echo ("<tr>");

	for($i=0; $i<12; $i++) {
		echo ( $surge_array[$i]);
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
