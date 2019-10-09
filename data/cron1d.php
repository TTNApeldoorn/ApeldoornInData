<?php
include('db.php');
logerror('start Cron 1 day');
echo 'Starting 1day cron<br/>';
$sqlTruncate = 'TRUNCATE apeldoornindata.ttngateways';
//echo $sqlTruncate.'<br/>';
mysqlquery($sqlTruncate);


$c = curl_init('http://noc.thethingsnetwork.org:8085/api/v2/gateways');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//curl_setopt(... other options you want...)

$html = curl_exec($c);

if (curl_error($c))
die(curl_error($c));

// Get the status code
$status = curl_getinfo($c, CURLINFO_HTTP_CODE);

curl_close($c);

$jsonGateways = json_decode($html);

foreach((array) $jsonGateways->statuses as $key => $jsonGateway) {

	$gatewayId = $key;
	$lastSeen = $jsonGateway->timestamp;
	$lat = null;
	$lon = null;
	if(isset($jsonGateway->location->latitude)) {
		$lat = $jsonGateway->location->latitude;
	}
	if(isset($jsonGateway->location->longitude)) {
		$lon = $jsonGateway->location->longitude;
	}
	//vardump($key);
	//vardump($jsonGateway);
	
	$sqlInsert = 'INSERT INTO apeldoornindata.ttngateways SET Gwid = \''.$gatewayId.'\', Lastseen = \''.$lastSeen.'\'';
	if($lat != null && $lat != null) {
		$sqlInsert .= ', Latitude = \''.$lat.'\', longitude = \''.$lon.'\'';
		//echo $sqlInsert.'<br/>';
		mysqlquery($sqlInsert);
	}
	$sqlInsert='';
}
logerror('End Cron 1 day');

?>