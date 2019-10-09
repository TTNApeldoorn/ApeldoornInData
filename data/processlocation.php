<?php
include('db.php');
?>
<script type="text/javascript">
  setTimeout(function () { location.reload(true); }, 100);
</script>

<?php

//echo '<pre>';
/*
$sql =	'Truncate lorarawttnmapperlocation';
mysqlquery($sql);
$sql =	'Truncate lorarawttnmappergateway';
mysqlquery($sql);
*/

$sql =	'SELECT * FROM lorarawttnmapper WHERE Processed = 0 ORDER BY moment ASC LIMIT 50';
//echo $sql;
$result = mysqlquery($sql);
while ($row = mysqli_fetch_array($result))
{
    echo $row['Id'].'<br/>';
    //var_dump($row);
    if(isset($row['Data'])) {
        $dataObject = json_decode($row['Data']);
        if(isset($dataObject->payload_fields)) {
            $availableFields = 0;
            if(isset($dataObject->payload_fields->latitude)) {
                $lat = $dataObject->payload_fields->latitude;
                //echo 'Lat: '.$lat.'<br/>'."\n";
                $availableFields++;
            }
            if(isset($dataObject->payload_fields->longitude)) {
                $lon = $dataObject->payload_fields->longitude;
                //echo 'Lon: '.$lon.'<br/>'."\n";
                $availableFields++;
            }
            if(isset($dataObject->payload_fields->altitude)) {
                $alt = $dataObject->payload_fields->altitude;
                //echo 'Alt: '.$alt.'<br/>'."\n";
                $availableFields++;
            }
            if(isset($dataObject->payload_fields->hdop)) {
                $hdop = $dataObject->payload_fields->hdop;
                //echo 'Hdop: '.$hdop.'<br/>'."\n";
            }
            if(isset($dataObject->metadata->time)) {
                $time = $dataObject->metadata->time;
                //echo 'Time: '.$time.'<br/>'."\n";
                $availableFields++;
            }
            
            if(isset($dataObject->metadata->gateways)) {
                $gateways = $dataObject->metadata->gateways;
                usort($gateways, function($a, $b) { //Sort the array using a user defined function
                    return $a->rssi > $b->rssi ? -1 : 1; //Compare the scores
                });
                $rssi = $gateways[0]->rssi;
                
                $availableFields++;
            }

            if($availableFields == 5) {                
                $sql =	'INSERT INTO lorarawttnmapperlocation SET Moment = \''.$time.'\', Lat = '.$lat.', Lon = '.$lon.', Alt = '.$alt.', Rssi = '.$rssi.', Rawid = '.$row['Id'];
                //echo $sql.'<br/>';
                mysqlquery($sql);
                $insertIdLocation = mysqli_insert_id($GLOBALS['mysqli']);
                //echo 'Insert Id: '.$insertIdLocation.'<br/>';
            }
            if(isset($dataObject->metadata->gateways)) {
                $gateways = $dataObject->metadata->gateways;
                //var_dump($gateways);
                foreach ($gateways as $gateway) {
                    $sqlGw =	'INSERT INTO lorarawttnmappergateway SET Gwid = \''.$gateway->gtw_id.'\', Lastmessage = \''.$time.'\', Lat = '.$gateway->latitude.', Lon = '.$gateway->longitude.', Alt = '.$gateway->altitude.', Ch'.$gateway->channel.' = Ch'.$gateway->channel.' + 1 ON DUPLICATE KEY UPDATE Lastmessage = \''.$time.'\', Lat = '.$gateway->latitude.', Lon = '.$gateway->longitude.', Alt = '.$gateway->altitude.', Ch'.$gateway->channel.' = Ch'.$gateway->channel.' + 1';
                    //echo $sql.'<br/>';
                    mysqlquery($sqlGw);
                    
                    $sql1 =	'SELECT * FROM lorarawttnmappergateway WHERE Gwid = \''.$gateway->gtw_id.'\'';
                    //echo $sql1;
                    $result1 = mysqlquery($sql1);
                    while ($row1 = mysqli_fetch_array($result1))
                    {
                        $sql2 =	'INSERT INTO lorarawttnmapperlocationgwrelation SET Gwid = \''.$row1['Id'].'\', Location = '.$insertIdLocation.'';
                        //echo $sql2.'<br/>';
                        mysqlquery($sql2);
                    }
                }
            }
        }
    }
    $sql3 =	'UPDATE lorarawttnmapper SET Processed = 1 WHERE Id = '.$row['Id'];
    //echo $sql3.'<br/>';
    mysqlquery($sql3);
}

?>