#!/usr/bin/env php
<?php
require_once("database.php");
if ($file = file_get_contents(dirname(__FILE__)."/setup.sql"))
{
	$db->beginTransaction();
	//I use a naive preg split to work around undocumented behaviour in PDO::exec()
	//Where errors on statements after the first do not throw errors
	$stmts = preg_split('/;/', trim($file), -1, PREG_SPLIT_NO_EMPTY);
	foreach ($stmts as $s)
		try {
			//Please note: PDO::exec SHOULD NOT BE USED FOR REGULAR SQL INTERACTION
			//	It is an invitation to SQL injection attacks
			//	It is only used in this case to setup the database because the setup
			//		script only has one possible permutation at a given time
			//	Used for simplicity
			$db->exec($s);
		} catch (PDOException $e){
			$db->rollBack();
			echo "Database setup: ", $e->getMessage(), PHP_EOL;
			exit(1);
		}
	$db->commit();
}
else
	exit(print "Could not find database init script\n");
//array_map('unlink', glob(__DIR__."/../Image/*"));
@mkdir(__DIR__."/../Image");
?>
