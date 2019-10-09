<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://apeldoornindata.nl/js/datetimepicker/moment-with-locales.js"></script>
<script type="text/javascript" src="https://apeldoornindata.nl/js/datetimepicker/bootstrap-datetimepicker.js"></script>
<link href="https://apeldoornindata.nl/js/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet">
		<script type="text/javascript">
		
		var data;
		var chart;
		var options;
		var chartwidth;
		var chartareawith;
		var liveUpdates = true;
		var lastPoint = Math.floor(new Date().getTime() / 1000);
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		
		
		function drawChart() {
		data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Time');
		data.addColumn('number', 'Temperatuur 1');		chartwidth = $('#chart_div').width();
		var leftmargin = 60;
		chartareawith = chartwidth - leftmargin;

        options = {
			chartArea : { left: leftmargin, top:10, bottom: 50, width: chartareawith, heigth: '100%'},
			vAxis: {format:'#.# C'},			
			legend: {position: 'none'},
			hAxis: {
            format: 'dd/MM/yyy HH:mm',
			}
        };
		chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		refreshGraph();
		
		function resizeChart () {
			var container = document.getElementById("chart_div").firstChild.firstChild;
			container.style.width = "100%";
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
		if (document.addEventListener) {
			window.addEventListener('resize', resizeChart);
		}
		else if (document.attachEvent) {
			window.attachEvent('onresize', resizeChart);
		}
		else {
			window.resize = resizeChart;
		}
      }
	  function removeOldest() {
		data.removeRow(data.getNumberOfRows()-1);
      }
	  function addNewDataPoint(newValue) {
	    removeOldest();
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth(); //January is 0!
		var yyyy = today.getFullYear();
		data.insertRows(0, [[new Date(yyyy, mm, dd, today.getHours(), today.getMinutes(), today.getSeconds()), newValue]]);
		chart.draw(data, options);
      }
	  function init() {
		var graphPeriode = $("#graphperiode option:selected").val();
		var jsonRows = $.ajax({
			url: "https://apeldoornindata.nl/data.php/" + graphPeriode + "/" + lastPoint + "/" + chartareawith,
			dataType: "json",
			async: false
			}).responseText;
          
		// Create our data table out of JSON data loaded from server.
			//url: "https://www.cloudscada.nl/nl/graphdata/tag/28/" + graphPeriode + "/" + lastPoint + "/" + chartareawith,
		data.removeRows(0, data.getNumberOfRows());
		data.insertRows(0, eval(jsonRows));
		chart.draw(data, options);
      }
	function refreshGraph() {
		var graphPeriode = $("#graphperiode option:selected").val();
		var jsonRows = $.ajax({
			  url: "https://apeldoornindata.nl/data.php/" + graphPeriode + "/" + lastPoint + "/" + chartareawith,
			  dataType: "json",
			  async: false
			  }).responseText;
          
		  // Create our data table out of JSON data loaded from server.
		//url: "https://www.cloudscada.nl/nl/graphdata/tag/28/" + graphPeriode + "/" + lastPoint + "/" + chartareawith,
		data.removeRows(0, data.getNumberOfRows());
		data.insertRows(0, eval(jsonRows));
		chart.draw(data, options);
		initDateTimePicker();
	}
	function previous() {
		var graphPeriode = $("#graphperiode option:selected").val();
		lastPoint = lastPoint - (graphPeriode * 60);
		liveUpdates = false;
		refreshGraph();
	}
	function next() {
		var graphPeriode = $("#graphperiode option:selected").val();
		lastPoint = lastPoint + (graphPeriode * 60);
		
		if(lastPoint >= Math.floor(new Date().getTime() / 1000))
		{
			lastPoint = Math.floor(new Date().getTime() / 1000);
			liveUpdates = true;
		}
		else
		{
			liveUpdates = false;
		}
		
		refreshGraph();		
	}
	
	function updateLastPointAndRefreshGraph(lastPointPar) {
		lastPoint = lastPointPar;
		refreshGraph();		
	}
	</script>


</head>
<body>
<div class="container">
<div class="row">
  <div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Grafiek - Temperatuur 1</div>
			<div class="panel-body">
				<div id="chart_div" style="width: 100%; height: 500px;"></div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dropdown">
							  <select class="form-control" name="graphperiode" id="graphperiode" onchange="refreshGraph()">
								  <option value="1">1 min</option>
								  <option value="5">5 min</option>
								  <option value="10">10 min</option>
								  <option value="30">30 min</option>
								  <option value="60">1 uur</option>
								  <option value="360">6 uur</option>
								  <option value="720" selected="selected">12 uur</option>
								  <option value="1440">1 dag</option>
								  <option value="2880">2 dagen</option>
								  <option value="10080">7 dagen</option>
							</select>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<div class="input-group date" id="datetimepicker1">
								<input type="text" class="form-control"  id="datetimepickerinp"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$("#datetimepicker1").datetimepicker({format: "DD-MM-YYYY HH:mm:ss", allowInputToggle: true, showTodayButton: true, showClose: true, maxDate: new Date(lastPoint * 1000), defaultDate: new Date((lastPoint - ($("#graphperiode option:selected").val() * 60)) * 1000)}).on('dp.change', function(e){
									updateLastPoint(e.date.unix());
								
								  });
							});
							function initDateTimePicker() {
								$("#datetimepickerinp").val(moment(new Date((lastPoint - ($("#graphperiode option:selected").val() * 60)) * 1000)).format('DD-MM-YYYY HH:mm:ss'));
						
							}
							function updateLastPoint(firstPoint) {
								//alert("Lastoint: " + firstPoint + " + " + ($("#graphperiode option:selected").val() * 60));
								var aap = firstPoint + ($("#graphperiode option:selected").val() * 60);
								if(aap >= Math.floor(new Date().getTime() / 1000))
								{
									aap = Math.floor(new Date().getTime() / 1000);
									liveUpdates = true;
								}
								else
								{
									liveUpdates = false;
								}
		
								updateLastPointAndRefreshGraph(aap);
							}
						</script>
					</div>
					<div class="col-sm-2 text-center">
						<button type="button" class="btn btn-primary glyphicon glyphicon-backward" onclick="previous()"></button>
						<button type="button" class="btn btn-primary glyphicon glyphicon-forward" onclick="next()"></button> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>
</body>
</html>