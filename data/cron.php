<?php
include('db.php');
logerror('start Cron');

$sql =	'SELECT * FROM loraraw WHERE processed = 0 LIMIT 1000';
//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
	echo $row['Moment'].'<br/>';
	$data = json_decode($row['Data']);
	
	$devId = addslashes($data->dev_id);
	$hwSerial = addslashes($data->hardware_serial);
	$nodeId = null;
	$nodeId = insertOrCreateNode($devId, $hwSerial);
	processNodeStatistics($data, $nodeId);
	processGatewayStatistics($data);
	
	$sqlUpdate = 'UPDATE loraraw SET Processed=1, Nodeid= '.$nodeId.' WHERE Id = '.$row['Id'];
	//echo $sqlUpdate.'<br/>';
	mysqlquery($sqlUpdate);
	
}

function insertOrCreateNode($devId, $hwSerial) {
	$sql =	'SELECT * FROM node WHERE Devid = \''.addslashes($devId).'\' AND Hwserial = \''.addslashes($hwSerial).'\'';
	//echo $sql;
	$result = mysqlquery($sql);
	while ($row = mysqli_fetch_array($result))
	{
		$nodeId = $row['Id'];
	}
	if($nodeId == null) {
		$sqlInsert =	'INSERT node SET Devid=\''.$devId.'\', Hwserial=\''.$hwSerial.'\'';
		//echo $sqlInsert.'<br/>';
		mysqlquery($sqlInsert);
	}
	$sql =	'SELECT * FROM node WHERE Devid = '.addslashes($devId).' AND Hwserial = '.addslashes($hwSerial);
	//echo $sql;
	$result = mysqlquery($sql);
	while ($row = mysqli_fetch_array($result))
	{
		$nodeId = $row['Id'];
	}
	return $nodeId;
}

function processNodeStatistics($data, $nodeId) {
	$sqlSfString = '';
	if(strpos($data->metadata->data_rate, 'SF7') !== false) {
		$sqlSfString .= ', Sf7 = Sf7 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF8') !== false) {
		$sqlSfString .= ', Sf8 = Sf8 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF9') !== false) {
		$sqlSfString .= ', Sf9 = Sf9 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF10') !== false) {
		$sqlSfString .= ', Sf10 = Sf10 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF11') !== false) {
		$sqlSfString .= ', Sf11 = Sf11 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF12') !== false) {
		$sqlSfString .= ', Sf12 = Sf12 + 1';
	}
	foreach($data->metadata->gateways as $gateway)
	{
		$sqlChannelString = '';
		switch($gateway->channel) {
			case 0: 
				$sqlChannelString .= ', Ch0 = Ch0 + 1';
				break;
			case 1: 
				$sqlChannelString .= ', Ch1 = Ch1 + 1';
				break;
			case 2: 
				$sqlChannelString .= ', Ch2 = Ch2 + 1';
				break;
			case 3: 
				$sqlChannelString .= ', Ch3 = Ch3 + 1';
				break;
			case 4: 
				$sqlChannelString .= ', Ch4 = Ch4 + 1';
				break;
			case 5: 
				$sqlChannelString .= ', Ch5 = Ch5 + 1';
				break;
			case 6: 
				$sqlChannelString .= ', Ch6 = Ch6 + 1';
				break;
			case 7: 
				$sqlChannelString .= ', Ch7 = Ch7 + 1';
				break;
		}
	}    
	
	$sql2 =	'UPDATE node SET Lastmessage=NOW()'.$sqlSfString.' '.$sqlChannelString.', Packets = Packets + 1 WHERE Id = '.$nodeId;
	//echo $sql2;
	mysqlquery($sql2);
}

function processGatewayStatistics($data) {
	$sqlSfString = '';
	if(strpos($data->metadata->data_rate, 'SF7') !== false) {
		$sqlSfString .= ', Sf7 = Sf7 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF8') !== false) {
		$sqlSfString .= ', Sf8 = Sf8 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF9') !== false) {
		$sqlSfString .= ', Sf9 = Sf9 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF10') !== false) {
		$sqlSfString .= ', Sf10 = Sf10 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF11') !== false) {
		$sqlSfString .= ', Sf11 = Sf11 + 1';
	}
	if(strpos($data->metadata->data_rate, 'SF12') !== false) {
		$sqlSfString .= ', Sf12 = Sf12 + 1';
	}
	foreach($data->metadata->gateways as $gateway)
	{
		$sqlChannelString = '';
		switch($gateway->channel) {
			case 0: 
				$sqlChannelString .= ', Ch0 = Ch0 + 1';
				break;
			case 1: 
				$sqlChannelString .= ', Ch1 = Ch1 + 1';
				break;
			case 2: 
				$sqlChannelString .= ', Ch2 = Ch2 + 1';
				break;
			case 3: 
				$sqlChannelString .= ', Ch3 = Ch3 + 1';
				break;
			case 4: 
				$sqlChannelString .= ', Ch4 = Ch4 + 1';
				break;
			case 5: 
				$sqlChannelString .= ', Ch5 = Ch5 + 1';
				break;
			case 6: 
				$sqlChannelString .= ', Ch6 = Ch6 + 1';
				break;
			case 7: 
				$sqlChannelString .= ', Ch7 = Ch7 + 1';
				break;
			
		}
		
		$sql1 =	'INSERT INTO gateway SET Lastmessage=NOW(), Gateway= \''.addslashes($gateway->gtw_id).'\' '.$sqlSfString.' '.$sqlChannelString.', Packets = Packets + 1 ON DUPLICATE KEY UPDATE Lastmessage=NOW() '.$sqlSfString.' '.$sqlChannelString.', Packets = Packets + 1 ';
		//echo $sql;
		mysqlquery($sql1);
	}        
}
?>