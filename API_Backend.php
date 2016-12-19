<?php

/** Example of some backend integration of the ICA API **/

if(isset($_POST["submit"])) {
	
	//Need To Fill the Values with the provided authentication code and ID from ICA
	$auth_code = "";
	$store_id = "";
	//Please Input Your Stores' Address Here
	$origin = "";
	//Your store's postal code
	$start_suburb = "";
	
	//Post Data Collected From Your Custom Form or Database
	$customer_name = $_POST["cust_name"];
	$customer_email = $_POST["cust_email"];
	$customer_phone = $_POST["cust_phone"];
	$destination = $_POST["destination"];
	$suburb = $_POST["suburb"]
	$date = $_POST["date"];

	//Must use these functions to concatenate the addresses and date for the url request
	$origin = strtolower(str_replace(' ', '+', $origin));
	$destination = strtolower(str_replace(' ', '+', $destination));
	$date = strtolower(str_replace('-', '+', $date));

	//URL that makes request to ICA's API
	//Place data inside url request
	$url = "http://www.icadeliveries.com/API_proxcheck.php?origin={$origin}&destination={$destination}&start_suburb={$start_suburb}&suburb={$suburb}&date={$date}&cust={$customer_name}&cust_email={$customer_email}&cust_phone={$customer_phone}&id={$store_id}&auth={$auth_code}";

	//Return JSON data from ICA
	$json = file_get_contents($url);
	$json = stripslashes($json);
	$results = json_decode($json, true);	
	
	/** Will have 2 results: Price and Message.
	You can use the price value to charge your customer for the delivery **/
	echo $results['price'];
	echo $results['message'];	

}

?>
