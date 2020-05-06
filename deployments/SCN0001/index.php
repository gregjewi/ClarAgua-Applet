<!DOCTYPE html>
<html>
<head>
	<title>ClarAgua SCN0001</title>
	<meta author="Gregory Ewing">
	<meta author="Megan Lindmark">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../web_app.css">
	<link rel="stylesheet" type="text/css" href="../../style.css">

	<!--Load the Google Charts AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript">
		function siteData(days=1){
			/*
			query DB about the aggregate results
			*/

			var query_str = '../../app/query.php?sid=' + <?php echo json_encode(basename(__DIR__)); ?> + '&days=' + days;
			var request = new XMLHttpRequest();
			request.onload = function(){
				if (this.readyState == 4 && this.status == 200){
					// aggregate results returned in key value array.
					// Keys are the scenarios the user played.
					oneDayData = JSON.parse(this.responseText);
					fillLastDataContainer(oneDayData[0]);

					// oneDayData = tsFormat(oneDayData);

					makeCharts();
				}
			}
			request.open("GET",query_str,true);
			request.send();
		}

		// Not used at the moment. Could be useful though
		// function tsFormat(dataArray){
		// 	keys = Object.keys(dataArray[0]);

		// 	// instantiate newly format
		// 	formatted = {};
		// 	for (var i = keys.length - 1; i >= 0; i--) {
		// 		formatted[keys[i]] = [];
		// 	}

		// 	// fill new datastructure
		// 	for (var i = dataArray.length - 1; i >= 0; i--) {
		// 		for (var j = keys.length - 1; j >= 0; j--) {
		// 			if (keys[j] == 'time') {
		// 				formatted[keys[j]].push(new Date(dataArray[i][keys[j]]));
		// 			} else {
		// 				formatted[keys[j]].push(dataArray[i][keys[j]]);
		// 			}
					
		// 		}
		// 	}

		// 	return formatted

		// }

		function fillLastDataContainer(array){
			dataStr = '<h2><?php echo basename(__DIR__); ?> Status</h2>';
			dataStr += '<table>'
			dataStr += '<tr>';
			// dataStr += '<td><b>Time: </b></td>';
			// dataStr += '<td class="value">' + new Date(array['time']) + '</td>';

			rows = ['time','flow','orp','ph','tank','tablet','valve']
			for (var i = 0; i < rows.length; i++) {
				dataStr += '<tr>';
				dataStr += '<td><b>' + rows[i] + ': </b></td>';
				dataStr += '<td class="value">' + array[rows[i]] + '</td>';
				dataStr += '</tr>';
			}

			// Assign 
			document.getElementById('dataTableContainer').innerHTML = dataStr;
		}

		function makeCharts(){
			google.charts.load('current', {packages: ['corechart', 'line']});

			// draw Flow Time Series
			google.charts.setOnLoadCallback(drawTsFlow);

			// draw ORP Time Series
			google.charts.setOnLoadCallback(drawORP);

		}

		function drawTsFlow(){
			var data = new google.visualization.DataTable();
			data.addColumn('datetime','Time');
			data.addColumn('number','Flow [cfs]');

			var rows = []
			for (var i = oneDayData.length - 1; i >= 0; i--) {
				rows.push([new Date(oneDayData[i]['time']),oneDayData[i]['flow']]);
			}
			data.addRows(rows)

			var options = {
				title: 'Chlorinator Flow',
				chart: {},
				vAxis:{title:'Flow (gpm)'},
				legend:{position:'none'},
				width:'100%'
			};

			var chart = new google.charts.Line(document.getElementById('flowTs'));
			chart.draw(data,google.charts.Line.convertOptions(options));
		}

		function drawORP(){
			var data = new google.visualization.DataTable();
			data.addColumn('datetime','Time');
			data.addColumn('number','ORP');
			data.addColumn('number','ORP Target');

			var rows = []
			for (var i = oneDayData.length - 1; i >= 0; i--) {
				rows.push([new Date(oneDayData[i]['time']),oneDayData[i]['orp'],oneDayData[i]['orp_target']]);
			}
			data.addRows(rows)

			var options = {
				title: 'ORP and Target',
				chart: {},
				legend:{position:'none'},

				vAxis:{
					title:'ORP mV'
					// viewWindow:{
					// 	max:900,
					// 	min:700,
					// },
					// ticks:[700,750,800,850,900]
				},
				
				width:'100%'
			};

			var chart = new google.charts.Line(document.getElementById('orp'));
			chart.draw(data,google.charts.Line.convertOptions(options));

		}

		function GetSelectedValue(){
			var e = document.getElementById("TimeHistory");
			var result = e.options[e.selectedIndex].value;

			document.getElementById("showingLast").innerHTML = 'Showing last ' + result + ' days of data.';
			siteData(result);
		}

	</script>

</head>

<body onload="siteData()">

	<!-- Top Navigation Menu -->
	<div class="topnav">
	  <a href="../../" class="active">Home</a>
	
	  <a href="." class="icon">
	  	<img src="../../images/noun_Refresh.svg" alt="refresh">
	  </a>
	</div>

	<!-- Inner html assigned via fillLastDataContainer() -->
	<div id="dataTableContainer" class="data"></div>

	<div id="charts" class="data" style="width:98%">
		<h3>Diagnostics</h3>

		<!-- Selector for time history -->
		<div id="TimeHistorySelection">
			Show last:
			<select id="TimeHistory">
				<option value=1>-- Select --</option>
				<option value=1>past 24 hours</option>
				<option value=4>4 days</option>
				<option value=7>1 weeks</option>
				<option value=14>2 weeks</option>
			</select>
			<button type="button" onclick="GetSelectedValue()">Go</button>
		</div>

		<p id="showingLast">Showing Last 24 hours of data</p>
		<!-- Charts filled with google charts -->
		<div id="flowTs"></div>
		<br>
		<div id="orp"></div>
	</div>
	

</body>
</html>
