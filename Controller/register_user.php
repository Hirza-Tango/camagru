<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$username = input_clean($_POST['username']);
$email = input_clean($_POST['email']);
$password = input_clean($_POST['password']);
$confirm_password = input_clean($_POST['confirm_password']);

if (!(isset($username, $email, $password, $confirm_password)))
	display_error("Missing field");
else if (!preg_match('/^[a-zA-Z0-9._]{8,}/', $username))
	display_error("Bad Username");
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	display_error("Bad email");
else if (!preg_match('/^.{8,}/', $password))
	display_error("Bad password");
else if (!preg_match('/^.{8,}/', $confirm_password))
	display_error("Bad password");
else if ($password !== $confirm_password)
	display_error("Passwords don't match");
try {
	$sql_post_user->execute(Array(":username"=>$username, ":email"=>$email, ":password"=>password_hash($password, PASSWORD_BCRYPT)));
} catch (PDOException $e){
	if ($e->getCode() == 23000)
		display_error("User already exists");
	else
		display_error("Could not register user");
}
#TODO: send email
display_status("Registered successfully");
header("Location: /");
?>