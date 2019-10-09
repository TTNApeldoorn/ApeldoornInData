<?php
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
$daysback = 0;
if($_REQUEST['daysback'] != null) {
	if(is_numeric($_REQUEST['daysback'])) {
		$daysback = abs(addslashes($_REQUEST['daysback']));
		$startDay = $daysback*-1 - 1;
	}
}

include('db.php');
if($_REQUEST['id'] == null) {
	echo 'id niet ingegeven';
	exit();
}
$points = null;
$multipleAxis = false;
switch($_REQUEST['id']) {
	case 1:
		$mesurementType = 'Temperatuur';
		break;
	case 2:
		$mesurementType = 'Relative vochtigheid';
		break;
	case 3:
		$mesurementType = 'Luchtdruk';
		break;
	case 4:
		$mesurementType = 'Lichtintensiteit';
		break;
	case 5:
		$mesurementType = 'Batterij';
		break;
	case 6:
		$mesurementType = 'Radio actieve straling';
		break;
	case 7:
		$mesurementType = 'Fijnstof';
		break;
	case 8:
		$mesurementType = 'PM2.5';
		break;
	case 9:
		$mesurementType = 'PM10';
		break;
	case 10:
		$mesurementType = 'PM2.5 & PM10';
		break;
	case 11:
		$mesurementType = 'PM2.5 2018';
		break;
	case 12:
		$mesurementType = 'PM10 2018';
		break;
	default:
		echo 'Onbekend type.';
		exit;
		break;
}
$sql =	'SELECT node.Name as \'NodeName\', point.Name AS \'PointName\' FROM point, node WHERE node.id = point.Nodeid AND point.Name LIKE \'%'.$mesurementType.'%\' AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY)';
if($_REQUEST['id'] == 10) {
	$sql =	'SELECT node.Name as \'NodeName\', point.Name AS \'PointName\' FROM point, node WHERE (point.Name LIKE \'%PM10%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY)) OR (point.Name LIKE \'%PM2.5%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY))';
	//echo $sql;
}
if($_REQUEST['id'] == 11) {
	$sql =	'SELECT node.Name as \'NodeName\', point.Name AS \'PointName\' FROM point, node WHERE (point.Name LIKE \'%PM2.5%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY) AND node.Name LIKE \'% 2018 %\')';
	//echo $sql;
}
if($_REQUEST['id'] == 12) {
	$sql =	'SELECT node.Name as \'NodeName\', point.Name AS \'PointName\' FROM point, node WHERE (point.Name LIKE \'%PM10%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY) AND node.Name LIKE \'% 2018 %\')';
	//echo $sql;
}

//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	$points[] = $row['NodeName'].' - '.$row['PointName'];
}
?>
<!DOCTYPE html>
<html class="no-js">
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
	
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      var jsonData = $.ajax({
          url: "chartdata.php?id=<?php echo addslashes($_REQUEST['id']) ?>&type=combined&daysback=<?php echo $daysback; ?>",
          dataType: "json",
          async: false
          }).responseText;
          
		options = {
			chartArea : { left: 80, right: 50, top:10, bottom: 50},
			legend: {position: 'none'},
			vAxis: {format:'#.#' <?php if($_REQUEST['id'] == 6) {
				echo ',
				viewWindow: {
				  max:250,
				  min:0
				}';
			}
			if($_REQUEST['id'] == 8) {
				echo ',
					viewWindow: {
					  max:200,
					  min:0
					}';
			}
			if($_REQUEST['id'] == 9) {
				echo ',
					viewWindow: {
					  max:200,
					  min:0
					}';
			}
			if($_REQUEST['id'] == 10) {
				echo ',
					viewWindow: {
					  max:200,
					  min:0
					}';
			}
			if($_REQUEST['id'] == 11) {
				echo ',
					viewWindow: {
					  max:1500,
					  min:0
					}';
			}
			if($_REQUEST['id'] == 12) {
				echo ',
					viewWindow: {
					  max:1500,
					  min:0
					}';
			}
				?>
			},
			hAxis: {
				format: 'HH:mm:ss',
			},
			height: 600
        };
		
		data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Time');
		<?php 
		foreach($points	as $point) {
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
    </script>
	<meta http-equiv="refresh" content="60">
	<?php
	include('headinclude.php');
	echo "\n";
	?>
	<link rel="stylesheet" href="https://apeldoornindata.nl/style/detailpages.css" >
  </head>
  <body>
	<?php
	include('menu.php');
	echo '<div class="container-fluid">'."\n";
	echo '<h1>'.$mesurementType.'</h1>'."\n";
	?>

    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="width: 90%; height: 90%;"></div>
	<?php
	echo '<br/><a href="'.$GLOBALS['urldata'].'chartcombined.php?id='.$_REQUEST['id'].'&daysback='.abs($daysback+1).'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></button></a><a href="'.$GLOBALS['urldata'].'chartcombined.php?id='.$_REQUEST['id'].'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-stop"></button></a>';
	if($daysback > 0) {
		echo '<a href="'.$GLOBALS['urldata'].'chartcombined.php?id='.$_REQUEST['id'].'&daysback='.abs($daysback-1).'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></button></a><br/><br/>'."\n";
	} else {
		echo '<button type="button" class="btn btn-default" disabled="true"><span class="glyphicon glyphicon-chevron-right"></button><br/><br/>'."\n";
	}
	
	include('../footer.php');
	echo '</div> <!-- /.container -->'."\n"; //container
	include('jsendinclude.php');
	?>
    <script type="text/javascript">	
	//create trigger to resizeEnd event     
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
  </body>
</html>