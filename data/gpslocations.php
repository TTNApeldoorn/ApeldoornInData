<?php
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
$limit = 1000;
if(isset($_REQUEST['limit'])) {
	if(is_numeric($_REQUEST['limit'])) {
		if($_REQUEST['limit'] < 50000) {
			$limit = addslashes($_REQUEST['limit']);
		}
	}
}
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
		<?php
		include('headinclude.php');
		?>
		<link rel="stylesheet" href="https://apeldoornindata.nl/style/detailpages.css" >
		

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css" integrity="sha512-wcw6ts8Anuw10Mzh9Ytw4pylW8+NAD4ch3lqm9lzAsTxg0GFeJgoAtxuCLREZSC5lUXdVyo/7yfsqFjQ4S+aKw==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js" integrity="sha512-mNqn2Wg7tSToJhvHcqfzLMU6J4mkOImSPTxVZAdo+lcPlk+GhZmYgACEe0x35K7YzW1zJ7XyJV/TT1MrdXvMcA==" crossorigin=""></script>
	</head>
	<body>
		<?php
		include('db.php');
		include('menu.php');
		
		
		echo '<div class="container-fluid">'."\n";
		echo '<h1>Locations GPS tracker '.addslashes($_REQUEST['id']).'</h1>'."\n";
		echo '<div class="row">'."\n";
		echo '<div class="col-sm-5">'."\n";
		$sql =	'SELECT * FROM gpslocation'.addslashes($_REQUEST['id']).' ORDER BY Moment DESC Limit '.$limit;
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			$locations[] = $row;
			//var_dump($row);
		}
		//var_dump($locations);
		echo '<table border="1" style="text-align: right;">'."\n";
		echo '<tr><th>Moment</th>';
		echo '<th>Latitude</th>';
		echo '<th>Logitude</th>';
		echo '<th>Hdop</th>';
		echo '<th>Speed</th>';
		echo '<th>Alt</th>';
		echo '<th>Direction</th>';
		echo '<th>Connection</th>';
		echo '</tr>'."\n";
		if(isset($locations)) {
			foreach($locations as $location) {
				echo '<tr>';
				echo '<td>'.$location['Moment'].'</td>';
				echo '<td><a href="https://www.google.nl/maps/place/'.$location['Lat'].'+'.$location['Lon'].'" target="_blanc">'.$location['Lat'].'</a></td>';
				echo '<td><a href="https://www.google.nl/maps/place/'.$location['Lat'].'+'.$location['Lon'].'" target="_blanc">'.$location['Lon'].'</a></td>';
				echo '<td>';
				printf("%.2f", $location['Hdop']);
				echo '</td>';
				echo '<td>';
				printf("%.1f", $location['Speed']);
				echo '</td>';
				echo '<td>';
				printf("%.1f", $location['Alt']);
				echo '</td>';
				echo '<td>';
				printf("%.1f", str_replace('-', '', $location['Direction']));
				echo '</td>';
				echo '<td>';
				$sql1 =	'SELECT * FROM gpsgateway LEFT JOIN gateway ON gpsgateway.Gwid = gateway.Gateway WHERE gpsgateway.Gpslocationid = '.$location['Id'];
				//echo $sql1;
				$result1 = mysqlquery($sql1);
				while ($row1 = mysqli_fetch_array($result1))
				{
					echo 'GW: '.$row1['Gwid'].' ('.$row1['Name'].') - SNR: ';
					printf("%.1f", str_replace('-', '', $row1['Snr']));
					echo ' - RSSI: '.$row1['Rssi']."\n";
				}
				echo '</td>';
				echo '</tr>'."\n";
			}
		} else {
			echo '<tr><td>Geen data</td></tr>'."\n";
		}
		echo '</table>'."\n";
		echo '</div>'."\n";
		echo '<div class="col-sm-7"><div id="mapid" style="width: 1200px; height: 800px;"></div>'."\n";
		echo '</div>'."\n";
		echo '</div>'."\n";
		$locations = array_reverse($locations);
		?>
		<script>

		var mymap = L.map('mapid').setView([<?php
		if(isset($locations)) {
			echo array_reverse($locations)[0]['Lat'].', '.array_reverse($locations)[0]['Lon'];
		}
		?>
		], 13);

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(mymap);
		<?php
		if(isset($locations)) {
			foreach($locations as $location) {
				echo 'L.marker(['.$location['Lat'].', '.$location['Lon'].']).addTo(mymap).bindPopup("<b>'.$location['Moment'].'</b><br />Snelheid: ';
				printf("%.1f", $location['Speed']);
				echo ' km/h<br/>Richting: ';
				printf("%.1f", $location['Direction']);
				echo '&deg;<br/>Hdop: ';
				printf("%.2f", $location['Hdop']);
				echo '<br/>Hoogte: ';
				printf("%.1f", $location['Alt']);
				echo ' m").openPopup();'."\n";
			}
		}
		?>
		</script>		
		<?php
		include('../footer.php');
		echo '</div> <!-- /.container -->'."\n"; //container
		include('jsendinclude.php');
		?>
		
<script type="text/javascript" src="https://www.ikbennuhier.nl/js/default.js"></script>

	</body>
</html>