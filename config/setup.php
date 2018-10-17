<?php
require_once("database.php");
global $DB_DSN, $DB_USER, $DB_PASSWORD;
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
	echo "Database connection: ", $e->getMessage();
	exit(1);
}
if ($file = file_get_contents(dirname(__FILE__)."/setup.sql"))
{
	//I use a naive preg split to work around undocumented behaviour in PDO::exec()
	//Where errors on statements after the first do not throw errors
	$db->beginTransaction();
	$stmts = preg_split('/;/', trim($file), -1, PREG_SPLIT_NO_EMPTY);
	foreach ($stmts as $s)
		try {
			//Please note: PDO::exec SHOULD NOT BE USED FOR REGULAR SQL INTERACTION
			//	It is an invitation to SQL injection attacks
			//	It is only used in this case to setup the database because the setup
			//		script only has one possible permutation at a given time
			//	Used for simplicity
			if ($db->exec($s) === false)
			{
				$db->rollBack();
				echo "Database setup failed";
				exit(1);
			}
		} catch (PDOException $e){
			$db->rollBack();
			echo "Database setup: ", $e->getMessage(), PHP_EOL;
			exit(1);
		}
	$db->commit();
}
else
	exit(print "Could not find database init script\n");
?>
