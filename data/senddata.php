<?php
include('db.php');
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
if(!isset($_REQUEST['code'])) {
	die("Invalid code parameter");
}
if(!is_numeric($_REQUEST['code'])) {
	die("Invalid code parameter");
}
if(!isset($_REQUEST['location'])) {
	die("Invalid Location parameter");
}
if(!strpos($_REQUEST['location'], ',') !== false) {
	die("location parameter has no ,");
}

if(strlen($_REQUEST['location']) < 3) {
	die("location parameter is to short");
}

function insertIntoInflux($nodeName, $insertData) {
	//logerror('Insert into Influx: '.$nodeName.' '.$insertData);

	$ch = curl_init('http://localhost:8086/write?db=aid');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");      
	curl_setopt($ch, CURLOPT_USERPWD, 'admin:wout2466');                                                               
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nodeName.' '.$insertData);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                     
	$result = curl_exec($ch);
}

$nodeName = '';
$influxData = '';
$sendToLuftDaten = false;
$luftdatenSensorName = '';
$sendToRIVM = false;

logerror('Start SendData: '.$_REQUEST['id'].' - '.json_encode($_REQUEST));
$sql =	'SELECT * FROM node WHERE Id = '.addslashes($_REQUEST['id']).' AND Hwserial = '.addslashes($_REQUEST['code']);
//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	$nodeName = strtolower(str_replace('-', '', preg_replace('/\s+/', '', $row['Name'])));
	//echo $_REQUEST['location'].'<br/>';
	$locationarr = explode(',', $_REQUEST['location']);
	
	$lat = $locationarr[0];
	$lon = $locationarr[1];
	//echo 'Lat: '.$lat.'<br/>';
	//echo 'Lon: '.$lon.'<br/>';
	
	$dateNow = date('Y-m-d H:i:s');
	

	if($row['Id'] == 19) {
		$sql =	'UPDATE node SET Lastmessage=NOW(), Packets = Packets + 1, Lastlocationlat = \'52.18430\', Lastlocationlon = \'5.94394\' WHERE Id='.$row['Id'];
		//echo $sql;
		$result = mysqlquery($sql);
	} elseif($row['Id'] == 75) {
		$sql =	'UPDATE node SET Lastmessage=NOW(), Packets = Packets + 1, Lastlocationlat = \'52.03057\', Lastlocationlon = \'5.57186\' WHERE Id='.$row['Id'];
		//echo $sql;
		$result = mysqlquery($sql);
	} else {
		$sql =	'UPDATE node SET Lastmessage=NOW(), Packets = Packets + 1';
		if($lat != 0 && $lat != 0) {
			$sql .= ', Lastlocationlat = '.addslashes($lat).', Lastlocationlon = '.addslashes($lon);
		}
		$sql .= ' WHERE Id='.$row['Id'];
		//echo $sql;
		$result = mysqlquery($sql);
	}

	if(array_key_exists('pm10', $_REQUEST)) {
		echo 'PM10 '.htmlspecialchars(addslashes($_REQUEST['pm10'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Fijnstof - PM10\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['pm10']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
			$pm10 = $_REQUEST['pm10'];
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'pm10='.floatval($_REQUEST['pm10']);
	}
	
	if(array_key_exists('pm25', $_REQUEST)) {
		echo 'PM2.5 '.htmlspecialchars(addslashes($_REQUEST['pm25'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Fijnstof - PM2.5\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['pm25']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
			$pm25 = $_REQUEST['pm25'];
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'pm25='.floatval($_REQUEST['pm25']);
	}
	
	if(array_key_exists('co2', $_REQUEST)) {
		echo 'CO2 '.htmlspecialchars(addslashes($_REQUEST['co2'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'CO2\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['co2']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'co2='.floatval($_REQUEST['co2']);
	}
	
	if(array_key_exists('temp', $_REQUEST)) {
		echo 'Temperatuur '.htmlspecialchars(addslashes($_REQUEST['temp'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Temperatuur\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['temp']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'temperatuur='.floatval($_REQUEST['temp']);
	}
	
	if(array_key_exists('rh', $_REQUEST)) {
		echo 'Relatieve vochtigheid '.htmlspecialchars(addslashes($_REQUEST['rh'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Relative vochtigheid\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['rh']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'vochtigheid='.floatval($_REQUEST['rh']);
	}
	
	if(array_key_exists('luchtdruk', $_REQUEST)) {
		echo 'Luchtdruk '.htmlspecialchars(addslashes($_REQUEST['luchtdruk'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Luchtdruk\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['luchtdruk']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'luchtdruk='.floatval($_REQUEST['luchtdruk']);
	}
	
	if(array_key_exists('accu', $_REQUEST)) {
		echo 'Accu '.htmlspecialchars(addslashes($_REQUEST['accu'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Batterij\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['accu']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'accu='.floatval($_REQUEST['accu']);
	}
	
	if(array_key_exists('di', $_REQUEST)) {
		echo 'Digitaal in '.htmlspecialchars(addslashes($_REQUEST['di'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Digitaal in\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['di']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'di='.floatval($_REQUEST['di']);
	}
	
	if(array_key_exists('lux', $_REQUEST)) {
		echo 'Lichtintensiteit '.htmlspecialchars(addslashes($_REQUEST['lux'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Lichtintensiteit\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['lux']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'lux='.floatval($_REQUEST['lux']);
	}
	
	if(array_key_exists('radio', $_REQUEST)) {
		echo 'Radioactieve straling '.htmlspecialchars(addslashes($_REQUEST['radio'])).'<br/>';
		$sql1 =	'SELECT * FROM point WHERE Nodeid = '.$row['Id'].' AND Name = \'Radio actieve straling\'';
		//echo $sql1.'<br/>';
		$result1 = mysqlquery($sql1);
		while ($row1 = mysqli_fetch_array($result1))
		{
			$sql2 =	'INSERT INTO measurement'.$row1['Id'].' SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($_REQUEST['radio']);
			//echo $sql2.'<br/>';
			$result2 = mysqlquery($sql2);
		}
		if($influxData != '') $influxData .= ',';
		$influxData .= 'radioactievestraling='.floatval($_REQUEST['radio']);
	}
	
	echo 'ok<br/>';
	if($_REQUEST['id'] == 19) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'IndustrialItSDS011PM10 lat=52.184293,lon=5.943888';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-industrialit';
		}
	}
	if($_REQUEST['id'] == 62) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'Flint lat=52.18295,lon=5.92980';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-flint';
		}
	}
	if($_REQUEST['id'] == 64) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'IndustrialItBWestendorpstraat lat=52.20381,lon=5.94034';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-industrialit2';
		}
	}
	if($_REQUEST['id'] == 65) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'GertUgchelen lat=52.18603,lon=5.94865';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-gert';
		}
	}
	if($_REQUEST['id'] == 68) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'ArnoldK lat=52.22731,lon=5.98961';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-arnold';
		}
	}
	if($_REQUEST['id'] == 69) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'GerardBeemteBroekland lat=52.25876,lon=6.02645';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-gerard';
		}
	}
	if($_REQUEST['id'] == 71) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'Niels lat=52.23575,lon=5.95370';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-niels';
		}
	}
	if($_REQUEST['id'] == 72) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'Johan lat=52.38935,lon=6.03010';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-johan';
		}
	}
	if($_REQUEST['id'] == 75) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'PaJohan lat=52.03062,lon=5.57188';

			$sendToLuftDaten = true;
			$luftdatenSensorName = 'aid-pajohan';
		}
	}
	if($_REQUEST['id'] == 121) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'Daan lat=52.25667,lon=6.03867';
		}
	}
	if($_REQUEST['id'] == 122) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'Frits lat=52.23330,lon=5.99250';
		}
	}
	if($_REQUEST['id'] == 124) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'JeroenHendricksen lat=52.18349,lon=5.94239';
		}
	}
	if($_REQUEST['id'] == 156) {
		if(isset($pm10) && isset($pm25)){
			$sendToRIVM = true;
			$rivmSensorName = 'JelleJansen lat=52.29979,lon=5.04871';
		}
	}

	if($sendToRIVM) {
		$d = new DateTime();
		$now = $d->format('Y-m-d\TH:i:s');
		$d->sub(new DateInterval('PT59S'));
		$minuteBefore = $d->format('Y-m-d\TH:i:s');
		$data_string = 'm_fw,id='.$rivmSensorName.',timestamp_from="'.$minuteBefore.'Z",timestamp_to="'.$now.'Z",PM10='.str_replace(',','.',$pm10).',PM10-eenheid="ug/m3",PM10-meetopstelling="SDS011",PM2.5='.str_replace(',','.',$pm25).',PM2.5-meetopstelling="SDS011"';

		$ch = curl_init('http://influx.rivm.nl:8086/write?db=fw');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");      
		curl_setopt($ch, CURLOPT_USERPWD, 'fw:wWj5&x#n');                                                               
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                     

		$result = curl_exec($ch);

	}

	if($sendToLuftDaten) {
			// luftdaten.info
			$luftdatenData = '{"software_version": "1", "sensordatavalues":[{"value_type":"P1","value":"'.str_replace(',','.',$pm10).'"},{"value_type":"P2","value":"'.str_replace(',','.',$pm25).'"}]}';
			$ch1 = curl_init('https://api.luftdaten.info/v1/push-sensor-data/');                                                             
			curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");                                                          
			curl_setopt($ch1, CURLOPT_POSTFIELDS, $luftdatenData);                                                                  
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 
												'X-Pin: 1',
												'X-Sensor: '.$luftdatenSensorName));
			$resultLuftDaten = curl_exec($ch1);
			logerror('JSON to LuftDaten ('.$luftdatenSensorName.'): '.$luftdatenData);
			logerror('Result from LuftDaten: '.$resultLuftDaten);
	}

	insertIntoInflux($nodeName, $influxData);
	exit();
}


die("No node found");
?>