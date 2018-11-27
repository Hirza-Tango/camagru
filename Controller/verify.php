<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
$token = $_GET['token'];
if (!isset($token))
	header("Location: /");
if (strlen($token) != 10) {
?>
<p>Bad Token!</p>
<?php
	//return;
}
try {
	$sql_update_verification->execute(Array(":token"=>$token));
} catch (PDOException $e) {
?>
<p>Bad Token!</p>
<?php
	//return;
}
display_status("Successfully verified! Please log in");
header("Location: /");
?>