<?php
include('db.php');
?>
<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta http-equiv="refresh" content="60">
		<?php
		include('headinclude.php');
		?>
		<link rel="stylesheet" href="https://apeldoornindata.nl/style/detailpages.css" >
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
    
		// Load the Visualization API and the piechart package.
		google.charts.load('current', {'packages':['corechart']});
      
		// Set a callback to run when the Google Visualization API is loaded.
		google.charts.setOnLoadCallback(drawChart);
      
		function drawChart() {
	
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		  var jsonData = $.ajax({
			  url: "chartdata.php?id=1&type=messages",
			  dataType: "json",
			  async: false
			  }).responseText;
          
			options = {
				chartArea : { left: 80, right: 50, top:10, bottom: 50},
				vAxis: {format:'#.#'},			
				legend: {position: 'none'},
				hAxis: {
				format: 'dd/MM/yyyy HH',
				},
				height: 300
			};
		
			data = new google.visualization.DataTable();
			data.addColumn('datetime', 'Time');
			data.addColumn('number', 'Messages');	
			data.insertRows(0, eval(jsonData));
			var date_formatter = new google.visualization.DateFormat({ 
				pattern: "dd/MM/yyyy HH:mm"
			}); 
			date_formatter.format(data, 0);
			chart.draw(data, options);	
		}

		</script>
	</head>
	<body>
		<?php
		include('menu.php');
		echo '<div class="container-fluid">'."\n";
		echo '<div id="chart_div"></div>'."\n";
		$sql =	'SELECT * FROM loraraw ORDER BY Moment DESC LIMIT 500';
		//echo $sql;
		$result = mysqlquery($sql);
		echo '<table border="1">';
		echo '<tr><th>Moment</th><th>Node</th><th>Counter</th><th>Payload</th><th>Metadata</th><th>Gateway</th></tr>';
		while ($row = mysqli_fetch_array($result))
		{
			$nodeId = 0;
			$jsonData = json_decode($row['Data']);
			$sql1 =	'SELECT * FROM node WHERE Devid = \''.addslashes($jsonData->dev_id).'\' AND Hwserial = \''.addslashes($jsonData->hardware_serial).'\' LIMIT 1';
			//echo $sql1;
			$result1 = mysqlquery($sql1);
			while ($row1 = mysqli_fetch_array($result1))
			{
				if($row1['Id'] != null) {
					$nodeId = $row1['Id'];
				} 
			}
			if(!isset($_REQUEST['admin'])) {
				if(in_array($nodeId, $GLOBALS['nodefilter'])) {
					continue;
				}
			}

			$utc_date = DateTime::createFromFormat(
                'Y-m-d H:i:s', 
                $row['Moment'], 
                new DateTimeZone('UTC')
			);
			$localTime = $utc_date;
			$localTime->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
			echo '<tr><td valign="top">'.$localTime->format('Y-m-d H:i:s').'</td><td valign="top">';
			//echo '<pre>';
			//var_dump($jsonData);
			if($nodeId != 0) {
				echo '<a href="https://apeldoornindata.nl/data/node.php?id='.$nodeId.'">';
			}
			
			echo $jsonData->dev_id.'</a></td><td valign="top">';
			echo $jsonData->counter.'</td><td valign="top">';
			if(isset($jsonData->payload_fields)) {
				foreach($jsonData->payload_fields as $key => $value) {
					if(isset($key) && isset($value) && !is_null($key) && !is_null($value)){
						echo $key;
						echo ': ';
						if(!is_object($value)) {
							echo $value.'<br/>';
						} else {
							echo'##<br/>';						
						}
					}
				}
			}
			echo '</td>';
			echo '<td valign="top">';
			echo 'Time utc: '.$jsonData->metadata->time.'<br/>';
			echo 'Datarate: '.$jsonData->metadata->data_rate.'<br/>';
			echo 'Frequency: '.$jsonData->metadata->frequency.'<br/>';
			echo 'Coding Rate: '.$jsonData->metadata->coding_rate.'<br/>';
			echo '</td>';
			echo '<td valign="top">';
			foreach($jsonData->metadata->gateways as $key => $value) {
				if(isset($value->latitude) && isset($value->longitude)) {
					echo '<a href="https://www.google.nl/maps/search/'.$value->latitude.'+'.$value->longitude.'" target="_blanc">';
					echo $value->gtw_id.'</a>'; 
				}
				elseif($value->gtw_id == 'eui-600194ffff078812'){
					echo '<a href="https://www.google.nl/maps/search/52.184116+5.943786" target="_blanc">';
					echo $value->gtw_id.'</a>'; 
				}
				else
				{
					echo $value->gtw_id; 
				}
				if(isset($value->rssi)) {
					echo ' - RSSI: '.$value->rssi;
				}
				if(isset($value->snr)) {
					echo ' - SNR: '.$value->snr;
				}
				echo ' - Channel: '.$value->channel;
				//echo '<br/>'.$value->gtw_id.'<br/>';
				
				
				if($value->gtw_id == 'eui-0031552048001a03') {
					echo ' - Mheen flat';
				} elseif($value->gtw_id == 'eui-aa555a0000088213') {
					echo ' - John F Kennedylaan';
				} elseif($value->gtw_id == 'eui-aa555a0000088234') {
					echo ' - John F Kennedylaan';
				} elseif($value->gtw_id == 'ttn_apeldoorn_jfk2') {
					echo ' - John F Kennedylaan';
				} elseif($value->gtw_id == 'eui-a020a6ffff0bf72b') {
					echo ' - Alex';
				} elseif($value->gtw_id == 'eui-600194ffff0668a4') {
					echo ' - RFSee';
				} elseif($value->gtw_id == 'eui-1dee039210b8bc22') {
					echo ' - Maarten-in';
				} elseif($value->gtw_id == 'eui-1dee0eafc27cb263') {
					echo ' - Oblivion';
				} elseif($value->gtw_id == 'eui-84eb18ffffe1df5a') {
					echo ' - Maarten-in 2';
				} elseif($value->gtw_id == 'eui-0003ffff1d09ce86') {
					echo ' - InterAct';
				} elseif($value->gtw_id == 'eui-af5ee01293673410') {
					echo ' - RFSee 2';
				} elseif($value->gtw_id == 'pe1mew_development_gateway_1') {
					echo ' - RFSee 3';
				} elseif($value->gtw_id == 'pe1mew_development_gateway_2') {
					echo ' - RFSee 4';
				} elseif($value->gtw_id == 'pe1mew_development_gateway_3') {
					echo ' - RFSee 5';
				} elseif($value->gtw_id == 'eui-af5ee06136197950') {
					echo ' - RFSee 6';
				} elseif($value->gtw_id == 'eui-b827ebfffe0ee7c9') {
					echo ' - Eddy';
				} elseif($value->gtw_id == 'eui-0031552048001a06') {
					echo ' - Kadaster';
				} elseif($value->gtw_id == 'eui-0031552048001a06') {
					echo ' - Kadaster';
				} elseif($value->gtw_id == 'ttn_apeldoorn_kadaster') {
					echo ' - Kadaster';
				} elseif($value->gtw_id == 'ttn_apeldoorn_kadaster') {
					echo ' - Kadaster';
				} elseif($value->gtw_id == 'ttn_deventer_grote-kerk') {
					echo ' - Deventer - Grote kerk';
				} elseif($value->gtw_id == 'ttn_apeldoorn_radiokootwijk') {
					echo ' - Radio Kootwijk';
				} elseif($value->gtw_id == 'eui-a020a6ffff1950d9') {
					echo ' - Zutphen - Coehoornsingel';
				} elseif($value->gtw_id == 'eui-0000024b08030035') {
					echo ' - Harderwijk - Oosteinde';
				} elseif($value->gtw_id == 'ttn_apeldoorn_werkgebouw-zuid') {
					echo ' - Werkgebouw Zuid';
				} elseif($value->gtw_id == 'eui-aa555a0000088227') {
					echo ' - Apeldoorn Stadhuis';
				} elseif($value->gtw_id == 'ttn_apeldoorn_stadhuis') {
					echo ' - Apeldoorn Stadhuis';
				} elseif($value->gtw_id == 'eui-aa555a0000088226') {
					echo ' - Politiebureau - Europaweg';
				} elseif($value->gtw_id == 'ttn_apeldoorn_europaweg') {
					echo ' - Politiebureau - Europaweg';
				} elseif($value->gtw_id == 'eui-600194ffff078812') {
					echo ' - Industrial IT';
				} elseif($value->gtw_id == 'industrialit') {
					echo ' - Industrial IT Ugchelen';
				} elseif($value->gtw_id == 'ttn_pe1mew_gateway_1') {
					echo ' - RFSee GW1';
				} elseif($value->gtw_id == 'ttn_pe1mew_gateway_0') {
					echo ' - RFSee GW0';
				} elseif($value->gtw_id == 'eui-b827ebfffe9c2876') {
					echo ' - Apeldoorn Holtrichtersveld';
				} elseif($value->gtw_id == 'ttn-gw-fma01') {
					echo ' - Oosterhout - Hofkersstraat';
				} elseif($value->gtw_id == 'hollander_techniek_apeldoorn') {
					echo ' - Apeldoorn - Hollander Techniek';
				} elseif($value->gtw_id == 'x-connections') {
					echo ' - x-connections - Landmetersveld';
				} elseif($value->gtw_id == 'eui-a020a6ffff195478') {
					echo ' - Apeldoorn - Landmetersveld';
				} elseif($value->gtw_id == 'eui-a84041183eedffff') {
					echo ' - Apeldoorn - Waldeck-Pyrmontstraat';
				} elseif($value->gtw_id == 'jeng_iot') {
					echo ' - Jeng IoT';
				} elseif($value->gtw_id == 'cicon') {
					echo ' - Cicon';
				} elseif($value->gtw_id == 'eui-a020a6ffff1957a9') {
					echo ' - atranco';
				} elseif($value->gtw_id == 'eui-b827ebfffe01891a') {
					echo ' - Amstelveen Westhove';
				} else {
					echo ' - Unknown';
				}
				echo '<br/>';
				$value = null;
			}
			echo '</td>';
			//echo '<td valign="top">'.$row['Data'].'</td>';
			echo '</tr>'."\n";
		}
		echo '</table>';
		include('../footer.php');
		echo '</div> <!-- /.container -->'."\n"; //container
		include('jsendinclude.php');
		?>

	</body>
</html>