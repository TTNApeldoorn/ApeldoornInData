<?php
ob_start();
date_default_timezone_set('Europe/Amsterdam');
header('Content-Type: text/html; charset=iso-8859-1');
	
// loadtime
if(!function_exists("getmicrotime"))
{
	function getmicrotime() { 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
	}
}
global $footerJS;
global $time_start;
$time_start = getmicrotime();

$DBhost = "localhost";
$Dbnaam = "";
$DBuser = "";
$DBpass = "";

$mysqli = new mysqli($DBhost, $DBuser, $DBpass, $Dbnaam);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$GLOBALS['mysqli'] = $mysqli;

// Global vars
$GLOBALS['url'] = 'https://apeldoornindata.nl/';
$GLOBALS['urlimg'] = 'https://apeldoornindata.nl/images/';
$GLOBALS['urlstyle'] = 'https://apeldoornindata.nl/style/';
$GLOBALS['urljs'] = 'https://apeldoornindata.nl/js/';
$GLOBALS['urldata'] = 'https://apeldoornindata.nl/data/';

$GLOBALS['nodefilter'] = array(78, 79, 81, 82, 83, 84, 87, 120);

if(!function_exists("isequal"))
{
	function isequal($variable, $value)
	{
		if(isset($variable))
		{
			if($variable == $value)
				return true;
			else
				return false;
		}
		else
		{
			if($value == null)
				return true;
			else
				return false;
		}
	}
}
if(!function_exists("vardump"))
{
	function vardump($variable)
	{
		echo '<pre>';
		var_dump($variable);
		echo '</pre>';
	}
}

if(session_id() == '')
{
	@session_start();
}

// begin url met / 
if(isset($PATH_INFO)) 
{
	$vardata = explode('/', $PATH_INFO);
	$num_param = count($vardata);
	if($num_param % 2 == 0) 
	{
		$vardata[] = '';
		$num_param++;
	}
	for($i = 1; $i < $num_param; $i += 2) 
	{
		$$vardata[$i] = $vardata[$i+1];
	}
}
// eind url met /


/*if(!empty($_SERVER['PATH_INFO'])) 
{ 
	$_aGET = substr($_SERVER['PATH_INFO'], 1); 
	$_aGET = explode('/', $_aGET); 
}*/
if(!empty($_SERVER['REQUEST_URI'])) 
{ 
	$_aGET = explode('/', str_replace(str_replace('.php', '', $_SERVER["SCRIPT_NAME"]).'/', '', $_SERVER["REQUEST_URI"]));
}

function mysqlquery($sql)
{
	if(!isset($mysqli)) {
		$mysqli = new mysqli($GLOBALS['DBhost'], $GLOBALS['DBuser'], $GLOBALS['DBpass'], $GLOBALS['Dbnaam']);
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$GLOBALS['mysqli'] = $mysqli;
	}

	global $sqlstats;
	$starttijd = getmicrotime();
	$result = $GLOBALS['mysqli']->query($sql);
	$stoptijd = getmicrotime();
	$sqlstats['totaltime'] = $sqlstats['totaltime']+($stoptijd-$starttijd);
	if(!isset($sqlstats['totalquerys']))
	{
		$sqlstats['totalquerys']=0;
	}
	$sqlstats['totalquerys'] = $sqlstats['totalquerys']+1;
	
	$queryDuration = ($stoptijd-$starttijd);
	$queryDuration = str_pad($queryDuration, 19, '0', STR_PAD_LEFT);	
	$logString = str_replace("\n", '', str_replace("\r", '', str_replace("\t", '', str_replace("	", ' ', str_replace('    ', ' ', str_replace('    ', ' ', str_replace('   ', ' ', str_replace('   ', ' ', str_replace('  ', ' ', str_replace('  ', ' ', str_replace('      ', ' ', str_replace('   ', ' ', str_replace('  ', ' ', str_replace('  ', ' ', $sql))))))))))))));
	$logString = $queryDuration.' - '.str_replace('  ', ' ', str_replace('  ', ' ', str_replace('  ', ' ', str_replace('  ', ' ', $logString))));
	
	if($result)
	{
		//logInfo($logString);
	}
	else
	{
		logError('Mysqlquery - No Result: '.$logString);
	}	
	//$e = new Exception();
	//$trace = $e->getTrace();	
	//$sqlstats[] = array ('tijd' => $stoptijd-$starttijd, 'query' => $sql, 'caller' => $trace[1]);
	return $result;
}
mysqlquery('SET NAMES UTF8'); 

function loadingtime($time_start,$comment)
{
	global $loadingtime, $arrLoadintime;
	$tijdnu = getmicrotime();
	$arrLoadintime[] = array ('comment' => $comment, 'parttime' => $tijdnu-$loadingtime, 'totaltime' => $tijdnu-$time_start);
	$loadingtime = $tijdnu;
	return $loadingtime;
}

function logError($msg)
{
	//logToFile($_SERVER["DOCUMENT_ROOT"]."/log/".date("Ymd", time())."_error.log", $msg);
}

function logInfo($msg)
{ 
	if($_SERVER["DOCUMENT_ROOT"] != '')
	{
		logToFile($_SERVER["DOCUMENT_ROOT"]."/log/".date("Ymd", time())."_info.log", $msg);
	}
	else
	{
		logToFile('/home/openpanel-admin/sites/domotica.wiredhouse.nl/public_html'."/log/".date("Ymd", time())."_info.log", $msg);
	}
}

function logDebug($msg)
{ 
	//logToFile($_SERVER["DOCUMENT_ROOT"]."/log/".date("Ymd", time())."_debug.log", $msg);
}

function logToFile($filename, $msg)
{ 
	// open file
	$fd = fopen($filename, "a");
	
	// append date/time to message
	$str = "[" . date("Y/m/d H:i:s", time()) . "] " . $msg;	
	
	// write string
	fwrite($fd, $str . "\n");
	
	// close file
	fclose($fd);
}

function errorhandler($type, $msg, $file, $line)
{
	// log all errors

	$logtext = "Error - File: ".$file." Line: ".$line." - ";
	if(isset($_SERVER['REMOTE_ADDR'])){
		$logtext .= $_SERVER['REMOTE_ADDR'];
	}
	$logtext .= " - ".$msg." (error type ".$type.")";
	if(isset($_SERVER['HTTP_REFERER']))
	{
		$logtext .= ' Refer: '.$_SERVER['HTTP_REFERER'].' ';
	}
	if(isset($_SERVER['HTTP_USER_AGENT']))
	{
		$logtext .= ' - User Agent: '.$_SERVER['HTTP_USER_AGENT'];
	}
	if(isset($_SERVER['REQUEST_URI']))
	{
		$logtext .= ' - REQUEST_URI: '.$_SERVER["REQUEST_URI"];
	}
	logError($logtext);
	
	// if fatal error, die()
	if ($type == E_USER_ERROR)
	{
		die($msg);
	}
}

function exeptionhandler($exception)
{
	// log all errors

	$logtext = "Exeption - File: ".$exception->getFile()." - Line: ".$exception->getLine()." - Exeption: ".$exception->getMessage()." - ".$_SERVER['REMOTE_ADDR']."";
	if(isset($_SERVER['HTTP_REFERER']))
	{
		$logtext .= ' Refer: '.$_SERVER['HTTP_REFERER'].' ';
	}
	if(isset($_SERVER['HTTP_USER_AGENT']))
	{
		$logtext .= ' - User Agent: '.$_SERVER['HTTP_USER_AGENT'];
	}
	if(isset($_SERVER['REQUEST_URI']))
	{
		$logtext .= ' - REQUEST_URI: '.$_SERVER["REQUEST_URI"];
	}
	logError($logtext);
}

function aasort(&$array, $key)
{
	$sorter=array();
	$ret=array();
	reset($array);
	foreach ($array as $ii => $va) {
		$sorter[$ii]=$va[$key];
	}
	asort($sorter);
	foreach ($sorter as $ii => $va) {
		$ret[$ii]=$array[$ii];
	}
	$array=$ret;
}

// report all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

// define custom handler
set_error_handler("errorhandler");
set_exception_handler("exeptionhandler");

//header('Content-Type: text/html; charset=iso-8859-1');
header('Content-Type: text/html; charset=utf-8');
?>