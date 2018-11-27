<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
if (!isset($_POST['login']))
	display_error("Could not login");
$email = input_clean($_POST['email']);
$password = input_clean($_POST['password']);

if (!(isset($email, $password)))
	display_error("Missing field");
else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9._]{8,}/', $email))
	display_error("Bad login");
else if (!preg_match('/^.{8,}/', $password))
	display_error("Bad password");
try {
	$sql_get_login->execute(Array(":email"=>$email, ":username"=>$email));
	$result = $sql_get_login->fetch(PDO::FETCH_ASSOC);
	if (empty($result))
		display_error("Login failed. Check your username and password");
	if ($result['validation_required'] != NULL)
		display_error("Please verify your email");
	else if (password_verify($_POST['password'], $result['password']))
	{
		unset($result['password'], $result['validation_required']);
		$_SESSION['user'] = $result;
		display_status("Successfully logged in!");
	}
	else
	{
		session_unset();
		display_error("Login failed. Check your username and password");
	}
} catch (PDOException $p) {
	if ($p->code === 23000)
		display_error("User already exists");
	else
		display_error("Internal error. Please contact support.");
}
display_status("Logged in successfully");

header("Location: /");
?>