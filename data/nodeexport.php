<?php
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}

header("Content-type: text/csv");
header('Content-Disposition: attachment; filename='.date("YmdHis").'_'.$_REQUEST['id'].'_aidexport.csv');
header("Pragma: no-cache");
header("Expires: 0");

$limit = 1000;
if(isset($_REQUEST['limit']) && is_numeric($_REQUEST['limit'])) {
	$limit = $_REQUEST['limit'];
	if($limit > 50000){
		$limit = 50000;
	}
}
include('db.php');

if(!isset($_REQUEST['admin'])) {
	if(in_array($_REQUEST['id'], $GLOBALS['nodefilter'])) {
		die('oops, deze pagina is niet beschikbaar');
	}
}

$sql =	'SELECT * FROM node WHERE id = '.addslashes($_REQUEST['id']);
//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	//var_dump($row);
	$arrPoints = null;
	$sql1 =	'SELECT point.id AS \'Id\', point.name AS \'Name\', unit.Unit AS \'Unit\' FROM point, unit WHERE point.Nodeid = '.addslashes($row['Id']).' AND point.Unitid = unit.Id';
	//echo $sql;
	$result1 = mysqlquery($sql1);
	while ($row1 = mysqli_fetch_array($result1))
	{
		$arrPoints[] = array('id' => $row1['Id'], 'name' => $row1['Name'], 'unit' => $row1['Unit']);				
	}
	$limit = $limit * count($arrPoints);
	if($arrPoints != null) {
		$sql2 = '';
		foreach($arrPoints as $point) {
			if($sql2 != '') {
				$sql2 .= ' UNION ';
			}
			$sql2 .= 'SELECT \''.$point['id'].'\' AS \'Tagid\', Moment, Tagvalue FROM measurement'.$point['id'].'';
		}
		$sql2 .= ' ORDER BY Moment DESC, Tagid ASC LIMIT '.addslashes($limit);
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
	echo 'Moment';
	//var_dump($arrPoints);
	foreach($arrPoints as $point) {
		//var_dump($point);
		echo ';'.$point['name'].' ['.$point['unit'].']';
	}
	echo ';'."\n";
	foreach($data as $dataMoment) {
		echo $dataMoment['Moment'];
		foreach($arrPoints as $point) {
			echo ';';
			if(array_key_exists($point['id'], $dataMoment)) {
				echo str_replace('000', '', str_replace('0000', '', str_replace('.00000', '', $dataMoment[$point['id']])));
			} else {
				echo '';
			}
		}				
		echo ';'."\n";
	}
}
?>