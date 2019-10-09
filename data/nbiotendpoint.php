<?php
include('db.php');
logInfo('start nbiotdata');
/*
logInfo("Postcount: ". count($_POST));
logInfo(implode(",", $_POST));
logInfo("Requestcount: ". count($_REQUEST));
logInfo(implode(",", $_REQUEST));
logInfo("Getcount: ". count($_GET));
logInfo(implode(",", $_GET));
$data = file_get_contents('php://input');
logInfo("input: ".$data);
logInfo($HTTP_RAW_POST_DATA);
$data = file_get_contents('php://stdin');
logInfo('stdin: '.$data);
logInfo("Rawpost: ".$HTTP_RAW_POST_DATA);
//var_dump($data);
*/

logInfo("input: ".json_encode(file_get_contents('php://input')));
/*logInfo("stdin: ".json_encode(file_get_contents('php://stdin')));
logInfo("HTTP_RAW_POST_DATA: ".json_encode($HTTP_RAW_POST_DATA));
logInfo("_GET: ".json_encode($_GET));
logInfo("_POST: ".json_encode($_POST));
logInfo("_REQUEST: ".json_encode($_REQUEST));
//logInfo("getallheaders: ".json_encode(getallheaders()));
*/
echo 'Thanks';

$ruweData = file_get_contents('php://input');

if($ruweData != null) {
	$sql =	'INSERT INTO nbiotraw SET Moment=NOW(), Data= \''.addslashes($ruweData).'\', Nodeid=16';
	//logInfo('sql: '.$sql);
	//echo $sql;
	$result = mysqlquery($sql);
	
	$dateNow = date('Y-m-d H:i:s');
	$data = json_decode($ruweData);
	logInfo("Deviceid: ".$data->reports[0]->serialNumber);
	switch($data->reports[0]->serialNumber) {
		case 'IMEI:357518080039852':
			logInfo("Payload: ".$data->reports[0]->value);
			//$decoded = base64_decode($data->reports[0]->value);
			$decoded = $data->reports[0]->value;
			logInfo("Decoded: ".$decoded);
			
			$temperature = substr($decoded, 0, 4);
			$temperature = hexdec($temperature)/100;
			logInfo("Temperature: ".$temperature);
			$sql =	'INSERT INTO measurement38 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($temperature);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$humidity = substr($decoded, 4, 4);
			$humidity = hexdec($humidity)/100;
			logInfo("Humidity: ".$humidity);
			$sql =	'INSERT INTO measurement39 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($humidity);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$pressure = substr($decoded, 8, 4);
			$pressure = hexdec($pressure);
			logInfo("Pressure: ".$pressure);
			$sql =	'INSERT INTO measurement40 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pressure);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$lat = substr($decoded, 12, 8);
			$lat = hexdec($lat)/100000;
			$lon = substr($decoded, 20, 8);
			$lon = hexdec($lon)/100000;
			logInfo("Lat: ".$lat);
			logInfo("Lon: ".$lon);
			$sql =	'INSERT INTO gpslocation16 SET Moment=\''.$dateNow.'\', Lat='.addslashes($lat).', Lon='.addslashes($lon);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$accelX = substr($decoded, 28, 4);
			$accelX = hexdec($accelX)/100 - 100;
			logInfo("AccelX: ".$accelX);
			$sql =	'INSERT INTO measurement41 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($accelX);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$accelY = substr($decoded, 32, 4);
			$accelY = hexdec($accelY)/100 - 100;
			logInfo("AccelY: ".$accelY);
			$sql =	'INSERT INTO measurement42 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($accelY);
			//echo $sql;
			$result = mysqlquery($sql);
			
			$accelZ = substr($decoded, 36, 4);
			$accelZ = hexdec($accelZ)/100 - 100;
			logInfo("AccelZ: ".$accelZ);
			$sql =	'INSERT INTO measurement43 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($accelZ);
			//echo $sql;
			$result = mysqlquery($sql);

			$sql =	'UPDATE node SET Lastmessage=\''.$dateNow.'\', Packets = Packets + 1';
			if($lat != 0 && $lat != 0) {
				$sql .= ', Lastlocationlat = '.addslashes($lat).', Lastlocationlon = '.addslashes($lon);
			}
			$sql .= ' WHERE Id=16';
			//echo $sql;
			$result = mysqlquery($sql);
			break;	
	}
}
?>