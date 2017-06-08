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
	
	$totalLand = "";
	$sUsername = $_POST['username'];
	$updateCommand = "update landareadetails set isSelected = 1 where username = '$sUsername'";
	$update = $conn->query($updateCommand);
	
	$conn->close();
?>