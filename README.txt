# PHP Nest Thermostat Application running on IBM Bluemix


This is a PHP class, running on IBM Bluemix, which calls info from your Nest Thermostat. It integrated Twilio SMS service to send a SMS message with the return of the nest call. The interface shows the current temperature reading from the Nest


You will need to register your Thermostat and obtain your Auth Token from: https://developer.nest.com/documentation


You will need to add your URL path (with Auth Token) into the index.php file. After this set the env variables with both ‘to’ and ‘from’ numbers from Twilio. 


This application requires you to bind Twilio service into your application

N.B. For this application, the temperature from the Nest should not change regularly so I did not add a regular time interval refresh. Just simply refresh the page