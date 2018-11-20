<?php
$DB_DSN = 'mysql:unix_socket=/goinfre/dslogrov/MAMP/mysql/tmp/mysql.sock;dbname=dslogrov_camagru;';
$DB_USER = 'root';
$DB_PASSWORD = 'toortoor';
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
} catch (PDOException $e){
	//echo "Database connection: ", $e->getMessage(), PHP_EOL;
	http_response_code(500);
	die();
}
?>
