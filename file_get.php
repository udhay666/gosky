<?php
ini_set('memory_limit', '-1');
$section = file_get_contents('./city_logs.json');
$data = json_decode($section);
//echo '<pre>';print_r($data);exit;

	$servername = "localhost";
	$username = "tpdtechnosoft";
	$password = "Tpdtech9#p@600";
	$dbname = "tpdtechn_bizzholidays";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	foreach($data as  $value) {
	    
	   // 	echo '<pre>';print_r($value);exit;
		$city_id = $value->cityid;
		$city_name = $value->Destination;
		$state_province = $value->stateprovince;
		$StateProvinceCode = $value->StateProvinceCode;
		$country_name = $value->country;
		$country_code = $value->countrycode;
		$sql = "INSERT INTO tbo_hotels_city_list (city_id, city_name,state_province,StateProvinceCode,country_name,country_code)
		VALUES ('".$city_id."', '".$city_name."', '".$state_province."', '".$StateProvinceCode."', '".$country_name."', '".$country_code."')";
		
		if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
		} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	}
		
	echo "Record Fully Created"; 

	$conn->close();
?>