<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Model/sql_prepare.php");
//DEBUG:
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//END_DEBUG
ini_set('sendmail_path', '"env -i /usr/sbin/sendmail -t -i"');
ini_set('sendmail_from', 'no-reply@camagru.com');
session_start();

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

function is_uuid($s){
	if (gettype($s) != "string")
		return false;
	if (strlen($s) != 36)
		return false;
	if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $s))
		return true;
	return false;
}


?>