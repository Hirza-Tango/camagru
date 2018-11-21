<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$user = $_POST['user'];
$upload = $_POST['upload'];
if (!(is_uuid($user) && is_uuid($upload)))
{
	echo "0";
	error_log("Not uuid" . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/log.log");
	return;
}
try {
	$sql_delete_like->execute(Array(":upload"=>$upload, ":user"=>$user));
} catch (PDOException $e){
		echo "0";
		error_log("db error" . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/log.log");
		return;
}
echo "1";
?>