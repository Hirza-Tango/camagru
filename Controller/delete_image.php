<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$user = $_GET['user'];
$upload = $_GET['image'];
if (!(is_uuid($user) && is_uuid($upload)))
	display_error("Something went wrong");
try {
	$sql_delete_upload->execute(Array(":upload"=>$upload, ":user"=>$user));
	unlink($_SERVER['DOCUMENT_ROOT'].'/Image/'.$upload.'.png');
} catch (PDOException $e){
	display_error("Could not delete image");
}
display_status("Successfully deleted");
header("Location: /");
?>
