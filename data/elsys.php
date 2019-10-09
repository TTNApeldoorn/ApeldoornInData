<?php

function getElsysArray($payloadraw) {
    $payload = bin2hex(base64_decode($payloadraw));
    $arrPayload = hexToBytes($payload);
    $returnArray = array();
    for($i=0; $i < count($arrPayload); $i++) {
        switch($arrPayload[$i]) {
            case '01': // Temperature
                $temp = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['temperature'] = $temp / 10;
                //echo 'Temp '.$returnArray['temperature'].'<br/>';
                $i = $i + 2;
                break;
            case '02':  // Humidity
                $rh = hexdec($arrPayload[$i + 1]);
                $returnArray['humidity'] = $rh;
                //echo 'RH '.$returnArray['humidity'].'<br/>';
                $i = $i + 1;
                break;
            case '03':  // Acceleration
                $returnArray['x'] = hexdec($arrPayload[$i + 1]);
                $returnArray['y'] = hexdec($arrPayload[$i + 2]);
                $returnArray['z'] = hexdec($arrPayload[$i + 3]);
                $i = $i + 3;
                break;
            case '04':  // Light
                $light = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['light'] = $light;
                //echo 'Light '.$returnArray['light'].'<br/>';
                $i = $i + 2;
                break;
            case '05':  // Motion sensor(PIR)
                $pir = hexdec($arrPayload[$i + 1]);
                $returnArray['pir'] = $pir;
                //echo 'PIR '.$returnArray['pir'].'<br/>';
                $i = $i + 1;
                break;
            case '06':  // Co2
                $cotwo = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['co2'] = $cotwo;
                //echo 'CO2 '.$returnArray['co2'].'<br/>';
                $i = $i + 2;
                break;
            case '07':  // VDD battery
                $vdd = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['vdd'] = $vdd;
                //echo 'VDD '.$returnArray['vdd'].'<br/>';
                $i = $i + 2;
                break;
            case '08':  // Analog in 1
                $ai1 = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['ai1'] = $ai1;
                //echo 'Ai1 '.$returnArray['ai1'].'<br/>';
                $i = $i + 2;
                break;
            case '09':  // GPS
                $returnArray['lat'] = hexdec($arrPayload[$i + 1]) * 256 * 256 + hexdec($arrPayload[$i + 2]) * 256 + hexdec($arrPayload[$i + 3]);
                $returnArray['lon'] = hexdec($arrPayload[$i + 4]) * 256 * 256 + hexdec($arrPayload[$i + 5]) * 256 + hexdec($arrPayload[$i + 6]);
                //echo 'Lat '.$returnArray['lat'].'<br/>';
                //echo 'Lat '.$returnArray['lon'].'<br/>';
                $i = $i + 6;
                break;
            case '0A': // Pulse
                $temp = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['pulse'] = $temp;
                //echo 'pulse '.$returnArray['pulse'].'<br/>';
                $i = $i + 2;
                break;
            case '0B':  // Pulse input 1 absolute value
                $returnArray['pulseabs'] = hexdec($arrPayload[$i + 1]) * 256 * 256 * 256 + hexdec($arrPayload[$i + 2]) * 256 * 256 + hexdec($arrPayload[$i + 3]) * 256 + hexdec($arrPayload[$i + 4]);
                //echo 'Pulse '.$returnArray['pulseabs'].'<br/>';
                $i = $i + 4;
                break;
            case '0C': // Temperature external
                $temp = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['temperatureext'] = $temp / 10;
                //echo 'Temp '.$returnArray['temperatureext'].'<br/>';
                $i = $i + 2;
                break;   
            case '10': // IR Temperature 
                $temp = hexdec($arrPayload[$i + 1]) * 256 + hexdec($arrPayload[$i + 2]);
                $returnArray['irtempint'] = $temp / 10;
                //echo 'Temp '.$returnArray['temperatureext'].'<br/>';
                $temp = hexdec($arrPayload[$i + 3]) * 256 + hexdec($arrPayload[$i + 4]);
                $returnArray['irtempext'] = $temp / 10;
                //echo 'Temp '.$returnArray['temperatureext'].'<br/>';
                $i = $i + 4;
                break;    
            case '11':  // Occupancy
                $pir = hexdec($arrPayload[$i + 1]);
                $returnArray['occupancy'] = $pir;
                //echo 'PIR '.$returnArray['pir'].'<br/>';
                $i = $i + 1;
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