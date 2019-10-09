<?php
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
		<?php
		include('headinclude.php');
		?>
		<meta http-equiv="refresh" content="60">
		<link rel="stylesheet" href="https://apeldoornindata.nl/style/detailpages.css" >
		

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css" integrity="sha512-wcw6ts8Anuw10Mzh9Ytw4pylW8+NAD4ch3lqm9lzAsTxg0GFeJgoAtxuCLREZSC5lUXdVyo/7yfsqFjQ4S+aKw==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js" integrity="sha512-mNqn2Wg7tSToJhvHcqfzLMU6J4mkOImSPTxVZAdo+lcPlk+GhZmYgACEe0x35K7YzW1zJ7XyJV/TT1MrdXvMcA==" crossorigin=""></script>
	</head>
	<body style="padding:0px">
		<?php
		include('db.php');		
		echo '<div class="container-fluid">'."\n";
		echo '<div class="row">'."\n";
		echo '<div class="col-sm-12">'."\n";
		echo '<h1>GPS tracker '.addslashes($_REQUEST['id']).'</h1>'."\n";
		$sql =	'SELECT *, UNIX_TIMESTAMP(Moment) as unixtime FROM gpslocation'.addslashes($_REQUEST['id']).' ORDER BY Moment DESC Limit 3';
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
		$i = 1;
		if(isset($locations)) {
			foreach($locations as $location) {
				if($i == 1) {
					$lat = $location['Lat'];
					$lon = $location['Lon'];
				}
				echo '<tr>';
				if($location['unixtime'] > (time() - 60)) {
					echo '<td>'.$location['Moment'].'</td>';
				} else {
					echo '<td bgcolor="red">'.$location['Moment'].'</td>';
				}
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
				$gateways =  json_decode($location['Gateway']);
				foreach ($gateways as $gateway) {
					echo $gateway->gtw_id.' - '.$gateway->channel.' - '.$gateway->rssi.' - '.$gateway->snr ;
					echo '<br/>';
				}
				//echo $location['Gateway'];
				echo '</td>';
				echo '</tr>'."\n";
				$i++;
			}
		} else {
			echo '<tr><td>Geen data</td></tr>'."\n";
		}
		echo '</table>'."\n";
		echo '<div class="col-sm-7"><img src="https://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$lon.'&zoom=15&size=400x400&markers=color:red%7Clabel:Locatie%7C'.$lat.','.$lon.'&key=AIzaSyAqE4KW1Puo3CMEG8s6nueFFQT1HbpcGaM"/></div>'."\n";
		include('../footer.php');
		echo '</div> <!-- /.container -->'."\n"; //container
		include('jsendinclude.php');
		?>
		
<script type="text/javascript" src="https://www.ikbennuhier.nl/js/default.js"></script>

	</body>
</html>