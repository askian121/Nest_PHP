<?php

// Licensed under the Apache License. See footer for details.

$celsius = $_POST['tempC'];
$fahrenheit = $_POST['tempF'];

require('vendor/autoload.php');

// Firstly this will get authentication Variables from VCAPS_SERVICES. 
// We then pull in our Twilio connection variables from the VCAPS_SERVICES environment variable. 
// You need to add the env variables into Bluemix using the CLI or accessing the bound Twilio service user-fefined varibles
// This is documented in the read me file on Github

// var_dump(getenv('VCAPS_SERVICES'));




// vcap_services Extraction
// For debug, you can see all the variables returned you using this LOC below:
// var_dump($services_json);      .........just remove the "//" at the beginning

$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["user-provided"][0]["credentials"];

// This element extracts the VCAP_SERVICES variables for Twilio connection in Bluemix
 $sid = $VcapSvs["accountSID"];
 $token = $VcapSvs["authToken"];

 try {
 	if (is_null($sid) || is_null($token) || empty($sid) || empty($token)) {
 		echo "<p>Failed to retrieve Twilio authentication parameters.</p>";

// It then sets the envoirement variables for the to and from number 
 	} else {
		$fromNumber = getenv('MY_TWILIO_NUMBER'); //This is your Twilio number which can handle SMS
		$toNumber = getenv('MY_DESTINATION_NUMBER'); //This is set as the number to recieve 

		$client = new Services_Twilio($sid, $token);
		$message = $client->account->messages->sendMessage(
		  $fromNumber, // From a valid Twilio number
		  $toNumber, // Text this number you gave
		  "This is your Nest@Home: House Temperature in C is: " . $celsius .
      "House Temperature in F is: " . $fahrenheit
		);

		echo "<p>Sent the SMS. Confirmation SID " . $message->sid . "</p>";
 	}
}
  catch(Exception $e) {
  //We sent something to Sag that it didn't expect.
  echo '<p>There was an error sending an SMS using Twilio!!!</p>';
  echo $e->getMessage();
}

//-------------------------------------------------------------------------------
// Copyright IBM Corp. 2014
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
// http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//-------------------------------------------------------------------------------
?>
