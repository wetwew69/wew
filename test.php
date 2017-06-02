<?php
// example implementation geojson specification according to https://tools.ietf.org/html/rfc7946
// auto update once setup to dynamic data
// pretend output from mysql query
$name = "dude";
$markers = array(
	array('brgy' => 'malupet', 'owner' => $name, 'lat' => 120.88746070861816, 'long' => 14.840934653949455),
	array('brgy' => 'dawo', 'owner' => $name, 'lat' => 120.93561172485352, 'long' => 14.81197708271021),
	array('brgy' => 'cebu', 'owner' => $name, 'lat' => 125.6001663208008, 'long' => 9.067008556959166),
	array('brgy' => 'lawaan', 'owner' => $name, 'lat' => 120.99140167236328, 'long' => 14.718108077356941)
);
 

// prepare our markers
$features = array();
foreach ($markers as $markerInfo) {
	$property = array( "name" => $markerInfo['brgy'], "owner" => $markerInfo['owner']);
	$geometry = newMarker($markerInfo['lat'], $markerInfo['long']);
	$features[] = newFeature($property, $geometry); // append to $features array 
}


// this will output back to browser
header('Content-Type: application/json'); // tell browser we are outputing json format
echo json_encode(newGeoJson($features)); // convert array to json string
//--------------------------------------




// ---------------------------------
// FUNCTIONS
// ---------------------------------
//
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