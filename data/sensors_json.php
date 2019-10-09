<?php
include('db.php');
if(isset($_REQUEST['id'])) {
	if(!is_numeric($_REQUEST['id'])) {
		die("Invalid Id parameter");
	}
}
$sql =	'SELECT * FROM node';
//echo $sql;

$interval = 'INTERVAL 24 HOUR';	
if(isset($_REQUEST['select'])) {
	if($_REQUEST['select'] == 'all') {
		$interval = 'INTERVAL 14 DAY';	
	}
}

$arrSensorData = array("type" => "FeatureCollection", "features" => array());
$arrMeasurement = array();
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	$nodeHasData = false;
	$arrMeasurementItem = null;
	$arrProperties = array();
	$sql1 =	'SELECT point.*, unit.Unit FROM point INNER JOIN unit ON point.Unitid = unit.Id WHERE Nodeid = '.$row["Id"];
	//echo $sql1;
	$result1 = mysqlquery($sql1);
	while ($row1 = mysqli_fetch_array($result1))
	{
		$sql2 =	'SELECT * FROM measurement'.$row1["Id"].' WHERE Moment >= DATE_SUB(NOW(), '.$interval.') ORDER BY Moment DESC LIMIT 1';
		//echo $sql2;
		$result2 = mysqlquery($sql2);
		while ($row2 = mysqli_fetch_array($result2))
		{
			//var_dump($row1);
			$arrProperties = null;
			$arrProperties["type"] = "sensor";
			$arrProperties["id"] = $row1["Id"];
			$arrProperties["location"] = $row["Name"];
			$arrProperties["name"] = $row1["Name"];
			$arrProperties["value"] = ($row2["Tagvalue"] + 0).' '.$row1["Unit"];
			$arrProperties["timestamp"] = $row2["Moment"];
			$arrProperties["nodeid"] = $row["Id"];
			$arrMeasurementItem["properties"][] = $arrProperties;
			$nodeHasData = true;
		}
	}
	//var_dump($arrProperties);
	$arrMeasurementItem["type"] = "Feature";
	$arrMeasurementItem["name"] = $row["Name"];
	$arrMeasurementItem["geometry"] = array("type" => "Point", "coordinates" => array(floatval($row["Lastlocationlon"]), floatval($row["Lastlocationlat"])));
	//arrSensorData["features"][] = array("type" => "Feature");
	//var_dump($row);
	if($nodeHasData)
	{
		$arrMeasurement[] = $arrMeasurementItem;
	}
}
$arrSensorData["features"] = $arrMeasurement;
echo json_encode($arrSensorData, JSON_PRETTY_PRINT);
exit();
?>

{
	"type": "FeatureCollection",
	"features": [{
		"type": "Feature",
		"properties": {
			"type": "sensor",
			"id": "1",
			"temperature": "24.9375",
			"humidity": "30.3125",
			"timestamp_utc": "2017-06-01 14:30:35",
			"timestamp": "2017-06-01 16:30:35",
			"location": "Industrial IT"
		},
		"geometry": {
			"type": "Point",
			"coordinates": [5.943877, 52.1843 ]
		}
	}
	]
}