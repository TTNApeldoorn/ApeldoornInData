<?php
include('db.php');
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
if($_REQUEST['type'] == null) {
	echo 'type niet ingegeven';
	exit();
}
if($_REQUEST['id'] == null) {
	echo 'id niet ingegeven';
	exit();
}
$limit = '';
if(isset($_REQUEST['limit'])) {
	if($_REQUEST['limit'] != null) {
		$limit = $_REQUEST['limit'];
	}
}
$daysback = 0;
if(isset($_REQUEST['daysback'])) {
	if($_REQUEST['daysback'] != null) {
		if(is_numeric($_REQUEST['daysback'])) {
			$daysback = addslashes($_REQUEST['daysback']);
			$startDay = $daysback*-1 - 1;
		}
	}
}

switch($_REQUEST['type']) {
	case 'firstpriority':
		echo '[';
		$i = 0;
		$tagid = 1;
		$sql =	'SELECT * FROM point WHERE Nodeid = '.addslashes($_REQUEST['id']).' ORDER BY Priority LIMIT 1';
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			$tagid = $row['Id'];
		}

		$sql =	'SELECT * FROM measurement'.$tagid.' WHERE Moment >= DATE_ADD(NOW(), INTERVAL -1 DAY) ORDER BY Moment';
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			if($i != 0) {
				echo ', ';
			}
			echo '[new Date('.substr($row['Moment'], 0, 4).','.(substr($row['Moment'], 5, 2)-1).','.substr($row['Moment'], 8, 2).','.substr($row['Moment'], 11, 2).','.substr($row['Moment'], 14, 2).','.substr($row['Moment'], 17, 2).'), '.$row['Tagvalue'].']';
			$i++;
		}
		echo ']';
		break;
	case 'fullnode':
		echo '[';
		$i = 0;
		$tagid = 1;
		$sql =	'SELECT * FROM point WHERE Nodeid = '.addslashes($_REQUEST['id']).' ORDER BY Priority';
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			$points[] = array('id' => $row['Id'], 'name' => $row['Name'], 'priority' => $row['Priority']);
		}
		
		$data = null;
		foreach($points as $point) {
			$sql =	'SELECT *, unix_timestamp(Moment) as Timestamp FROM measurement'.$point['id'];
			if($daysback == 0) {
				$sql .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL -1 DAY)';
			} else {
				$sql .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL '.$startDay.' DAY) AND Moment < DATE_ADD(NOW(), INTERVAL -'.$daysback.' DAY)';
			}
			$sql .= ' ORDER BY Moment DESC';
			if($limit != '') {
				$sql = $sql.' LIMIT '.$limit;
			}
			//echo $sql;
			$result = mysqlquery($sql);
			while ($row = mysqli_fetch_array($result))
			{
				$data[$row['Timestamp']]['Moment'] = $row['Moment'];
				$data[$row['Timestamp']]['Timestamp'] = $row['Timestamp'];
				$data[$row['Timestamp']][$point['id']] = $row['Tagvalue'];
			}
		}
		if($data != null) {
			/*echo '<pre>';
			var_dump($data);
			exit();*/
			usort($data, function($a, $b) {
				return $a['Timestamp'] <=> $b['Timestamp'];
			});

			foreach($data as $row) {
				if($i != 0) {
					echo ', ';
				}
				echo '[new Date('.substr($row['Moment'], 0, 4).','.(substr($row['Moment'], 5, 2)-1).','.substr($row['Moment'], 8, 2).','.substr($row['Moment'], 11, 2).','.substr($row['Moment'], 14, 2).','.substr($row['Moment'], 17, 2).')';
				
				foreach($points as $point) {
					echo ', ';
					if (array_key_exists($point['id'], $row)) {
						if($row[$point['id']] != '') {
							echo $row[$point['id']];
						} else {
							echo ' null';	
						}
					} else {
						echo ' null';	
					}
				}
				echo ']';
				$i++;			
			}
		}
		
		echo ']';
		break;
	case 'combined':
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
				break;
			case 11:
				break;
			case 12:
				break;
			default:
				echo 'Onbekend type.';
				exit;
				break;
		}
		echo '[';
		$i = 0;
		$tagid = 1;
		$sql =	'SELECT point.Id, point.Name, point.Priority FROM point, node WHERE node.id = point.Nodeid AND point.Name LIKE \'%'.$mesurementType.'%\' AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY)';
		if($_REQUEST['id'] == 10) {
			$sql =	'SELECT point.Id, point.Name, point.Priority FROM point, node WHERE (point.Name LIKE \'%PM10%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY)) OR (point.Name LIKE \'%PM2.5%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY))';
			//echo $sql;
		}
		if($_REQUEST['id'] == 11) {
			$sql =	'SELECT point.Id, point.Name, point.Priority FROM point, node WHERE (point.Name LIKE \'%PM2.5%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY) AND node.Name LIKE \'% 2018 %\')';
			//echo $sql;
		}
		if($_REQUEST['id'] == 12) {
			$sql =	'SELECT point.Id, point.Name, point.Priority FROM point, node WHERE (point.Name LIKE \'%PM10%\' AND node.id = point.Nodeid AND Lastmessage >= DATE_ADD(NOW(), INTERVAL -1 DAY) AND node.Name LIKE \'% 2018 %\')';
			//echo $sql;
		}
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			$points[] = array('id' => $row['Id'], 'name' => $row['Name'], 'priority' => $row['Priority']);
		}
		$data = null;
		foreach($points as $point) {
			$sql =	'SELECT *, unix_timestamp(Moment) as Timestamp FROM measurement'.$point['id'];
			if($daysback == 0) {
				$sql .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL -1 DAY)';
			} else {
				$sql .= ' WHERE Moment >= DATE_ADD(NOW(), INTERVAL '.$startDay.' DAY) AND Moment < DATE_ADD(NOW(), INTERVAL -'.$daysback.' DAY)';
			}
			$sql .= '  ORDER BY Moment';
			//echo $sql;
			$result = mysqlquery($sql);
			while ($row = mysqli_fetch_array($result))
			{
				$data[$row['Timestamp']]['Moment'] = $row['Moment'];
				$data[$row['Timestamp']][$point['id']] = $row['Tagvalue'];
			}
		}
		
		foreach($data as $row) {
			if($i != 0) {
				echo ', ';
			}
			echo '[new Date('.substr($row['Moment'], 0, 4).','.(substr($row['Moment'], 5, 2)-1).','.substr($row['Moment'], 8, 2).','.substr($row['Moment'], 11, 2).','.substr($row['Moment'], 14, 2).','.substr($row['Moment'], 17, 2).')';
			
			foreach($points as $point) {
				echo ', ';
				if(array_key_exists($point['id'], $row)){
					if($row[$point['id']] != '') {
						echo $row[$point['id']];
					} else {
						echo ' null';	
					}
				} else {
					echo ' null';	
				}
			}
			echo ']';
			$i++;			
		}
		
		echo ']';
		break;
	case 'messages':
		echo '[';
		$i = 0;
		$tagid = 1;
		
		$data = null;
		$sql =	'SELECT YEAR(Moment) AS \'Year\', MONTH(Moment) AS \'Month\', DAY(Moment) AS \'Day\', HOUR(Moment) AS \'Hour\', Count(*) AS \'Aantal\' FROM apeldoornindata.loraraw WHERE Moment >= DATE_ADD(NOW(), INTERVAL -24 HOUR) GROUP BY DAY(Moment), HOUR(Moment)';
		//echo $sql;
		$result = mysqlquery($sql);
		while ($row = mysqli_fetch_array($result))
		{
			if($i != 0) {
				echo ', ';
			}
			echo '[new Date('.$row['Year'].','.($row['Month']-1).','.$row['Day'].','.$row['Hour'].',0,0), '.$row['Aantal'];
			echo ']';
			$i++;
		}
		
		echo ']';
		break;
	default:
		echo 'Onbekend type.';
		break;
}

?>