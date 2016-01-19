<?php
	
	// Author Angshuman Baruah. Please give feedback to this email angshuman0baruah@gmail.com

		$amt = $_GET['amt'];
		$frm = $_GET['frm'];
	
	function currency_converter($convertable_amount,$convert_currency_from) {
		/*
			author: angshuman baruah
			subject : currency_converter - stage 1
			year : 2016
		*/
		$to_crncy_geo =  currency_code();
		$from_currency    = $convert_currency_from; // as per php get
		$to_currency    = $to_crncy_geo;
		$amount            = $convertable_amount; 
		$results = converCurrency($from_currency,$to_currency,$amount);
		$regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s';
		preg_match($regularExpression, $results, $finalData);
		$pre_final_x = $finalData[0];
		$pre_final = str_replace($to_currency,"",$pre_final_x);
		$before_final = str_replace(" ","",$pre_final);
		return $before_final;
	}
	
	function currency_code() {
		/*
			author: angshuman baruah
			subject : currency_code 
			year : 2016
		*/
		$current_place_ip = current_location_ip(); //  for local use static IP
		$finf_geo_details =  unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$current_place_ip));
		return  $finf_geo_details['geoplugin_currencyCode']; //return currency code accoring to location
	}
	
	function client_country() {
		/*
			author: angshuman baruah
			subject : client country with country code 
			year : 2016
		*/
		$current_place_ip = current_location_ip(); //  for local use static IP
		$finf_geo_details =  unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$current_place_ip));
		return  $finf_geo_details['geoplugin_countryName']." (".$finf_geo_details['geoplugin_countryCode'].")"; //return country name with code accoring to location
	}
	
	function converCurrency($from,$to,$amount){
		/*
			author: angshuman baruah
			subject : currency_converter  - stage 2
			year : 2016
		*/
		$url = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to"; 
		$request = curl_init(); 
		$timeOut = 0; 
		curl_setopt ($request, CURLOPT_URL, $url); 
		curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
		curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
		$response = curl_exec($request); 
		curl_close($request); 
		return $response;
	}
	
	function current_location_ip() {
		/*
			author: angshuman baruah
			subject : current_location_ip 
			year : 2016
		*/
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
?>
