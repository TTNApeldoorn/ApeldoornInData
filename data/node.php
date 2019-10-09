<?php
include('db.php');
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
$limit = '';
if(isset($_REQUEST['limit'])) {
	$limit = $_REQUEST['limit'];
}
$daysback = 0;
if(isset($_REQUEST['daysback'])) {
	if(is_numeric($_REQUEST['daysback'])) {
		$daysback = abs(addslashes($_REQUEST['daysback']));
		$startDay = $daysback*-1 - 1;
	}
}
if(!isset($_REQUEST['admin'])) {
	if(in_array($_REQUEST['id'], $GLOBALS['nodefilter'])) {
		die('oops, deze pagina is niet beschikbaar');
	}
}
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta http-equiv="refresh" content="60">
		<?php
		include('headinclude.php');
		?>
		<link rel="stylesheet" href="https://apeldoornindata.nl/style/detailpages.css" >
	</head>
	<body>
		<?php
		include('menu.php');
		echo '<div class="container-fluid">'."\n";
		$sql =	'SELECT * FROM node WHERE id = '.addslashes($_REQUEST['id']);
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			//var_dump($row);
			$arrPoints = null;
			$sql1 =	'SELECT point.id AS \'Id\', point.name AS \'Name\', unit.Unit AS \'Unit\' FROM point, unit WHERE point.Nodeid = '.addslashes($row['Id']).' AND point.Unitid = unit.Id';
			//echo $sql.'<br/>';
			$result1 = mysqlquery($sql1);
			while ($row1 = mysqli_fetch_array($result1))
			{
				$arrPoints[] = array('id' => $row1['Id'], 'name' => $row1['Name'], 'unit' => $row1['Unit']);				
			}
			if($arrPoints != null) {
				$sql2 = '';
				foreach($arrPoints as $point) {
					if($sql2 != '') {
						$sql2 .= ' UNION ';
					}
					$sql2 .= 'SELECT \''.$point['id'].'\' AS \'Tagid\', Moment, Tagvalue FROM measurement'.$point['id'];
					if($daysback == 0) {
						$sql2 .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL -1 DAY)';
					} else {
						$sql2 .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL '.$startDay.' DAY) AND Moment < DATE_ADD(NOW(), INTERVAL -'.$daysback.' DAY)';
					}
				}
				$sql2 .= ' ORDER BY Moment DESC, Tagid ASC';
				//echo $sql2;
				$lastData = null;
				$i = -1;
				$result2 = mysqlquery($sql2);
				while ($row2 = mysqli_fetch_array($result2))
				{
					//var_dump($row2);
					if($lastData != $row2['Moment']) {
						$i++;
						$lastData = $row2['Moment'];
					}
					$data[$i]['Moment'] = $row2['Moment'];	
					$data[$i][$row2['Tagid']] = $row2['Tagvalue'];	
				}
			} else {
				echo 'Geen data beschikbaar';
			}
			
			//var_dump($data);
			echo '<h1>'.$row['Name'].'</h1>'."\n";
			echo '<iframe src="'.$GLOBALS['urldata'].'chartnode.php?id='.$_REQUEST['id'].'&limit='.$limit.'&daysback='.$daysback.'" frameborder="0" height="300" width="100%" scrolling="no"></iframe>';
			echo '<br/><a href="'.$GLOBALS['urldata'].'node.php?id='.$_REQUEST['id'].'&daysback='.abs($daysback+1);
			if(isset($_GET['admin'])) {
				echo '&admin=1';
			}
			echo '"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></button></a><a href="'.$GLOBALS['urldata'].'node.php?id='.$_REQUEST['id'];
			if(isset($_GET['admin'])) {
				echo '&admin=1';
			}
			echo '"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-stop"></button></a>';
			if($daysback > 0) {
				echo '<a href="'.$GLOBALS['urldata'].'node.php?id='.$_REQUEST['id'].'&daysback='.abs($daysback-1);
				if(isset($_GET['admin'])) {
					echo '&admin=1';
				}
				echo '"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></button></a><br/><br/>'."\n";
			} else {
				echo '<button type="button" class="btn btn-default" disabled="true"><span class="glyphicon glyphicon-chevron-right"></button><br/><br/>'."\n";
			}
			echo '<a href="https://apeldoornindata.nl/data/nodeexport.php?id='.$_REQUEST['id'].'&limit=2000"><img src="https://apeldoornindata.nl/images/csv.png" alt="CSV export"></a><br/><br/>'."\n";
			
			if(in_array($_REQUEST['id'], array(87, 120))) {
				echo 'Deze sensor hangt in vergaderzaak 1B bij Hollander Techniek in Apeldoorn.<br/><br/>';
				echo 'Kijk voor meer informatie over IoT bij Hollander Techniek op <a href="https://www.iotinsights.nl/" target="_blank">iotinsights.nl</a><br/>';
				echo '<h3>Luchtvochtigheid (Rode lijn)</h3>
				Zowel thuis als op kantoor zou de relatieve luchtvochtigheid tussen de 40 en 60 procent moet liggen.<br/>
				Bij een te lage luchtvochtigheid krijgen veel mensen last van geïrriteerde luchtwegen, barstjes in de lippen, droge ogen of soms zelfs huidklachten.<br/>
				Een te hoge luchtvochtigheid kan schimmel veroorzaken.<br/>
				
				<h3>CO2 (Paarse lijn)</h3>
				Herken je een bedompte lucht, benauwde atmosfeer of nare luchtjes? Kijk dan eens naar de CO2 waarde.<br/>
				Een goede kwaliteit binnenlucht bevat minder dan 0,1 volume procent CO2 (1000 ppm)<br/>
				<br/>
				<img src="../images/co2.png" /><br/>
				
				<h3>Temperatuur (Donker blauwe lijn)</h3>
				22 graden levert de beste prestaties op op de werkvloer. Voor vrouwen zou het zelfs om 24,5 graden gaan.<br/>
				De ideale kamertemperatuur voor een gemengd bedrijf zou dus rond de 23 graden liggen.<br/>
				
				<h3>Lichtintensiteit (Oranje lijn)</h3>
				Licht beïnvloedt de stemming, eetlust en alertheid. Daglicht zorgt voor de beste productiviteit.<br/>
				In een vergaderruimte is  minimaal 500 lux wenselijk. Heb je een creatieve sessie? Zet het lucht gerust wat zachter.<br/>
				Schermerlicht zorgt volgens onderzoek voor meer vindingrijkheid!<br/>

				<h3>Beweging (Groene lijn)</h3>
				Is er iemand aanwezig geweest in de ruimte? Dit kun je zien aan de beweging sensor.<br/>
				Is er een periode lang geen beweging geweest, dan is de ruimte ook niet gebruikt.<br/>

				<h3>Batterijspanning (Lichtblauwe lijn)</h3>
				De sensor werk met LoRa technologie. De enige voeding is een batterij. Wel zo handig om de spanning te weten, zodat je de batterij tijdig kunt vervangen.<br/><br/><br/>';
			}
			echo '<table border="1">'."\n";
			echo '<tr><th>Moment</th>';
			//var_dump($arrPoints);
			foreach((array) $arrPoints as $point) {
				//var_dump($point);
				echo '<th>'.$point['name'].' ['.$point['unit'].']</th>';
			}
			echo '</tr>'."\n";
			//var_dump($data);
			if(isset($data)) {
				foreach($data as $dataMoment) {
					echo '<tr>';
					echo '<td>'.$dataMoment['Moment'].'</td>';
					foreach($arrPoints as $point) {
						echo '<td class="alnright">';
						if(array_key_exists($point['id'], $dataMoment)) {
							$waarde = str_replace('0000', '', str_replace('.00000', '', $dataMoment[$point['id']]));
							if(substr($waarde, -3) == '000'){
								$waarde = substr($waarde, 0, -3);
							}
							if($waarde == '') {
								$waarde = 0;
							}
							echo $waarde;
						} else {
							echo '&nbsp;';
						}
						//echo  $dataMoment[$point['id']];
						echo '</td>';
					}				
					echo '</tr>'."\n";
				}
			} else {
				echo '<tr><td>Geen data</td></tr>'."\n";
			}
			echo '</table>'."\n";
		}
		include('../footer.php');
		echo '</div> <!-- /.container -->'."\n"; //container
		include('jsendinclude.php');
		?>

	</body>
</html>