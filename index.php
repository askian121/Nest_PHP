<!DOCTYPE html PUBLIC>


<!--
PHP Application for connecting to your Nest Thermostat, running on Bluemix. 

This section is handling the header  -->


<html>
<head>
<title>ASKIAN121</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery.min.js"></script>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="http://askian121.com/">ASKIAN121</a></h1> 
      <p>Bluemix and PHP</p>
    </div>
    <div class="fl_right">
      <ul id="topnav" class="clear">
        <li class="active last"><a href="index.html">Home</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="box size3">
  <div id="homepage" class="clear" >
    <p>This is a demo of how you can use an API call with Bluemix from Nest Thermostat</p>
    <div class="fl_right">

      <br>

<?php

$fahrenheit;
$celsius;

//From here until line 143, this is the important piece of the application where this web-based PHP application is calling the response out from the Nest
//A handy way of checking and testing the API is to deploy an instance of NodeRed in Bluemix and set up the API and response
//When you call the API directly from Nest (on line 46) your url would appear like: "https://developer-api.nest.com/devices/thermostats?auth=c.h6UdU11e....XXXXXXX" where you replace your Auth Token after ?auth=
    echo('<h1>Reading from my Nest @Home</h1>');

//in the section below you will need to replace the url with your url path followed by your Auth Toke
$json = file_get_contents('https://developer-api.nest.com/devices/thermostats?auth=xxxxxxxxxxxxYOUr AUTH TOKEN GOES HERExxxxxxxxxx');
$val=explode(",",$json);
foreach($val as $key => $value) {
  //this is where you read the return call to extract the specific of what you need.
  //below we use the abmient temp in farenheight to return the first element (line 51)
    if(strpos($value,"ambient_temperature_f")!="")
    {
      //This then prints the value of the temp and stores it as temp[1]
        $value;
        $temp=explode(":",$value);
        $fahrenheit = $temp;
        echo "House Temperature in F is: ".$temp[1];
        echo("<br/>");
    }
    //For the European's I added the Farenheight reading
    elseif(strpos($value,"ambient_temperature_c")!="")
    {
      //This then prints the out below in C
      //The &nbsp just adds the space to show the difference (remove for formatting if required)
        $value;
        $temp=explode(":",$value);
        $celsius = $temp;
        echo "House Temperature in C is: &nbsp;".$temp[1];
        echo("<br/>");
    }
}

?>

<br>
<br>
<br>

<div class="body_right_comment_input">
  <div id="homepage" class="clear" >

<p>Pressing the button below will use Twilio to send me a SMS</p>
<input type="submit" class="button" name="sendMessage" value="Send Message" />

<script>

$(document).ready(function () {
  $('.button').click(function(){

    var celsius = '<?php echo $celsius[1]; ?>';
    var fahrenheit = '<?php echo $fahrenheit[1]; ?>';

    //this section below is a post request to the sendMessage.php file contained in the source code
    $.post('sendMessage.php',
    { tempC: celsius, tempF: fahrenheit }
       ).done(function(){
            //This section below will make a window pop out which will inform you the message has been sent 
            alert("SMS Successfully SENT!!!");
       });
    });
});

</script>
  </div>
  </div>
</div>

<br>
<br>

<!-- ####################################################################################################### -->
<!-- Here you can replace the hrefs with all your own social links or simply remove this section-->
<div>
  <div>
    <div>
      <div id="container" class="box size3">
        <ul>
          <li><span>My Blog:</span> <a href="https://askian121.com/">Read my Bluemix and Tech Blog</a></li>
          <li><span>Twitter:</span> <a href="https://www.twitter.com/askian121">Follow me on Twitter</a></li>
          <li><span>LinkedIn:</span> <a href="https://ie.linkedin.com/in/askian121">Connect with me on LinkedIn</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="http://askian121.com/">askian121.com</a></p>
  </div>
</div>
</body>
</html>
