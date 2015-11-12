//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//JavaScript, uses pictures as buttons, sends and receives values to/from the Rpi
//These are all the buttons
// var button_0 = document.getElementById("button_0");
var button_1 = document.getElementById("button_1");
var button_2 = document.getElementById("button_2");
var button_3 = document.getElementById("button_3");
var button_4 = document.getElementById("button_4");
var button_5 = document.getElementById("button_5");
var button_6 = document.getElementById("button_6");
var_button_7 = document.getElementById("button_7");
var_button_8 = document.getElementById("button_8");
var_button_9 = document.getElementById("button_9");
var_button_10 = document.getElementById("button_10");
var_button_11 = document.getElementById("button_11");
var button_12 = document.getElementById("button_12");


//Create an array for easy access later
var Buttons = [ button_1, button_2, button_3, button_4, button_5, button_6, button_7, button_8, button_9, button_10, button_11, button_12 ];

//This function is asking for gpio.php, receiving datas and updating the index.php pictures
function change_pin ( pin ) {
var data = 0;
//send the pic number to gpio.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	request.open( "GET" , "gpio.php?pin=" + pin, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the index pic
			if ( !(data.localeCompare("0")) ){
				Buttons[pin].src = "data/img/red/red.jpg";
			}
			else if ( !(data.localeCompare("1")) ) {
				Buttons[pin].src = "data/img/green/green.jpg";
			}
			else if ( !(data.localeCompare("fail"))) {
				alert ("Something went wrong!" );
				return ("fail");			
			}
			else {
				alert ("Something went wrong!" );
				return ("fail"); 
			}
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}
