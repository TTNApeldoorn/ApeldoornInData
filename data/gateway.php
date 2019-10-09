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
	</head>
	<body>
		<?php
		include('menu.php');
		echo '<div class="container-fluid">'."\n";
		$totalPackages = 0;
		$sql =	'SELECT * FROM gateway WHERE Lastmessage >= DATE_SUB(NOW(),INTERVAL 14 DAY) ORDER BY Packets DESC LIMIT 1000';
		//echo $sql;
		$result = mysqlquery($sql);
		echo '<table border="1">';
		echo '<tr><th>Gateway</th><th>Name</th><th>Last</th><th>Packets</th><th>Ch0</th><th>Ch1</th><th>Ch2</th><th>Ch3</th><th>Ch4</th><th>Ch5</th><th>Ch6</th><th>Ch7</th><th>Sf7</th><th>Sf8</th><th>Sf9</th><th>Sf10</th><th>Sf11</th><th>Sf12</th></tr>';
		while ($row = mysqli_fetch_array($result))
		{
			echo '<tr>';
			echo '<td>'.$row['Gateway'].'</td>';
			echo '<td>'.$row['Name'].'</td>';
			
			$utc_date = DateTime::createFromFormat(
                'Y-m-d H:i:s', 
                $row['Lastmessage'], 
                new DateTimeZone('UTC')
			);
			$localTime = $utc_date;
			$localTime->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
			echo '<td>'.$localTime->format('Y-m-d H:i:s').'</td>';
			echo '<td class="alnright">'.number_format($row['Packets'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch0'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch1'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch2'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch3'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch4'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch5'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch6'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Ch7'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf7'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf8'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf9'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf10'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf11'], 0, '', '.').'</td>';
			echo '<td class="alnright">'.number_format($row['Sf12'], 0, '', '.').'</td>';
			echo '</tr>'."\n";
			$totalPackages += $row['Packets'];
		}
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td class="alnright"><strong>Totaal:</strong></td>';
		echo '<td class="alnright"><strong>'.number_format($totalPackages, 0, '', '.').'</strong></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
		echo '</tr>'."\n";
		echo '</table>';
		include('../footer.php');
		echo '</div> <!-- /.container -->'."\n"; //container
		include('jsendinclude.php');
		?>

	</body>
</html>