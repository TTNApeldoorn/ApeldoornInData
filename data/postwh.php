<?php
include('db.php');

if(!is_numeric($_REQUEST['temp'])) {
	die("Invalid temp parameter");
}
if(!is_numeric($_REQUEST['hu'])) {
	die("Invalid hu parameter");
}
var_dump($_REQUEST);

$sql =	'INSERT INTO measurement1 SET Moment=NOW(), Tagvalue='.$_REQUEST['temp'];
echo $sql;
$result = mysqlquery($sql);
$sql =	'INSERT INTO measurement2 SET Moment=NOW(), Tagvalue='.$_REQUEST['hu'];
//echo $sql;
$result = mysqlquery($sql);
?>