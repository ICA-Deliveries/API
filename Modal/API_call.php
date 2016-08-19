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

	$auth_code = $return["auth"];
	$store_id = $return["id"];
	$customer_name = $return["cust"];
	$customer_email = $return["cust_email"];
	$customer_phone = $return["cust_phone"];
	$origin = $return["origin"];
	$destination = $return["destination"];
	$date = $return["date"];

	//Must use these functions to concatenate the addresses and date for the url request
	$origin = strtolower(str_replace(' ', '+', $origin));
	$destination = strtolower(str_replace(' ', '+', $destination));
	$date = strtolower(str_replace('-', '+', $date));


	//Place data inside url request
	$url = "http://www.icadeliveries.com/API_proxcheck.php?origin={$origin}&destination={$destination}&date={$date}&cust={$customer_name}&cust_email={$customer_email}&cust_phone={$customer_phone}&id={$store_id}&auth={$auth_code}";

	//Return JSON data from ICA
	$json = file_get_contents($url);
	$json = stripslashes($json);
	$results = json_decode($json, true);	
	
	//Will have 2 results. Price and Message. If ID and Authentication are invalid, the message will have an error
	$price = $results['price'];
	$message = $results['message'];
	
	$result = array("Price: $".$price, $message);
	
	$return["json"] = json_encode($result); 
	print_r(json_encode($return)); 
	
}	


?>
