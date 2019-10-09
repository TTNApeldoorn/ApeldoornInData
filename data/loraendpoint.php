<?php
include('db.php');
include('elsys.php');
include('tabs.php');
logerror('start loradata');

//logerror("Postcount: ". count($_POST));
//logerror(implode(",", $_POST));
//logerror("Requestcount: ". count($_REQUEST));
//logerror(implode(",", $_REQUEST));
//logerror("Getcount: ". count($_GET));
//logerror(implode(",", $_GET));
$data = json_decode(file_get_contents('php://input'));
logerror('phpInput: '.json_encode($data));
//logerror($HTTP_RAW_POST_DATA);
//$data = json_decode(file_get_contents('php://stdin'));
//logerror('stdin: '.$data);
//logerror("Rawpost: ".$HTTP_RAW_POST_DATA);
//var_dump($data);
echo 'Thanks';

$sendToLuftDaten = false;
$luftdatenSensorName = '';
$sendToRIVM = false;

function insertIntoInflux($nodeName, $insertData) {
	logerror('Insert into Influx: '.$nodeName.' '.$insertData);

	$ch = curl_init('http://localhost:8086/write?db=aid');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");      
	curl_setopt($ch, CURLOPT_USERPWD, 'admin:wout2466');                                                               
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nodeName.' '.$insertData);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                     
	$result = curl_exec($ch);
}
$influxData = '';

logerror('LoraEndpoint: '.file_get_contents('php://input'));
$ruweData = file_get_contents('php://input');
if($ruweData != null) {
	$sql =	'INSERT INTO loraraw SET Moment=NOW(), Data= \''.addslashes($ruweData).'\'';
	//logerror('sql: '.$sql);
	//echo $sql;
	$result = mysqlquery($sql);
	
	$dateNow = date('Y-m-d H:i:s');
	
	$data = json_decode($ruweData);
	switch($data->hardware_serial) {
		case '0000000002E00612':
			$resultString = "";
			$resultString .= chr($data->payload_fields->byte1);
			$resultString .= chr($data->payload_fields->byte2);
			$resultString .= chr($data->payload_fields->byte3);
			$resultString .= chr($data->payload_fields->byte4);
			$resultString .= chr($data->payload_fields->byte5);
			$resultString .= chr($data->payload_fields->byte6);
			$resultString .= chr($data->payload_fields->byte7);
			$resultString .= chr($data->payload_fields->byte8);
			$resultString .= chr($data->payload_fields->byte9);
			logError('Resultstring: '.$resultString);
			$resultArray = explode(';', $resultString);
			$sql =	'INSERT INTO measurement8 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($resultArray[0]);
			//echo $sql;
			$result = mysqlquery($sql);			
			$sql =	'INSERT INTO measurement9 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($resultArray[1]);
			//echo $sql;
			$result = mysqlquery($sql);
			break;	
		case 'AF5EE00000000001':
			$sql =	'INSERT INTO measurement3 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_0);
			//echo $sql;
			$result = mysqlquery($sql);
			$sql =	'INSERT INTO measurement4 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->digital_in_3);
			//echo $sql;
			$result = mysqlquery($sql);
			$sql =	'INSERT INTO measurement5 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->digital_out_4);
			//echo $sql;
			$result = mysqlquery($sql);
			$sql =	'INSERT INTO measurement6 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_2);
			//echo $sql;
			$result = mysqlquery($sql);
			$sql =	'INSERT INTO measurement7 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
			//echo $sql;
			$result = mysqlquery($sql);
			break;		
		/*case '0004A30B001ECB0C':
			if($data->dev_id == 'rfsee_aid_sensor_1') {
				$sql =	'INSERT INTO measurement10 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_0);
				//echo $sql;
				$result = mysqlquery($sql);
				$sql =	'INSERT INTO measurement11 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_1);
				//echo $sql;
				$result = mysqlquery($sql);
				$sql =	'INSERT INTO measurement12 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_2);
				//echo $sql;
				$result = mysqlquery($sql);
				if(isset($data->payload_fields->digital_in_3)) {
					$sql =	'INSERT INTO measurement13 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->digital_in_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	*/	
		case '0004A30B001F805A':
			if($data->dev_id == 'rfsee_aid_sensor_1') {
				if(isset($data->payload_fields->temperature_0)) {
					$sql =	'INSERT INTO measurement22 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_1)) {
					$sql =	'INSERT INTO measurement23 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_2)) {
					$sql =	'INSERT INTO measurement24 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->digital_in_3)) {
					$sql =	'INSERT INTO measurement25 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->digital_in_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case '0000000002E00613':
			if($data->dev_id == 'industrial_it_aid') {
				$sql =	'INSERT INTO measurement14 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_1);
				//echo $sql;
				$result = mysqlquery($sql);
				$sql =	'INSERT INTO measurement15 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_2);
				//echo $sql;
				$result = mysqlquery($sql);
				$sql =	'INSERT INTO measurement16 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_3);
				//echo $sql;
				$result = mysqlquery($sql);
				$sql =	'INSERT INTO measurement17 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_4);
				//echo $sql;
				$result = mysqlquery($sql);
				
				$nodeName = strtolower(str_replace('-', '', preg_replace('/\s+/', '', 'Industrial IT AiD')));
				$influxData .= 'lux='.floatval($data->payload_fields->luminosity_1);
				$influxData .= ',temperatuur='.floatval($data->payload_fields->temperature_2);
				$influxData .= ',vochtigheid='.floatval($data->payload_fields->relative_humidity_3);
				$influxData .= ',luchtdruk='.floatval($data->payload_fields->barometric_pressure_4);
				insertIntoInflux($nodeName, $influxData);
			}
			break;	
		case '00998AF97646CF13':
			if($data->dev_id == 'rfsee_aid_sensor_2') {
				if(isset($data->payload_fields->temperature_10)) {
					$sql =	'INSERT INTO measurement18 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_20)) {
					$sql =	'INSERT INTO measurement19 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_20);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_2)) {
					$sql =	'INSERT INTO measurement20 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				// Accu
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement21 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_51)) {
					$sql =	'INSERT INTO measurement27 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_51);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_50)) {
					$sql =	'INSERT INTO measurement28 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_50);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case '002CC2194BADD5C0':
			if($data->dev_id == 'rfsee_aid_sensor_4') {
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement29 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->temperature_1)) {
					$sql =	'INSERT INTO measurement30 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_4)) {
					$sql =	'INSERT INTO measurement31 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_4);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				/*
				if(isset($data->payload_fields->digital_in_3)) {
					$sql =	'INSERT INTO measurement32 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->digital_in_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}*/
			}
			break;	
		case '0014115D20F6F977':
			if($data->dev_id == 'dust_sensor1') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement33 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case 'AF5EE00098767651':
			if($data->dev_id == 'rfsee_aid_sensor_3') {
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement34 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->temperature_1)) {
					$sql =	'INSERT INTO measurement35 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case 'AF5EE05500000004':
			if($data->dev_id == 'rfsee_aid_sensor_5') {
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement36 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->temperature_1)) {
					$sql =	'INSERT INTO measurement37 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0004A30B001B462B':
			if($data->dev_id == 'rfsee_aid_sensor_10') {
				if(isset($data->payload_fields->temperature_10)) {
					$sql =	'INSERT INTO measurement44 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_20)) {
					$sql =	'INSERT INTO measurement45 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_20);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_30)) {
					$sql =	'INSERT INTO measurement46 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_30);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_51)) {
					$sql =	'INSERT INTO measurement47 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_51);
					//echo $sql;
					$result = mysqlquery($sql);
					$pm10 = $data->payload_fields->luminosity_51;
				}
				if(isset($data->payload_fields->luminosity_50)) {
					$sql =	'INSERT INTO measurement48 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_50);
					//echo $sql;
					$result = mysqlquery($sql);
					$pm25 = $data->payload_fields->luminosity_50;
				}
							
				$sendToRIVM = true;
				$rivmSensorName = 'rfsee_aid_sensor_10 lat=52.211453,lon=5.983743';

				$sendToLuftDaten = true;
				$luftdatenSensorName = 'aid-rfsee10';
			}
			break;		
		case '0004A30B001BF828':
			if($data->dev_id == 'rfsee_aid_sensor_11') {
				if(isset($data->payload_fields->temperature_10)) {
					$sql =	'INSERT INTO measurement49 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_20)) {
					$sql =	'INSERT INTO measurement50 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_20);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_30)) {
					$sql =	'INSERT INTO measurement51 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_30);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_51)) {
					$sql =	'INSERT INTO measurement52 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_51);
					//echo $sql;
					$result = mysqlquery($sql);					
					$pm10 = $data->payload_fields->luminosity_51;
				}
				if(isset($data->payload_fields->luminosity_50)) {
					$sql =	'INSERT INTO measurement53 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_50);
					//echo $sql;
					$result = mysqlquery($sql);
					$pm25 = $data->payload_fields->luminosity_50;
				}
							
				$sendToRIVM = true;
				$rivmSensorName = 'rfsee_aid_sensor_11 lat=52.18168,lon=5.94374';

				$sendToLuftDaten = true;
				$luftdatenSensorName = 'aid-rfsee11';
			}
			break;		
		case '007218160B8DD4F9':
			if($data->dev_id == 'dustsensor_01') {
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement59 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_1)) {
					$sql =	'INSERT INTO measurement150 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->temperature_2)) {
					$sql =	'INSERT INTO measurement144 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_3)) {
					$sql =	'INSERT INTO measurement145 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_4)) {
					$sql =	'INSERT INTO measurement146 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_4);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000001':
			if($data->dev_id == 'ttn_apld_dust_0000000000000001') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement60 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000001') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement169 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement170 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement171 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement172 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000001') {
				logError('hittestress-0000000000000001: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement319 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement320 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement321 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement322 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement323 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement324 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode125 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=125';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000002':
			if($data->dev_id == 'ttn_apld_dust_0000000000000002') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement61 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000002') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement173 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement174 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement175 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement176 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000002') {
				logError('hittestress-0000000000000002: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement327 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement328 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement329 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement330 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement331 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement332 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode126 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=126';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000003':
			if($data->dev_id == 'ttn_apld_dust_0000000000000003') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement62 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000003') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement177 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement178 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement179 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement180 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000003') {
				logError('hittestress-0000000000000003: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement333 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement334 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement335 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement336 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement337 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement338 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode127 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=127';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000004':
			if($data->dev_id == 'ttn_apld_dust_0000000000000004') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement63 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000004') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement181 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement182 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement183 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement184 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000004') {
				logError('hittestress-0000000000000004: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement339 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement340 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement341 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement342 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement343 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement344 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode128 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=128';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000005':
			if($data->dev_id == 'ttn_apld_dust_0000000000000005') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement64 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000005') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement185 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement186 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement187 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement188 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000005') {
				logError('hittestress-0000000000000005: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement345 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement346 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement347 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement348 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement349 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement350 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode129 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=129';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000006':
			if($data->dev_id == 'ttn_apld_dust_0000000000000006') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement65 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000006') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement189 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement190 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement191 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement192 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000006') {
				logError('hittestress-0000000000000006: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement351 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement352 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement353 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement354 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement355 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement356 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode130 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=130';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000007':
			if($data->dev_id == 'ttn_apld_dust_0000000000000007') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement66 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000007') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement193 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement194 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement195 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement196 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000007') {
				logError('hittestress-0000000000000007: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement357 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement358 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement359 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement360 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement361 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement362 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode131 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=131';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000008':
			if($data->dev_id == 'ttn_apld_dust_0000000000000008') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement67 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000008') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement197 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement198 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement199 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement200 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000008') {
				logError('hittestress-0000000000000008: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement363 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement364 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement365 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement366 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement367 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement368 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode132 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=132';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '0000000000000009':
			if($data->dev_id == 'ttn_apld_dust_0000000000000009') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement68 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000009') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement201 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement202 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement203 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement204 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-0000000000000009') {
				logError('hittestress-0000000000000009: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement369 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement370 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement371 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement372 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement373 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement374 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode133 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=133';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000A':
			if($data->dev_id == 'ttn_apld_dust_000000000000000a') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement69 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-000000000000000a') {
				logError('hittestress-000000000000000a: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement375 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement376 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement377 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement378 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement379 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement380 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode134 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=134';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000B':
			if($data->dev_id == 'ttn_apld_dust_000000000000000b') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement70 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-000000000000000b') {
				logError('hittestress-000000000000000b: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement381 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement382 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement383 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement384 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement385 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement386 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode135 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=135';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000C':
			logError('device 0c: '.json_encode($data) );
			if($data->dev_id == 'ttn_apld_dust_000000000000000c') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement71 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-000000000000000c') {
				logError('hittestress-000000000000000c: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement387 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement388 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement389 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement390 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement391 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement392 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode136 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=136';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000D':
			if($data->dev_id == 'ttn_apld_dust_000000000000000d') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement72 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-000000000000000d') {
				logError('hittestress-000000000000000d: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement393 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement394 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement395 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement396 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement397 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement398 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode137 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=137';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000E':
			if($data->dev_id == 'ttn_apld_dust_000000000000000e') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement73 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'hittestress-000000000000000e') {
				logError('hittestress-000000000000000e: '.json_encode($data) );
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement399 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement400 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement401 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm2p5)) {
					$sql =	'INSERT INTO measurement402 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm2p5);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->Vbat)) {
					$sql =	'INSERT INTO measurement403 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->Vbat);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->CpuTemp)) {
					$sql =	'INSERT INTO measurement404 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->CpuTemp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->latitude) && isset($data->payload_fields->longitude)) {
					if(!(substr($data->payload_fields->latitude, 0, 1) === "0") && !(substr($data->payload_fields->longitude, 0, 1) === "0")) {
						$sql =	'INSERT INTO locationnode138 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude);
						//echo $sql;
						$result = mysqlquery($sql);
						$sql =	'UPDATE node SET Lastlocationlat=\''.addslashes($data->payload_fields->latitude).'\', Lastlocationlon=\''.addslashes($data->payload_fields->longitude).'\' WHERE Id=138';
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;		
		case '000000000000000F':
			if($data->dev_id == 'ttn_apld_dust_000000000000000f') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement74 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000010':
			if($data->dev_id == 'ttn_apld_dust_0000000000000010') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement75 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000010') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement205 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement206 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement207 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement208 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000011':
			if($data->dev_id == 'ttn_apld_dust_0000000000000011') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement76 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000011') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement209 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement210 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement211 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement212 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000012':
			if($data->dev_id == 'ttn_apld_dust_0000000000000012') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement77 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000012') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement213 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement214 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement215 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement216 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000013':
			if($data->dev_id == 'ttn_apld_dust_0000000000000013') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement78 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000013') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement217 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement218 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement219 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement220 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000014':
			if($data->dev_id == 'ttn_apld_dust_0000000000000014') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement79 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000014') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement221 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement222 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement223 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement224 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000015':
			if($data->dev_id == 'ttn_apld_dust_0000000000000015') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement80 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000015') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement225 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement226 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement227 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement228 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000016':
			if($data->dev_id == 'ttn_apld_dust_0000000000000016') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement81 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000016') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement229 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement230 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement231 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement232 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000017':
			if($data->dev_id == 'ttn_apld_dust_0000000000000017') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement82 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000017') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement233 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement234 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement235 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement236 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000018':
			if($data->dev_id == 'ttn_apld_dust_0000000000000018') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement83 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000018') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement237 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement238 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement239 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement240 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '0000000000000019':
			if($data->dev_id == 'ttn_apld_dust_0000000000000019') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement84 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			if($data->dev_id == 'ttn_apld_dust_20180000000000000019') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement241 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement242 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement243 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement244 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000020':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000020') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement245 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement246 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement247 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement248 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000021':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000021') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement249 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement250 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement251 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement252 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000022':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000022') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement253 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement254 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement255 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement256 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000023':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000023') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement257 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement258 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement259 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement260 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000024':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000024') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement261 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement262 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement263 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement264 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000025':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000025') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement265 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement266 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement267 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement268 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000026':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000026') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement280 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement281 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement282 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement283 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000027':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000027') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement290 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement291 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement292 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement293 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000028':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000028') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement286 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement287 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement288 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement289 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '0000000000000029':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000029') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement294 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement295 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement296 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement297 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '006F301517B57BF3':
			if($data->dev_id == 'ttn_apld_dust_20180000000000000031') {
				if(isset($data->payload_fields->temp)) {
					$sql =	'INSERT INTO measurement298 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temp);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->rh)) {
					$sql =	'INSERT INTO measurement299 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->rh);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm10)) {
					$sql =	'INSERT INTO measurement300 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->pm25)) {
					$sql =	'INSERT INTO measurement301 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '000000000000001A':
			if($data->dev_id == 'ttn_apld_dust_000000000000001a') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement85 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '000000000000001B':
			if($data->dev_id == 'ttn_apld_dust_000000000000001b') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement86 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '000000000000001C':
			if($data->dev_id == 'ttn_apld_dust_000000000000001c') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement87 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '000000000000001D':
			if($data->dev_id == 'ttn_apld_dust_000000000000001d') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement88 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '000000000000001E':
			if($data->dev_id == 'ttn_apld_dust_000000000000001e') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement89 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '000000000000001F':
			if($data->dev_id == 'ttn_apld_dust_000000000000001f') {
				if(isset($data->payload_fields->dust_density_ug_m3)) {
					$sql =	'INSERT INTO measurement90 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->dust_density_ug_m3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '00BC52F6E1DE255D':
			if($data->dev_id == 'atranco_dustsensor_02') {
				if(isset($data->payload_fields->analog_in_0)) {
					$sql =	'INSERT INTO measurement91 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;		
		case '005E7AC9D7AE97D6':
			if($data->dev_id == 'atranco_sds011_03') {
				if(isset($data->payload_fields->analog_in_0)) {
					$pm10 = $data->payload_fields->analog_in_0;
					$sql =	'INSERT INTO measurement127 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_1)) {
					$pm25 = $data->payload_fields->analog_in_1;
					$sql =	'INSERT INTO measurement128 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($pm10) && isset($pm25)) {					
					$sendToRIVM = true;
					$rivmSensorName = 'AtrancoSDS011PM10 lat=52.23574,lon=5.95375';

					$sendToLuftDaten = true;
					$luftdatenSensorName = 'aid-altranco3';
				}
			}
			break;			
		case '0077BD6073272BA9':
			if($data->dev_id == 'dev_id_001') {
				if(isset($data->payload_fields->analog_in_0)) {
					$pm10 = $data->payload_fields->analog_in_0;
					$sql =	'INSERT INTO measurement129 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_1)) {
					$pm25 = $data->payload_fields->analog_in_1;
					$sql =	'INSERT INTO measurement130 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($pm10) && isset($pm25)) {					
					$sendToRIVM = true;
					$rivmSensorName = 'HansSSDS011PM10 lat=52.1450674,lon=6.20458898';
				}
			}
			break;		
		case '00C08BC53133CA8C':
			if($data->dev_id == 'rfsee_air_mjs_trial') {
				if(isset($data->payload_fields->temperature_1)) {
					$sql =	'INSERT INTO measurement167 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_2)) {
					$sql =	'INSERT INTO measurement168 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_9)) {
					$sql =	'INSERT INTO measurement302 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_9);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->luminosity_8)) {
					$sql =	'INSERT INTO measurement303 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->luminosity_8);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case '00CEC13936F2B303':
			if($data->dev_id == 'dev_id_002') {
				if(isset($data->payload_fields->temperature_2)) {
					$sql =	'INSERT INTO measurement147 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_3)) {
					$sql =	'INSERT INTO measurement148 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_4)) {
					$sql =	'INSERT INTO measurement149 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_4);
					//echo $sql;
					$result = mysqlquery($sql);
				}				
				if(isset($data->payload_fields->analog_in_0)) {
					$pm10 = $data->payload_fields->analog_in_0;
					$sql =	'INSERT INTO measurement160 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm10);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_1)) {
					$pm25 = $data->payload_fields->analog_in_1;
					$sql =	'INSERT INTO measurement161 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($pm25);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($pm10) && isset($pm25)) {					
					$sendToRIVM = true;
					$rivmSensorName = 'HansSSDS011PM10 lat=52.1450674,lon=6.20458898';
				}
			}
			break;	
		case '70B3D549905D7542':
			if($data->dev_id == 'lopysense01') {
				if(isset($data->payload_fields->temperature_1)) {
					$sql =	'INSERT INTO measurement102 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->temperature_1);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->relative_humidity_2)) {
					$sql =	'INSERT INTO measurement103 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->relative_humidity_2);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->barometric_pressure_3)) {
					$sql =	'INSERT INTO measurement104 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->barometric_pressure_3);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_4)) {
					$sql =	'INSERT INTO measurement105 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_4);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->accelerometer_5)) {
					if(isset($data->payload_fields->accelerometer_5->x)) {
						$sql =	'INSERT INTO measurement106 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->accelerometer_5->x);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($data->payload_fields->accelerometer_5->y)) {
						$sql =	'INSERT INTO measurement107 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->accelerometer_5->y);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($data->payload_fields->accelerometer_5->z)) {
						$sql =	'INSERT INTO measurement108 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->accelerometer_5->z);
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
				if(isset($data->payload_fields->analog_in_7)) {
					$sql =	'INSERT INTO measurement109 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_7);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($data->payload_fields->analog_in_6)) {
					$sql =	'INSERT INTO measurement110 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_6);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;
		case 'A81758FFFE034AFA':
			if($data->dev_id == 'ersdesk') {
				if(isset($data)) {
					logerror('Ersdesk: '.json_encode($data));
					$elsysArray = getElsysArray($data->payload_raw);
					logerror('Hollander ERS: '.json_encode($elsysArray));
					
					if(isset($elsysArray['temperature'])) {
						$sql =	'INSERT INTO measurement133 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['temperature']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['humidity'])) {
						$sql =	'INSERT INTO measurement134 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['humidity']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['light'])) {
						$sql =	'INSERT INTO measurement135 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['light']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['pir'])) {
						$sql =	'INSERT INTO measurement136 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['pir']);
						//echo $sql;
						//$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['vdd'])) {
						$sql =	'INSERT INTO measurement137 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['vdd']/1000);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['occupancy'])) {
						$sql =	'INSERT INTO measurement138 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['occupancy']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['irtempint'])) {
						$sql =	'INSERT INTO measurement284 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['irtempint']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					
					if(isset($elsysArray['irtempext'])) {
						$sql =	'INSERT INTO measurement285 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['irtempext']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;
		case '58A0CB0000102AAD':
			if($data->dev_id == 'tbdw100deursensor') {
				if(isset($data)) {
					logerror('tbdw100deursensor: '.json_encode($data));
					//$sql =	'INSERT INTO measurement133 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					//$result = mysqlquery($sql);
				}
			}
			break;	
		case '58A0CB0000101BE4':
			if($data->dev_id == 'tbms100pir') {
				logerror('tbms100pir: '.json_encode($data));
				$arrTabs = getTabsArrayPir($data->payload_raw);
				logerror('tbms100pir: '.json_encode($arrTabs));
				if(isset($arrTabs['occupied'])) {
					$sql =	'INSERT INTO measurement269 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['occupied']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['accuremaining'])) {
					$sql =	'INSERT INTO measurement270 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['accuremaining']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['accuvoltage'])) {
					$sql =	'INSERT INTO measurement271 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['accuvoltage']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['time'])) {
					$sql =	'INSERT INTO measurement272 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['time']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['motioncount'])) {
					$sql =	'INSERT INTO measurement273 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['motioncount']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case '58A0CB00001032E6':
			if($data->dev_id == 'tbhv100healthyhome') {
				logerror('tbhv100healthyhome: '.json_encode($data));
				$arrTabs = getTabsArrayHealtyHome($data->payload_raw);
				logerror('tbhv100healthyhome: '.json_encode($arrTabs));
				if(isset($arrTabs['accuremaining'])) {
					$sql =	'INSERT INTO measurement274 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['accuremaining']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['accuvoltage'])) {
					$sql =	'INSERT INTO measurement275 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['accuvoltage']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['temperature'])) {
					$sql =	'INSERT INTO measurement276 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['temperature']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['humidity'])) {
					$sql =	'INSERT INTO measurement277 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['humidity']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['co2'])) {
					$sql =	'INSERT INTO measurement278 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['co2']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
				if(isset($arrTabs['voc'])) {
					$sql =	'INSERT INTO measurement279 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($arrTabs['voc']);
					//echo $sql;
					$result = mysqlquery($sql);
				}
			}
			break;	
		case '58A0CB00001016E0':
			if($data->dev_id == 'tbhh100temphum') {
				if(isset($data)) {
					logerror('tbhh100temphum: '.json_encode($data));
					//$sql =	'INSERT INTO measurement133 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($data->payload_fields->analog_in_0);
					//echo $sql;
					//$result = mysqlquery($sql);
				}
			}
			break;
		case '70B3D5499655534A':
			if($data->dev_id == 'lopytrack01') {
				if(isset($data->payload_fields->gps_1)) {
					$sql =	'INSERT INTO gpslocation67 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->gps_1->latitude.', Lon='.addslashes($data->payload_fields->gps_1->longitude));
					//echo $sql;
					$result = mysqlquery($sql);
					/*
					$last_id = mysql_insert_id($connection);
					//logerror('Result: '.$last_id);
					
					foreach($data->metadata->gateways as $gateway)
					{
						$json = '{'."\n";
						$json .= '"time":"'.substr($data->metadata->time, 0, 23).'",'."\n";
						$json .= '"devid":"'.$data->dev_id.'",'."\n";
						$json .= '"appid":"'.$data->app_id.'",'."\n";
						$json .= '"gwaddr":"'.$gateway->gtw_id.'",'."\n";
						$json .= '"snr":"'.$gateway->snr.'",'."\n";
						$json .= '"rssi":"'.$gateway->rssi.'",'."\n";
						$json .= '"freq":"'.$data->metadata->frequency.'",'."\n";
						$json .= '"datarate":"'.$data->metadata->data_rate.'",'."\n";
						$json .= '"lat":"'.$data->payload_fields->gps_1->latitude.'",'."\n";
						$json .= '"lon":"'.$data->payload_fields->gps_1->longitude.'",'."\n";
						$json .= '"appeui":"70B3D57EF0006373",'."\n";
						$json .= '"alt":"'.$data->payload_fields->gps_1->altitude.'",'."\n";
						$json .= '"accuracy":"0.5",'."\n";
						$json .= '"provider":"gps",'."\n";
						$json .= '"user_id":"Frank - Ugchelen"'."\n";
						//$json .= ', "experiment":"Industrial IT GPS tracker Test"'."\n";
						$json .= '}';
						logerror("TTN MapperJson: ".$json);
						
						$sql1 =	'INSERT INTO gpsgateway SET Gpslocationid=\''.$last_id.'\', Gwid=\''.addslashes($gateway->gtw_id).'\', Channel=\''.addslashes($gateway->channel).'\', Rssi=\''.addslashes($gateway->rssi).'\', Snr=\''.addslashes($gateway->snr).'\'';
						//echo $sql1;
						logerror("GPS data: ".$sql1);
						$result1 = mysqlquery($sql1);
						
						
						$url = "http://ttnmapper.org/api/";

						$curl = curl_init($url);
						curl_setopt($curl, CURLOPT_HEADER, false);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
						logerror("voor curl");

						$json_response = curl_exec($curl);
						logerror("na curl");

						$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
						logerror("curl status: ".$status);

						if ( $status != 200 ) {
							logerror("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
							die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
						}
						logerror("curl voor close");
						curl_close($curl);
						logerror("curl na close");

						logerror("TTN MapperJson response: ".$json_response);
						$response = json_decode($json_response, true);
						logerror("TTN MapperJson responsejson: ".json_encode( $response));
					}
					*/
				}
			}
			break;
		case 'A81758FFFE034A22':
			if($data->dev_id == 'ers') {
				if(isset($data)) {
					logerror('Hollander ERS raw: '.json_encode($data));
					$elsysArray = getElsysArray($data->payload_raw);
					logerror('Hollander ERS: '.json_encode($elsysArray));
					
					if(isset($elsysArray['temperature'])) {
						$sql =	'INSERT INTO measurement139 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['temperature']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['humidity'])) {
						$sql =	'INSERT INTO measurement140 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['humidity']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['light'])) {
						$sql =	'INSERT INTO measurement141 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['light']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['pir'])) {
						$sql =	'INSERT INTO measurement142 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['pir']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['vdd'])) {
						$sql =	'INSERT INTO measurement143 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['vdd']/1000);
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;
			
		case 'A81758FFFE0324E5':
			if($data->dev_id == 'ersco2') {
				if(isset($data)) {
					logerror('Hollander ERS CO2 raw: '.json_encode($data));
					$elsysArray = getElsysArray($data->payload_raw);
					logerror('Hollander ERS CO2: '.json_encode($elsysArray));
					
					if(isset($elsysArray['temperature'])) {
						$sql =	'INSERT INTO measurement151 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['temperature']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['humidity'])) {
						$sql =	'INSERT INTO measurement152 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['humidity']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['light'])) {
						$sql =	'INSERT INTO measurement153 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['light']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['pir'])) {
						$sql =	'INSERT INTO measurement154 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['pir']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['co2'])) {
						$sql =	'INSERT INTO measurement155 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['co2']);
						//echo $sql;
						$result = mysqlquery($sql);
					}
					if(isset($elsysArray['vdd'])) {
						$sql =	'INSERT INTO measurement156 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['vdd']/1000);
						//echo $sql;
						$result = mysqlquery($sql);
					}
				}
			}
			break;
			
			case 'A81758FFFE03E88E':
				if($data->dev_id == 'ersco2bev') {
					if(isset($data)) {
						logerror('Hollander ERS CO2 bev raw: '.json_encode($data));
						$elsysArray = getElsysArray($data->payload_raw);
						logerror('Hollander ERS CO2 bev: '.json_encode($elsysArray));
						
						if(isset($elsysArray['temperature'])) {
							$sql =	'INSERT INTO measurement304 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['temperature']);
							//echo $sql;
							$result = mysqlquery($sql);
						}
						if(isset($elsysArray['humidity'])) {
							$sql =	'INSERT INTO measurement305 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['humidity']);
							//echo $sql;
							$result = mysqlquery($sql);
						}
						if(isset($elsysArray['light'])) {
							$sql =	'INSERT INTO measurement306 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['light']);
							//echo $sql;
							$result = mysqlquery($sql);
						}
						if(isset($elsysArray['pir'])) {
							$sql =	'INSERT INTO measurement307 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['pir']);
							//echo $sql;
							$result = mysqlquery($sql);
						}
						if(isset($elsysArray['co2'])) {
							$sql =	'INSERT INTO measurement308 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['co2']);
							//echo $sql;
							$result = mysqlquery($sql);
						}
						if(isset($elsysArray['vdd'])) {
							$sql =	'INSERT INTO measurement309 SET Moment=\''.$dateNow.'\', Tagvalue='.addslashes($elsysArray['vdd']/1000);
							//echo $sql;
							$result = mysqlquery($sql);
						}
					}
				}
				break;
	}

	if($sendToRIVM) {
		logerror('RIVM sensorname: '.$rivmSensorName);
		
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
}

//{"app_id":"industrialit","dev_id":"node1","hardware_serial":"0000000002E00612","port":1,"counter":8416,"payload_raw":"MTYuNzszOC4xAGxkIQ==","payload_fields":{"byte1":49,"byte2":54,"byte3":46,"byte4":55,"byte5":59,"byte6":51,"byte7":56,"byte8":46,"byte9":49},"metadata":{"time":"2017-06-04T20:54:21.770859698Z","frequency":867.1,"modulation":"LORA","data_rate":"SF7BW125","coding_rate":"4/5","gateways":[{"gtw_id":"eui-aa555a0000088213","timestamp":2927612339,"time":"2017-06-04T20:54:19.648782Z","channel":3,"rssi":-118,"snr":-6,"latitude":52.21176,"longitude":5.96243,"altitude":65}]},"downlink_url":"https://integrations.thethingsnetwork.org/ttn-eu/api/v2/down/industrialit/cloudscada?key=ttn-account-v2.941N1u7CwY9AJ-nYG6mN8Oq3ahpfrDtNQQkuUO9J24U"}
?>
