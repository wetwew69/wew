<?php 
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
	
	
	//$sUsername = $_POST['username']; // find a way not to use  this on start up
	//$sBoolean = $_POST['isSelected'];
	
	$checkCmd = "select * from landareadetails where isSelected = 1";
	$check = $conn->query($checkCmd);
	
	if($check->num_rows>0){
		$refreshCommand = "update landareadetails set isSelected = 0";
		$refresh = $conn->query($refreshCommand);
		
	}
	
		echo "DISPLAY";
	// $updateCommand = "update landareadetails set isSelected = 1 where username = '$sUsername'";
	// $update = $conn->query($updateCommand);
	
	// $sumCommand = "select sum(landarea) from landareadetails where isSelected = 1";
	// $sum = $conn->query($sumCommand);
	
	
	
	// if($sum->num_rows>0){
		// while($row = $sum->fetch_assoc()){
			// echo $row["sum(landarea)"];
		// }
	// }
	$conn->close();
?>