	<?php
	// example implementation geojson specification according to https://tools.ietf.org/html/rfc7946
	// auto update once setup to dynamic data
	// pretend output from mysql query

	$servername = "localhost";
	$dbusername = "root";
	$password = "surium";
	$dbname = "userinputdb";
	$conn = new mysqli($servername, $dbusername, $password, $dbname);
	
	if($conn->connect_error){
		die("Connection failed" . $conn->$connect_error);
	}
	
	$command = "select username, farmername, landarea, usercrop, plantingdate, harvestdate, latitude, longitude, isSelected from landareadetails";
	$result = $conn->query($command);
	$markers = array();
	//must be in other function
	// $sUsername = $_POST['username'];
	// $sBool = $_POST['isSelected'];
	// $sql = "update testland set isSelected = '$sBool' where username = '$sUsername'";
	// $anotherResult = $conn->query($sql);
	
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$markers[] = array(
				array('username' => $row['username'], 'owner' => $row['farmername'], 
				'lotarea' => $row['landarea'], 'crop' => $row['usercrop'],
				'dateplanted' => $row['plantingdate'], 'estimatedharvestdate' => $row['harvestdate'],
				'lat' => $row['latitude'], 'long' => $row['longitude'], 'isSelected' => $row['isSelected'])
			);
	
		}
		
		//print_r($markers);	
	}

	// prepare our markers
	$features = array();
	foreach ($markers as $markerInfo) {
		$hold = 0;
		$property = array( "name" => $markerInfo[$hold]['username'], "owner" => $markerInfo[$hold]['owner'],
							"lotarea" => $markerInfo[$hold]['lotarea'], "crop" => $markerInfo[$hold]['crop'],
							"dateplanted" => $markerInfo[$hold]['dateplanted'], "dateharvest" => $markerInfo[$hold]['estimatedharvestdate'],
							"isSelected" => $markerInfo[$hold]['isSelected']);
		$geometry = newMarker($markerInfo[$hold]['lat'], $markerInfo[$hold]['long']);
		$features[] = newFeature($property, $geometry); // append to $features array 
		$hold++;
		//print_r($markerInfo[$hold]);
	}


	// this will output back to browser
	header('Content-Type: application/json'); // tell browser we are outputing json format
	echo json_encode(newGeoJson($features)); // convert array to json string
	//--------------------------------------



	// ---------------------------------
	// FUNCTIONS
	// ---------------------------------

	// geojson 
	function newGeoJson($features) {
		return array(
			"type" => "FeatureCollection",
			"features" => $features // our markers is here
		);
	}

	// feature
	function newFeature($property, $geometry) {
		return array(
			"type" => "Feature",
			"properties" => $property,
			"geometry" => $geometry
			);
	}

	// marker
	function newMarker($lat,$lng) {
		return array(	
				"type" => "Point",
				"coordinates" => array($lat,$lng)
			);
	}
	
	?>