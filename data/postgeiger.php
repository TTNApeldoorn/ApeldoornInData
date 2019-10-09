<?php
include('db.php');

if(!is_numeric($_REQUEST['lastminute'])) {
	die("Invalid Id parameter");
}
var_dump($_REQUEST);
$sql =	'INSERT INTO measurement26 SET Moment=NOW(), Tagvalue='.$_REQUEST['lastminute'];
echo $sql;
$result = mysqlquery($sql);
$sql =	'UPDATE node SET Lastmessage=NOW() WHERE Id = 10';
echo $sql;
$result = mysqlquery($sql);
?>