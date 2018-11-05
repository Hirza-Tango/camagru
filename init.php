<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Model/sql_prepare.php");
session_start();
$hmac_secret = "I can't believe it's not sodium chloride, is this a game that isn't the league of legends?";

function display_error($message){
	#TODO: do this properly
	echo $message;
	error_log($message . PHP_EOL, 3, "log.log");
	header("Location: /");
	exit();
}

function input_clean($input){
	if (!isset($input))
		return NULL;
	return trim(stripslashes(htmlspecialchars($input)));
}
?>