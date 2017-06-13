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

</html>