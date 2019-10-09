<?php

function ERSTemp($payload) {
    echo 'Payload: '.$payload.'<br/>';
    echo 'Base64: '.base64_decode($payload).'<br/>';
    echo 'Hex: '.strhex($payload).'<br/>';
}
function strhex($string) {
    $hexstr = unpack('H*', $string);
    return array_shift($hexstr);
  }

ERSTemp("AQD+AjQEAtYFBAcNSBEA");

?>