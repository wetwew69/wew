<?PHP

	$servername = "localhost";
	$dbusername = "root";
	$password = "surium";
	$dbname = "userinputdb";
	$hasError = false;
	$selectionMode = false;
	$conn = new mysqli($servername, $dbusername, $password, $dbname);
	if($conn->connect_error){
		die("Connection failed" . $conn->$connect_error);
	}
	
	//get from gis.js or index.php
	$dUsername = $_POST['username'];
	$dPlantingDate = $_POST['plantingDate'];
	//echo $dUsername;
	$upDate = "update landareadetails set plantingDate = '$dPlantingDate' where username = '$dUsername'";
	$upDateCommand = $conn->query($upDate);
	
	$fetchDate = "select plantingDate from landareadetails where username = '$dUsername'";
	$fetchDateQuery = $conn->query($fetchDate);
	
	if($fetchDateQuery->num_rows > 0){
		while($row = $fetchDateQuery->fetch_assoc()){
			$fetchResult = $row["plantingDate"];
			//echo "old date: $fetchResult <br>";
		}
	}
	$setDate = "select date_add('$fetchResult', interval 3 month)"; 
	$setDateQuery = $conn->query($setDate);
	
	if($setDateQuery->num_rows > 0){
		while($row = $setDateQuery->fetch_assoc()){
			$harvestDate = $row["date_add('$fetchResult', interval 3 month)"];
			//echo "new date: $harvestDate <br>";
		}
	}
	
	$updateHarvestDate = "update landareadetails set harvestDate = '$harvestDate' where username = '$dUsername'";
	$UHDQuery = $conn->query($updateHarvestDate);
	
	
	$showUpdate = "select harvestDate from landareadetails where username = '$dUsername'";
	$showDateQuery = $conn->query($showUpdate);
	
	if($showDateQuery->num_rows > 0){
		$row = $showDateQuery->fetch_assoc();
		$harvestDateDisplay = $row["harvestDate"];
		echo $harvestDateDisplay;
	}
	
	$conn->close();

?>