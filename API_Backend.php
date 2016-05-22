<?php

if(isset($_POST["submit"])) {
	
	//Need To Fill the Values with the provided authentication code and ID from ICA
	$auth_code = "";
	$store_id = "";
	//Please Input Your Stores' Address Here
	$origin = "";
	
	//Post Data Collected From Your Custom Form
	$customer_name = $_POST["cust_name"];
	$customer_email = $_POST["cust_email"];
	$customer_phone = $_POST["cust_phone"];
	$destination = $_POST["destination"];
	$date = $_POST["date"];

	//Must use these functions to concatenate the addresses and date for the url request
	$origin = strtolower(str_replace(' ', '+', $origin));
	$destination = strtolower(str_replace(' ', '+', $destination));
	$date = strtolower(str_replace('-', '+', $date));

	//URL that makes request to ICA's API
	//Place data inside url request
	$url = "http://www.icadeliveries.com/API_proxcheck.php?origin={$value}&destination={$value2}&date={$date}&cust={$customer_name}&cust_email={$customer_email}&cust_phone={$customer_phone}&id={$store_id}&auth_code={$auth_code}";

	//Return JSON data from ICA
	$json = file_get_contents($url);
	$json = stripslashes($json);
	$results = json_decode($json, true);	
	
	/**Will have 2 results. Price and Message. If delivery request exceeded 15km or ID and Authentication are invalid, the message will have an error.
	You can use the price to charge your customer for the delivery **/
	echo $results['price'];
	echo $results['message'];
	
	
	

}


?>