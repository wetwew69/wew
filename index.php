<?php 
$crops = array( 
	'default' => '-- Select a crop --',
	'rice' => 'Rice',
	'corn' => 'Corn',
	'cassava' => 'Cassava',
	'onion' => 'Onion',
	'carrot' => 'Carrot',
	'tomatoe' => 'Tomatoe'
);

$cropSelected = $_GET['crop'];

?>
<!-- -->
<!DOCTYPE html>
<html>
<head>
    <title>RedRoot Crop Monitoring System</title>
    <meta charset="utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--for buttons-->
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.0.5/MarkerCluster.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.0.5/MarkerCluster.Default.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!--for buttons-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier-Leaflet/0.2.6/oms.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<<<<<<< HEAD
	<style>
	
	html, body { 
		overflow: hidden;
		height: 100%;
		width: 100%;
=======

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
		// "<script type=\'text/javascript\'>
				// confirm("REGISTERED SUCCESSFULLY!! ( ͡° ͜ʖ ͡°)");
		// </script>"
				
			// $command = "insert into landareadetails(cropName, plantingDate, harvestDate)
						// values('$cropName', '$plantingDate', '$harvestDate')";
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
>>>>>>> 0e8b0d875dd9449ca53ed3be4859a5d0bdc197b3
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
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
  <form class="navbar-form navbar-left" role="button">
  <div class="btn-group">
    <button type="button" class="btn btn-primary">January</button>
    <button type="button" class="btn btn-primary">February</button>
    <button type="button" class="btn btn-primary">March</button>
	<button type="button" class="btn btn-primary">April</button>
    <button type="button" class="btn btn-primary">May</button>
    <button type="button" class="btn btn-primary">June</button>
	<button type="button" class="btn btn-primary">July</button>
    <button type="button" class="btn btn-primary">August</button>
    <button type="button" class="btn btn-primary">September</button>
	<button type="button" class="btn btn-primary">October</button>
    <button type="button" class="btn btn-primary">November</button>
    <button type="button" class="btn btn-primary">December</button>
	<button class="btn btn-default" type="button"><i class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalNorm">Edit Information</i></button>
	<form class="navbar-form navbar-right" role="search">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search" name="q" id="q">
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
		</form>
  </div>
  </form>
</div>
      </div>
   <!-- </form>
<tr><td colspan="3" style="text-align:center"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalNorm"> Edit Information </button>&nbsp;</td></tr>
	-->	
		
		
		
		
<<<<<<< HEAD
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
                
                <form role="form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Crop Name</label>
                      <input type="tesxt" class="form-control"
                      id="exampleInputEmail1" placeholder="Enter crop name"/>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Planting Date</label>
                      <input type="tesxt" class="form-control"
                      id="exampleInputEmail1" placeholder="Enter Date"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Harvesting Date</label>
                      <input type="text" class="form-control"
                          id="exampleInputPassword1" placeholder="Enter Date"/>
                  </div>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox"/> Active
                    </label>
                  </div>
                </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Table for Information
<table id="t01">
  <tr>
    <th></th>
  </tr>
</table>-->

    <script src="ui.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>	
	<script src="http://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
	<script src="gis.js?v=<?php echo time(); ?>"></script>
	
</body>
=======
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
		  
		  function clearSelection(){
			  $(document).ready(function(){
						$.ajax({url: "refresh.php", success: function(result){
							
							$("#sumDisplay").html(result);
							}});
				});
		  }
		  
		  
		  </script>
		  
		 
		  <button onClick = "display()" id = "sumDisplay"> DISPLAY </button>
		  
		  <button onCLick = "clearSelection()"> Clear </button>
		  
		</div>

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
<!-- Edit Information Button-->
 		<form class="navbar-form navbar-right" role="button">
 					<button class="btn btn-default" type="button"><i class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalNorm">Edit Information</i></button>		      
 		</form>
		<script>
		function ohmy(){
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
			<form class="navbar-form navbar-right" role="search">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="q" id="q">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
			</form>

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
						  id="exampleInputEmail1" placeholder="Enter crop name"
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
						<button onCLick = "ohmy()" class="btn btn-primary">
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
>>>>>>> 0e8b0d875dd9449ca53ed3be4859a5d0bdc197b3

</html>