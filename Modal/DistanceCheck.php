<?php

if (is_ajax()) { 
 if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists 
 $action = $_POST["action"]; 
 switch($action) { //Switch case for value of action 
 case "test": test_function(); break; 
  } 
  } 
 } 
  
 //Function to check if the request is an AJAX request 
 function is_ajax() { 
 return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'; 
 } 
  
function test_function(){ 
$return = $_POST; 

$start = $return["origin"];
$end = $return["destination"];

  
$value = strtolower(str_replace(' ', '+', $start));
$value2 = strtolower(str_replace(' ', '+', $end));

$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$value}&destinations={$value2}&mode=driving&language=English-en&key=AIzaSyCY6IMbDoPAZK5ZCVQmgn1MFL25NU2BcFA";
$json = file_get_contents($url); // get the data from Google Maps API
$result = json_decode($json, true); // convert it from JSON to php array
$result2 = $result['rows'][0]['elements'][0]['distance']['text'];


$value3 = strtolower(str_replace(',', '', $result2));
$value4 = strtolower(str_replace('km', '', $value3));
$value5 = strtolower(str_replace(' ', '', $value4));
$valuem = strtolower(str_replace('m', '', $value5));

if($valuem > 0 && $valuem <= 15) {
	$response = "Success! Distance = $valuem km. Your delivery is within the 15km delivery range for ICA Deliveries";
}
elseif(!isset($valuem)) {
	$response = "Distance = $valuem km. Sorry, your delivery exceeds our 15km maximum";
}
else{
	$response = "Distance = $valuem km. Sorry, your delivery exceeds our 15km maximum";
}
 
$data = array("Response"=>$response
);

  
$return["json"] = json_encode($data); 
print_r(json_encode($return)); 
 
}
?>