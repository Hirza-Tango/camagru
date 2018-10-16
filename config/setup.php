<?php
require_once("database.php");
global $DB_DSN, $DB_USER, $DB_PASSWORD;
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (throwable $t){
	echo $t->getMessage();
	return;
}
?>
