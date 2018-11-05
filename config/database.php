<?php
$DB_DSN = 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=dslogrov_camagru;';
$DB_USER = 'root';
$DB_PASSWORD = 'toor';
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
	echo "Database connection: ", $e->getMessage(), PHP_EOL;
	exit(1);
}
?>
