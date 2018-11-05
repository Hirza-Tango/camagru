<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$username = input_clean($_POST['username']);
$email = input_clean($_POST['email']);
$password = input_clean($_POST['password']);
$confirm_password = input_clean($_POST['confirm_password']);

if (!(isset($username) && isset($email) &&
	isset($password) && isset($confirm_password)))
	display_error("Missing field");
else if (!preg_match('/^[a-zA-Z0-9._]{8,}/', $username))
	display_error($username);
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	display_error("Bad email");
else if (!preg_match('/^.{8,}/', $password))
	display_error("Bad password 1");
else if (!preg_match('/^.{8,}/', $confirm_password))
	display_error("Bad password 2");
else if ($password !== $confirm_password)
	display_error("Passwords don't match");
try {
	$sql_post_user->execute(Array(":username"=>$username, ":email"=>$email, ":password"=>password_hash($password, PASSWORD_BCRYPT)));
} catch (PDOException $e){
	#TODO: better
	display_error(var_dump($e));
}
#TODO: show status
header("Location: /");
?>