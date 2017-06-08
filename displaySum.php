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
	$sumCommand = "select sum(landarea) from landareadetails where isSelected = 1";
	$sum = $conn->query($sumCommand);
	
	
	
	if($sum->num_rows>0){
		while($row = $sum->fetch_assoc()){
			$totalLand = $row["sum(landarea)"];
			if($totalLand == null)
				echo "DISPLAY";
			else
				echo "$totalLand units";
		}
	}
	
	$conn->close();

?>