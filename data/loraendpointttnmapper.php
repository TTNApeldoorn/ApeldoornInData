<?php
set_time_limit(60);
include('db.php');
logerror('start loradata');

//logerror("Postcount: ". count($_POST));
//logerror(implode(",", $_POST));
//logerror("Requestcount: ". count($_REQUEST));
//logerror(implode(",", $_REQUEST));
//logerror("Getcount: ". count($_GET));
//logerror(implode(",", $_GET));
//$data = json_decode(file_get_contents('php://input'));
//logerror($data);
//logerror($HTTP_RAW_POST_DATA);
//$data = json_decode(file_get_contents('php://stdin'));
//logerror($data);
//logerror("Rawpostttnmapper: ".$HTTP_RAW_POST_DATA);
//var_dump($data);
echo 'Thanks';

$ruweData = file_get_contents('php://input');

if($ruweData != null) {
	$sql =	'INSERT INTO loraraw SET Moment=NOW(), Data= \''.addslashes($ruweData).'\'';
	logerror('sql: '.$sql);
	//echo $sql;
	$result = mysqlquery($sql);
	$dateNow = date('Y-m-d H:i:s');
	
	$data = json_decode($ruweData);
	
	if(addslashes($data->payload_fields->gps_1->latitude) > 86 || addslashes($data->payload_fields->gps_1->latitude) < -86) {
		logerror('Invalid latitude');
		die('Invalid latitude');
	}
	if(addslashes($data->payload_fields->gps_1->longitude) > 180 || addslashes($data->payload_fields->gps_1->longitude) < -180) {
		logerror('Invalid longitude');
		die('Invalid longitude');
	}
	
	switch($data->hardware_serial) {
		case '0000000002E00615':
			if(($data->payload_fields->analog_in_2*100) < 300) {
				$sql =	'INSERT INTO gpslocation1 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->gps_1->latitude).', Lon='.addslashes($data->payload_fields->gps_1->longitude).', Alt='.addslashes($data->payload_fields->gps_1->altitude).', Hdop='.addslashes($data->payload_fields->analog_in_2);
				logerror("Rawpostttnmappersql: ".$sql);
				//echo $sql;
				$result = mysqlquery($sql);
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
					$json .= '"accuracy":"'.$data->payload_fields->analog_in_2.'",'."\n";
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
					logerror("TTN MapperJson responsejson: ".$response);
				}
			}
			break;
	}
}

//{"app_id":"industrialit","dev_id":"node1","hardware_serial":"0000000002E00612","port":1,"counter":8416,"payload_raw":"MTYuNzszOC4xAGxkIQ==","payload_fields":{"byte1":49,"byte2":54,"byte3":46,"byte4":55,"byte5":59,"byte6":51,"byte7":56,"byte8":46,"byte9":49},"metadata":{"time":"2017-06-04T20:54:21.770859698Z","frequency":867.1,"modulation":"LORA","data_rate":"SF7BW125","coding_rate":"4/5","gateways":[{"gtw_id":"eui-aa555a0000088213","timestamp":2927612339,"time":"2017-06-04T20:54:19.648782Z","channel":3,"rssi":-118,"snr":-6,"latitude":52.21176,"longitude":5.96243,"altitude":65}]},"downlink_url":"https://integrations.thethingsnetwork.org/ttn-eu/api/v2/down/industrialit/cloudscada?key=ttn-account-v2.941N1u7CwY9AJ-nYG6mN8Oq3ahpfrDtNQQkuUO9J24U"}
?>
