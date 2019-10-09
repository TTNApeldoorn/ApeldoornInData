<?php
include('db.php');
$sql =	'SELECT * FROM ttngateways WHERE Lastseen >= DATE_SUB(NOW(), INTERVAL 7 DAY)';
//echo $sql;

$arrSensorData = array("type" => "FeatureCollection", "features" => array());
$arrMeasurement = array();
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	//var_dump($row1);
	$arrProperties = null;
	$arrProperties["type"] = "gateway";
	$arrProperties["location"] = $row["Gwid"];
	$arrProperties["name"] = $row["Gwid"];
	$arrProperties["timestamp"] = $row["Lastseen"];
	$arrMeasurementItem["properties"][] = $arrProperties;
	
	$arrMeasurementItem["type"] = "Feature";
	$arrMeasurementItem["name"] = $row["Gwid"];
	$arrMeasurementItem["geometry"] = array("type" => "Point", "coordinates" => array(floatval($row["Longitude"]), floatval($row["Latitude"])));
	$arrMeasurement[] = $arrMeasurementItem;
	$arrMeasurementItem = null;
}
$arrSensorData["features"] = $arrMeasurement;
echo json_encode($arrSensorData, JSON_PRETTY_PRINT);
exit();
?>

{
	"type": "FeatureCollection",
	"features": [{
		"type": "Feature",
		"geometry": {
			"type": "Point",
			"coordinates": [5.943877, 52.1843 ]
		}
	}
	]
}