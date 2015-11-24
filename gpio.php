<?php
//Adapted from -> TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/

//This page is requested by the JavaScript, it updates the pin's status and then print it
//Pin numbers are BCM pin numbers (-g tag) and not WiringPi

   //Workout instance id
   $mac = exec("cat /sys/class/net/eth0/address", $abc[0], $def);
   $macadd = str_replace(":", "", $mac);
   $OS= exec("uname -r | cut -d- -f3", $abc[0], $def);
   $hw = exec("cat /proc/cpuinfo | grep Hardware | cut -d: -f 2 | cut -d\" \" -f 2", $abc[0], $def);
   $hwserial = exec("cat /proc/cpuinfo | grep Serial | cut -d: -f 2 | cut -d\" \" -f 2", $abc[0], $def);
   $instanceid = $macadd.$OS.$hw.$hwserial;
//   echo $instanceid;


    //Database connection to insert transactional data
    $conn = new mysqli("localhost", "root", "welcome", "relaydb");
    if ($conn->connect_error) {
       die("Connection failed ".$conn->connect_error);
    }




//Getting and using values
if (isset ( $_GET["pin"] )) {
	$pin = strip_tags ($_GET["pin"]);
	
	//test if value is a number
	if ( (is_numeric($pin)) && ($pin <= 40) && ($pin >= 0) ) {

		
		//Get device name from database based on pin number
		$rsdev = $conn->query("SELECT devices FROM tbldevices WHERE connectedrelayport =(SELECT connectedrelayport from tblpins where 
pins=$pin)");
		while ($row = $rsdev->fetch_assoc()) {
		$devicename = $row["devices"];
		}

//$devicename = "CFL";
		//set the gpio's mode to output		
		system("gpio -g mode ".$pin." out");
		
		//reading pin's status
		exec ("gpio -g read ".$pin, $status, $return );
		
		//set the gpio to high/low
		if ($status[0] == "0" ) { $status[0] = "1"; }
		else if ($status[0] == "1" ) { $status[0] = "0"; }
	
		system("gpio -g write ".$pin." ".$status[0] );
		//Database transaction insert
        	$insert = $conn->query("INSERT INTO tblrelaytransactions (instanceid, gpiopin, device, switchmode, triggersource, timestamp)
        	VALUES ('$instanceid', $pin, '$devicename', $status[0], 'User Interface', NOW())");	

	
		//reading pin's status
		exec ("gpio -g read ".$pin, $status, $return );
		
		//print it to the client on the response
		echo($status[0]);
		
	}
	else { echo ("fail"); }
} //print fail if cannot use values
else { echo ("fail"); }


$conn->close();

?>
