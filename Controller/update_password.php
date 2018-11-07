<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$old_password = input_clean($_POST['old_password']);
$new_password = input_clean($_POST['new_password']);
$confirm_password = input_clean($_POST['confirm_password']);

if (!(isset($old_password, $new_password, $confirm_password)))
	display_error("Missing field");
else if (!preg_match('/^.{8,}/', $old_password))
	display_error("Bad password");
else if (!preg_match('/^.{8,}/', $new_password))
	display_error("Bad password");
else if (!preg_match('/^.{8,}/', $confirm_password))
	display_error("Bad password");
else if ($new_password !== $confirm_password)
	display_error("Passwords don't match");
else try {
	$sql_get_password->execute(Array(":uuid"=>$_SESSION['user']['uuid']));
	$pass = $sql_get_password->fetch(PDO::FETCH_ASSOC);
	if (!password_verify($old_password, $pass['password']))
		display_error("Wrong password");
} catch (PDOException $e) {
	display_error("Internal error. Please contact support.");
}

try {
	$sql_update_password->execute(Array(":newpass"=>password_hash($new_password, PASSWORD_BCRYPT), ":user"=>$_SESSION['user']['uuid']));
} catch (PDOException $e) {
	display_error("DEBUG: ".$e->getMessage());
}
display_status("Password Successfully updated");
header("Location: /");
?>