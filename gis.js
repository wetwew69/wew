//********************************
// MAP FUNCTIONS BELOW
//********************************	

function mapfunc(data) {
	
	console.log('Init map...');	
	ctr = 0;
	aUsername = "";
	//ctr1 = 0;
	
	// instantiate leaflet map
	var mymap = L.map('mapid').setView([12.862338,121.565984], 6);

	var greenIcon = new L.Icon({
	  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
	  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
	  iconSize: [25, 41],
	  iconAnchor: [12, 41],
	  popupAnchor: [1, -34],
	  shadowSize: [41, 41]
	});

	var blueIcon = new L.Icon({
	  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
	  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
	  iconSize: [25, 41],
	  iconAnchor: [12, 41],
	  popupAnchor: [1, -34],
	  shadowSize: [41, 41]
	});
	
	var redIcon = new L.Icon({
	  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
	  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
	  iconSize: [25, 41],
	  iconAnchor: [12, 41],
	  popupAnchor: [1, -34],
	  shadowSize: [41, 41]
	});
	
	// setup map
	L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
		attribution: 'Tiles &copy; Esri',
		maxZoom: 18
		}).addTo(mymap); 

	// supply geojson data to leaflet
	var geoJsonLayer = L.geoJson(data,{
		pointToLayer: addMarker,
		onEachFeature: function (feature, layer){
						refresh(); // reset to not selected on refresh
						switch(feature.geometry.type.toLowerCase()) {									
										case 'point':
											layer.bindPopup('<table class="table"><thead><tr><th colspan="3" class="bg-success" style="text-align:center; width:400px;">'+ 
											feature.properties.name +'</th></tr></thead><tbody><tr><th scope="row">Owner</th><td>'+ 
											feature.properties.owner +'</td><td rowspan="5" style="text-align:center"><div id="graph-container"><canvas id="crops-graph" width="150" height="100%"></canvas></div></td></tr><tr><th scope="row">Lot Area</th><td>'+ 
											feature.properties.lotarea +'</td></tr><th scope="row">Crop</th><td>' + 
											feature.properties.crop + '</td></tr><th scope="row">Date Planted</th><td>' + 
											feature.properties.dateplanted + '</td></tr><th scope="row">Estimated Harvest Date</th><td>' + 
											feature.properties.dateharvest + '</td></tr></tbody></table>'       //<tr><td colspan="3" style="text-align:center"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalNorm"> Edit Information </button>&nbsp;</td></tr>
											)
											.on('dblclick', itemDblClick)
											break;
									}
						layer.on('dblclick', itemDblClick)			
						layer.on('click',function(e){
								if (e.originalEvent.ctrlKey) {
									select(feature.properties.name, "select.php");
									e.target.setIcon(greenIcon);
									//display();
									}
								else{
									//shows display after 2 clicks (FIX THIS)
									e.target.setIcon(blueIcon);
									//select(feature.properties.name, "dateTest.php")
									// switch(feature.geometry.type.toLowerCase()) {									
										// case 'point':
											// console.log(feature.properties.name);
											// layer.bindPopup('<table class="table"><thead><tr><th colspan="3" class="bg-success" style="text-align:center; width:400px;">'+ 
											// feature.properties.name +'</th></tr></thead><tbody><tr><th scope="row">Owner</th><td>'+ 
											// feature.properties.owner +'</td><td rowspan="5" style="text-align:center"><div id="graph-container"><canvas id="crops-graph" width="150" height="100%"></canvas></div></td></tr><tr><th scope="row">Lot Area</th><td>'+ 
											// feature.properties.lotarea +'</td></tr><th scope="row">Crop</th><td>' + 
											// feature.properties.crop + '</td></tr><th scope="row">Date Planted</th><td>' + 
											// feature.properties.dateplanted + '</td></tr><th scope="row">Estimated Harvest Date</th><td>' + 
											// feature.properties.dateharvest + '</td></tr><tr><td colspan="3" style="text-align:center"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalNorm"> Edit Information </button>&nbsp;</td></tr></tbody></table>'
											// )
											// .on('dblclick', itemDblClick)
											// break;
									// }
								}
							}
						)
					}
	//}).addTo(mymap); removed add to map let markercluster add info to map
	});
	
	
	// new shit---------------------------------------------
	var markers = L.markerClusterGroup(); // init markerCluster
	markers.addLayer(geoJsonLayer); // data from geojson
	mymap.addLayer(markers); // add layer
	mymap.fitBounds(markers.getBounds()); // get bounds


	function getRandomLatLng(map) {
		var bounds = map.getBounds(),
			southWest = bounds.getSouthWest(),
			northEast = bounds.getNorthEast(),
			lngSpan = northEast.lng - southWest.lng,
			latSpan = northEast.lat - southWest.lat;

		return new L.LatLng(
				southWest.lat + latSpan * Math.random(),
				southWest.lng + lngSpan * Math.random());
	}
	//---------------------------------------------
	
	
	// function to add marker
	function addMarker(feature, latlng) {
		return L.marker(latlng, {})
	}
	
	//refresh markers
	function clearMarkers(e){
		e.target.setIcon(greenIcon);
		console.log("bee");
	}
	
	//prompt date update and display
	function upDate(iUsername, iDatePlanted){
			$.ajax({
				url: "dateTest.php",
				type: "POST",
				data: {
					'username' : iUsername,
					'harvestDate': iDatePlanted
				}
			});
		  }
		  
	//select markers
	function select(iUsername, iAddress){
			$.ajax({
				url: iAddress,
				type: "POST",
				data: {
					'username' : iUsername
				}
			});
	}
	//call refresh page
	function refresh(){
		$.ajax({
			url: "refresh.php"
		});
	}
	
	// function to zoom when marker gets doubleclicked
	function itemDblClick(e){
		e.target.setIcon(redIcon);
		mymap.setView(e.latlng, 12);
	}
	
	// function to zoom when marker get clicked
	//function itemClick(e){
		//if (e.originalEvent.ctrlKey) {
			//var passName = feature.properties.name;
			//console.log(passName);
			//alert("The CTRL key was pressed!");
			
		// } 
		// else {
        
			// e.target.closePopup();
		// }
		//console.log(e);
		//mymap.setView(e.latlng, 14);
	// }
	
	
	// function itemMouseDown(e){
		// if (e.originalEvent.ctrlKey) {
			// if(feature.properties.name == null)
				// alert('yes');
			// else
				// alert('no');
			//select();
			//console.log(usernameProp);
		// } 
		// else {
        
			//e.target.closePopup();
			
			//alert(select());
		// }
		//console.log(e);
		//mymap.setView(e.latlng, 14);
	// }	

	
	// function to open popup when mouse is hovered over a marker
	// function itemMouseOver(e){
		//e.target.openPopup();
		//select();
	// }

	// function to open popup when mouse is hovered over a polygon
	// function itemMouseOverWithChart(e){
		//e.target.openPopup();
		// loadChart();
	// }
	
	// function to close popup when mouse is outside marker
	// function itemMouseOut(e){
		// e.target.closePopup();
	// }

	//**************** not working yet ***************
	// on hover infobox upper right
	var info = L.control();

	info.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info');
		this.update();
		return this._div;
	};
	info.update = function (props) {
		this._div.innerHTML = '<h4>Crop Information</h4>' +  (props ?
			'<b>' + props.name + '</b><br />' + props.density + ' people / mi<sup>2</sup>'
			: 'Click an area to show more info');
	};
	info.addTo(mymap);		
	//**************** not working yet ***************
	
	// chart demo - function to add chart functionality in polygon popups
	function loadChart() {
		var ctx = null;
		if(ctx!=null) { console.log('Destroying ctx...'); ctx.destroy(); }
		console.log('ctx: ' + ctx);
		console.log('init chart...');
		$('#crop-graph').remove(); // this is my <canvas> element
		$('#graph-container').append('<canvas id="crops-graph" width="100%" height="50"><canvas>');
		canvas = document.querySelector('#crops-graph'); // why use jQuery?
		ctx = canvas.getContext('2d');
		var myChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ["M", "T", "W", "R", "F", "S", "S"],
			datasets: [{
			  label: 'Expected Harvest',
			  data: [12, 19, 3, 17, 28, 24, 7]
			}, {
			  label: 'Harvest',
			  data: [30, 29, 5, 5, 20, 3, 10]
			}]
		  }
		});
		myChart.update();
	}	
	
}

// ------------------------------------

	
// run scripts when html is ready (this is run first)	
$(document).ready( function(){ 
	// fetch our geosjon file
	$.getJSON("http://localhost/redrootcms/geojson.php?v="+Math.random(), function(data) {
		// call mapfunc function and supply geosjon data
		mapfunc(data);
	});
});

