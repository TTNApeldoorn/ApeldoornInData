<?php
include('db.php');
if($_REQUEST['id'] == null) {
	echo 'id niet ingegeven';
	exit();
}
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
$limit = '';
if($_REQUEST['limit'] != null) {
	$limit = $_REQUEST['limit'];
}
$daysback = 0;
if($_REQUEST['daysback'] != null) {
	if(is_numeric($_REQUEST['daysback'])) {
		$daysback = addslashes($_REQUEST['daysback']);
	}
}

$points = null;
$multipleAxis = false;
$sql =	'SELECT * FROM point WHERE Nodeid = '.addslashes($_REQUEST['id']).' ORDER BY Priority';
//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	$points[] = $row['Name'];
	if($row['Name'] == 'Lichtintensiteit' 
	|| $row['Name'] == 'Luchtdruk'  
	|| $row['Name'] == 'CO2' ) {
		$multipleAxis = true;
	}
}
?>
<html style="width: 100%; height: 100%; margin: 0;">
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
	
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      var jsonData = $.ajax({
          url: "chartdata.php?id=<?php echo addslashes($_REQUEST['id']) ?>&type=fullnode&limit=<?php echo addslashes($limit).'&daysback='.$daysback; ?>",
          dataType: "json",
          async: false
          }).responseText;
          
		options = {
			chartArea : { left: 80, right: 50, top:10, bottom: 20},
			legend: {position: 'none'},
			interpolateNulls: true,
			<?php
			if(!$multipleAxis) {
				echo 'vAxis: {format:\'#.#\'},'."\n";
			} else {
				echo 'vAxis: {0: {logScale: false}, 1: {logScale: false, minValue: 0}},'."\n";
				$j=0;
				echo 'series:{';
				foreach($points as $point)
				{
					if($j != 0) {
						echo ', ';
					}
					echo $j.':{targetAxisIndex:';
					if($point == 'Lichtintensiteit' 
					|| $point == 'Luchtdruk' 
					|| $point == 'CO2' )
					{
						echo '1}';
					} else {
						echo '0}';
					}
					$j++;
				}
				echo '},';
			}
			?>	
			hAxis: {
            format: 'HH:mm:ss',
			}
        };
		
		data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Time');
		<?php 
		foreach((array) $points	as $point) {
			echo 'data.addColumn(\'number\', \''.$point.'\');'."\n";			
		}
		?>
		data.insertRows(0, eval(jsonData));
		var date_formatter = new google.visualization.DateFormat({ 
			pattern: "dd/MM/yyyy HH:mm:ss"
		}); 
		date_formatter.format(data, 0);
		chart.draw(data, options);	
    }
	
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 500);
	});

	//redraw graph when window resize is completed  
	$(window).on('resizeEnd', function() {
		drawChart(data);
	});

    </script>
  </head>
  <body style="width: 100%; height: 100%; margin: 0;">
    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="width: 90%; height: 90%;"></div>
  </body>
</html>