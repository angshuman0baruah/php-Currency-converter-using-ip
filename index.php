<?php 
		/*
			author: angshuman baruah
			subject : Country-wise-Currency-Converter ver 1
			year : 2016
			Please give feedback to this email angshuman0baruah@gmail.com
		*/
		
	include("currency_converter.php");
	
	$amount = "10";
	$from_currency = "USD";
	
	$convertable_amount = currency_converter($amount,$from_currency); // jst only call this function for currency convert
	$currency_code = currency_code(); // get currency code
	$client_ip = current_location_ip(); // get client IP
	$client_country = client_country(); // get client country with code
	
	echo $convertable_amount." ".$currency_code." for".$client_country." with Client IP : ".$client_ip;
?>
