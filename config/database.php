<?php
$DB_DSN = 'mysql:unix_socket=/goinfre/dslogrov/MAMP/mysql/tmp/mysql.sock;dbname=dslogrov_camagru;';
$DB_USER = 'root';
$DB_PASSWORD = 'toortoor';
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
	echo "Database connection: ", $e->getMessage(), PHP_EOL;
	exit(1);
}
?>
