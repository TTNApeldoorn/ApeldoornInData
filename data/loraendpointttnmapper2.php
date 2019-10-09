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
	$sql =	'INSERT INTO lorarawttnmapper SET Moment=NOW(), Data= \''.addslashes($ruweData).'\'';
	logerror('sql: '.$sql);
    //echo $sql;

	$result = mysqlquery($sql);
	$dateNow = date('Y-m-d H:i:s');
	
	$data = json_decode($ruweData);
	
	if(addslashes($data->payload_fields->latitude) > 86 || addslashes($data->payload_fields->latitude) < -86) {
		logerror('Invalid latitude');
		die('Invalid latitude');
	}
	if(addslashes($data->payload_fields->longitude) > 180 || addslashes($data->payload_fields->longitude) < -180) {
		logerror('Invalid longitude');
		die('Invalid longitude');
	}
    logerror("Rawpostttnmappersql: $data->dev_id: ".$data->dev_id);
    if($data->dev_id == 'paxcounter01') {
        $sql =	'INSERT INTO gpslocation1 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->latitude).', Lon='.addslashes($data->payload_fields->longitude).', Alt='.addslashes($data->payload_fields->altitude).', Hdop='.addslashes($data->payload_fields->hdop);
        logerror("Rawpostttnmappersql: ".$sql);
        //echo $sql;
        $result = mysqlquery($sql);
    }
    if($data->dev_id == 'kiptracker') {
        $sql =	'INSERT INTO gpslocation2 SET Moment=\''.$dateNow.'\', Lat='.addslashes($data->payload_fields->gps_0->latitude).', Lon='.addslashes($data->payload_fields->gps_0->longitude).', Alt='.addslashes($data->payload_fields->gps_0->altitude);
        logerror("Rawpostttnmappersql: ".$sql);
        //echo $sql;
        $result = mysqlquery($sql);
    }

    

    //$last_id = mysqli_insert_id();
    //logerror('Result last insert id: '.$last_id);
    /*
    foreach($data->metadata->gateways as $gateway)
    {           
        $sql1 =	'INSERT INTO gpsgateway SET Gpslocationid=\''.$last_id.'\', Gwid=\''.addslashes($gateway->gtw_id).'\', Channel=\''.addslashes($gateway->channel).'\', Rssi=\''.addslashes($gateway->rssi).'\', Snr=\''.addslashes($gateway->snr).'\'';
        //echo $sql1;
    }
    */
}

//{"app_id":"industrialit","dev_id":"node1","hardware_serial":"0000000002E00612","port":1,"counter":8416,"payload_raw":"MTYuNzszOC4xAGxkIQ==","payload_fields":{"byte1":49,"byte2":54,"byte3":46,"byte4":55,"byte5":59,"byte6":51,"byte7":56,"byte8":46,"byte9":49},"metadata":{"time":"2017-06-04T20:54:21.770859698Z","frequency":867.1,"modulation":"LORA","data_rate":"SF7BW125","coding_rate":"4/5","gateways":[{"gtw_id":"eui-aa555a0000088213","timestamp":2927612339,"time":"2017-06-04T20:54:19.648782Z","channel":3,"rssi":-118,"snr":-6,"latitude":52.21176,"longitude":5.96243,"altitude":65}]},"downlink_url":"https://integrations.thethingsnetwork.org/ttn-eu/api/v2/down/industrialit/cloudscada?key=ttn-account-v2.941N1u7CwY9AJ-nYG6mN8Oq3ahpfrDtNQQkuUO9J24U"}
?>
