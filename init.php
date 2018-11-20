<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Model/sql_prepare.php");
//DEBUG:
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//END_DEBUG
session_start();
$hmac_secret = "I can't believe it's not sodium chloride, is this a game that isn't the league of legends?";

function display_error(string $message){
	error_log($message . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/log.log");
	$_SESSION['last_error'] = $message;
	header("Location: /");
	echo '<meta http-equiv="refresh" content="0">';
	die();
}

function display_status(string $message){
	$_SESSION['last_status'] = $message;
}

function input_clean($input){
	if (!isset($input))
		return NULL;
	return trim(stripslashes(htmlspecialchars($input)));
}
?>