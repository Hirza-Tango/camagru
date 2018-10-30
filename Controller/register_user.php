<?php
require_once('Model/sql_prepare.php');

function display_error($message){
	#TODO: do this properly
	header("400");
}

function input_clean($input){
	if (!isset($input))
		return $input;
	return trim(stripslashes(htmlspecialchars($data)));
}

$username = input_clean($_POST['username']);
$email = input_clean($_POST['email']);
$password = input_clean($_POST['password']);
$confirm_password = input_clean($POST['confirm_password']);

if (!(isset($username) && isset($email) &&
	isset($password) && isset($password)))
	display_error();
else if (!preg_match('/^[a-zA-Z0-9._]{8,}$/', $username))
	display_error();
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	display_error();
else if (!preg_match('/^.{8,}$/', $password))
	display_error();
else if (!preg_match('/^.{8,}$/', $confirm_password))
	display_error();
else if ($password !== $confirm_password)
	display_error();
try {
	$sql_post_user->execute(Array(":username"=>$username, ":email"=>$email, ":password"=>hash("SHA512", $password)));
	$sql_post_user->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
	#TODO: better
	die();
}



?>