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

	//variable definition
	$harvestDate = $plantingDate = $cropName = $username = "";
	$hdErr = $pdERr = $cnErr = "";
	$month = "";
	
		// include 'test.php';
		// print_r($features[0]['properties']['name']);


	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(empty($_POST['username'])){
			$cnErr = "Crop name required";
			$hasError = true;
		}else{
			$username = test_input($_POST['username']);
			if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
				$cnErr = "Only letters and white space allowed";
				$hasError = true;
			}
		}
		
		if(empty($_POST['plantingDate'])){
			$pdERr = "Planting date required";
			$hasError = true;
		}else{
			$plantingDate = test_input($_POST['plantingDate']);
			if(!isDateValid($plantingDate)){
				$hasError = true;
				$pdERr = "Invalid date format";
			}
		}
		
		if($hasError){
			//temporary solution. much better if we show confirm button then click ok then redirect.
			header("Location: http://localhost/RedRootCMS/goback.php");
			//------
			
		}
		else{
			$command = "update landareadetails set usercrop = '$cropName', plantingdate = '$plantingDate', harvestdate = '$harvestDate' 
						where username = '$username'";
			$result = $conn->query($command);
			
			header("Location: http://localhost/RedRootCMS/index.php");
		}
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	//returns false if date format is invalid
	function isDateValid($dateInput){
		$d = DateTime::createFromFormat('Y-m-d', $dateInput);
		return $d && $d->format('Y-m-d') === $dateInput;
	}

	//drop down thingy
	$crops = array( 
		'default' => '-- Select a crop --',
		'rice' => 'Rice',
		'corn' => 'Corn',
		'cassava' => 'Cassava',
		'onion' => 'Onion',
		'carrot' => 'Carrot',
		'tomatoe' => 'Tomatoe'
	);

	$cropSelected = isset($_GET['crop'])? $_GET['crop']:'default';

	$conn->close();

	?>

	<!DOCTYPE html>
	<html>
	<style>
	.error {color: #FF0000;}
	</style>
	<head>
		<title>RedRoot Crop Monitoring System</title>
		<meta charset="utf-8" />
		
		
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" rel="stylesheet" />

		<!---->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.0.5/MarkerCluster.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.0.5/MarkerCluster.Default.css" rel="stylesheet" />
		<!---->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		
		<style>
		
		html, body { 
			overflow: hidden;
			height: 100%;
			width: 100%;
		}	
		
		table {
			border: 1px solid black;
		}

		.navbar {
			margin-bottom: 0px;
		}

		.container {
			margin: 0;
			padding: 0;
			width: 100%;
		}	

		.leaflet-popup-content-wrapper,.leaflet-popup-content
		{
			-webkit-border-radius: 0 !important;
			-moz-border-radius: 0 !important;
			border-radius: 0 !important;
		}		
		</style>
	</head>

	
	
	<body>
	
	<!---->
	
			<script>
		function computeVolume(){
			$("#volume").submit(function(event){
				console.log("beep");
				event.preventDefault();
				var url= "volumesum.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#volume").serialize(),
					success: function(result){
						$("#displayVolume").html(result);
					}
				});
				
			
			});
		}
		</script>
	
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
  <form id = "volume" class="navbar-form navbar-left" role="button" method = "post" action ="volumesum.php">
  <div class="btn-group">
  
    <button type="submit" onClick = "computeVolume()" class="btn btn-primary" name = "month" value = <?PHP echo $month = "January"; ?> >January</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "February" >February</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "March" >March</button>
	<button type="submit" class="btn btn-primary" name = "month" value = "April" >April</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "May" >May</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "June" >June</button>
	<button type="submit" class="btn btn-primary" name = "month" value = "July" >July</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "August" >August</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "September" >September</button>
	<button type="submit" class="btn btn-primary" name = "month" value = "October" >October</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "November" >November</button>
    <button type="submit" class="btn btn-primary" name = "month" value = "December" >December</button>
    <button type="submit" class="btn btn-primary" name = "total" value = "TOTAL" >TOTAL</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label> Volume: </label>
	<label id = "displayVolume"> 0000 units</label>
  </div>
  </form>
</div>
      </div>
	<!---->
	
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <label> Total Land Area </label> <br>
		  <!-- try ajax man-->
		  <script>
		  function display(){
			  $(document).ready(function(){
						$.ajax({url: "displaySum.php", success: function(result){
							$("#sumDisplay").html(result);
							}});
				});
		  }
		  
		  function displayVolume(){
			  $(document).ready(function(){
						$.ajax({url: "displaySelectedVolume.php", success: function(result){
							$("#buttonVolume").html(result);
							}});
				});
		  }
		  
		  function clearSelection(){
			  $(document).ready(function(){
						$.ajax({url: "refresh.php", success: function(result){
							
							$("#sumDisplay").html(result);
							$("#buttonVolume").html(result);
							}});
				});
		  }
		  
		  
		  </script>
		  
		 
		  <button onClick = "display()" id = "sumDisplay"> Land Area </button>
		  <button onClick = "displayVolume()" id = "buttonVolume"> Volume </button>
		  
		  <button onCLick = "clearSelection()"> Clear </button>
		  
		</div>
<!--
	   <form class="navbar-form navbar-left" role="search">
		  <div class="form-group">
			<select class="form-control" id="crop" name="crop" onchange="this.form.submit()">
				<?php foreach ($crops as $cropIndex => $cropName) {
				$selected = $cropSelected == $cropIndex ? ' selected' : ($cropIndex == 'default' ? ' selected':'');
				$default = $cropIndex == 'default' ? ' disabled' : '';
				echo "<option value=\"{$cropIndex}\"{$default}{$selected}>{$cropName}</option>";
				}
				?>
			</select>
		  </div>
		</form>
		-->
<!-- Edit Information Button-->
 		<form class="navbar-form navbar-right" role="button">
 					<button class="btn btn-default" type="button"><i class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalNorm">Edit Information</i></button>		      
 		</form>
		<script>
		function saveDate(){
			$("#formoid").submit(function(event){
				console.log("beep");
				event.preventDefault();
				var url= "dateTest.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#formoid").serialize(),
					success: function(result){
						$("#oHarvestDate").html(result);
					}
				});
				
			
			});
		}
		</script>
<!-- -->
<!--
			<form class="navbar-form navbar-right" role="search">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="q" id="q">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
			</form>
			-->

	  </div>
	</nav>
	<div class="container">
		<div id="mapid"></div>
	</div>
	<div class="container">
	<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
		 aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" 
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Edit Crop Information
					</h4>
				</div>
				
				<!-- Modal Body -->
				<div class="modal-body">
					<p> <span class = "error">* Required Field </span></p>
					<form id = "formoid" method = "post" action = "dateTest.php">
					  <div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						  <span class="error">* <?php echo $cnErr;?></span>
						  <input id = "username" type="text" class="form-control"
						  id="exampleInputEmail1" placeholder="Enter username"
						  name = "username" value = "<?PHP echo $username?>"/>
					  </div>
					  <div class="form-group">
					  <div>
						<label for="exampleInputEmail1">[YYYY-MM-DD]</label>
						</div>
						<label for="exampleInputEmail1">Planting Date</label>
						  <span class="error">* <?php echo $pdERr;?></span>
						  <input id = "plantingDate" type="text" class="form-control"
						  id="exampleInputEmail1" placeholder="Enter Date"
						  name = "plantingDate" value = "<?PHP echo $plantingDate?>"/>
					  </div>
					  <!-- high five! -->
					  <div class="form-group">
					  <div>
						<label for="exampleInputEmail1">[YYYY-MM-DD]</label>
						</div>
						<label for="exampleInputPassword1">Harvesting Date</label>
						  <p id = "oHarvestDate"> ** </p
					  </div>
					  <!-- high five! -->
					  
					  <div class="checkbox">
						<label>
							<input type="checkbox"/> Active
						</label>
					  </div>
					  <!-- submit and close button--->
						<div class="modal-footer">
						<button type="button" class="btn btn-default"
							data-dismiss="modal">
								Close
						</button>
						<button onCLick = "saveDate()" class="btn btn-primary">
							Save changes
						</button>
						</div>
					  <!-- submit and close button--->
					</form>
					
			</div>
		</div>
	</div>
	</div>
		<script src="ui.js"></script>
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>	
		<script src="gis.js?v=<?php echo time(); ?>"></script>
		
		<!-- new-->
		<script src="http://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
	</body>

	</html>