<?php

function getTabsArrayHealtyHome($payloadraw) {
    var_dump($payloadraw);
    $payload = bin2hex(base64_decode($payloadraw));
    var_dump($payload);
    $arrPayload = hexToBytes($payload);
    var_dump($arrPayload);
    $returnArray = array();
    for($i=0; $i < count($arrPayload); $i++) {
        switch($i) {
            case 1: // battery
                $accuremaining = hexdec(substr($arrPayload[$i], 0, 1));
                $returnArray['accuremaining'] = ($accuremaining / 15) * 100;
                $accuvoltage = hexdec(substr($arrPayload[$i], 1, 1));
                $returnArray['accuvoltage'] = ($accuvoltage + 25) /10;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 2: // Temperature
                $temp = hexdec($arrPayload[$i]);
                $returnArray['temperature'] = $temp - 32;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 3: // RH
                $rh = hexdec($arrPayload[$i]);
                $returnArray['humidity'] = $rh;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 4: // CO2
                $co2 = hexdec($arrPayload[$i]) * 256 + hexdec($arrPayload[$i] + 1);
                $returnArray['co2'] = $co2;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 6: // VOC
                $voc = hexdec($arrPayload[$i]) * 256 + hexdec($arrPayload[$i] + 1);
                $returnArray['voc'] = $voc;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
        }
    }
    return $returnArray;
}
function getTabsArrayPir($payloadraw) {
    var_dump($payloadraw);
    $payload = bin2hex(base64_decode($payloadraw));
    var_dump($payload);
    $arrPayload = hexToBytes($payload);
    var_dump($arrPayload);
    $returnArray = array();
    for($i=0; $i < count($arrPayload); $i++) {
        switch($i) {
            case 0: // status
                $occupied = hexdec($arrPayload[$i]);
                $returnArray['occupied'] = $occupied;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 1: // battery
                $accuremaining = hexdec(substr($arrPayload[$i], 0, 1));
                $returnArray['accuremaining'] = ($accuremaining / 15) * 100;
                $accuvoltage = hexdec(substr($arrPayload[$i], 1, 1));
                $returnArray['accuvoltage'] = ($accuvoltage + 25) /10;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 2: // Temperature
                $temp = hexdec($arrPayload[$i]);
                $returnArray['temperature'] = $temp - 32;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 3: // time
                $time = hexdec($arrPayload[$i]) * 256 + hexdec($arrPayload[$i] + 1);
                $returnArray['time'] = $time;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
            case 5: // Total motion count
                $motioncount = hexdec($arrPayload[$i]) * 256 * 256 + hexdec($arrPayload[$i] + 1) * 256 + hexdec($arrPayload[$i] + 2);
                $returnArray['motioncount'] = $motioncount;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                break;
        }
    }
    return $returnArray;
}

if(!function_exists('hexToBytes')){
    function hexToBytes($hex) {
        $bytes = array();
        echo 'Payload lenght: '.strlen($hex).'<br/>';
        for ($c = 0; $c < strlen($hex); $c += 2) {
            array_push($bytes, substr($hex, $c, 2));
        }
        return $bytes;
    }
}

?>