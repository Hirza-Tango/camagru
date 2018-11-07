<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
if (isset($_POST['login'])) {
	#TODO: form validation
	#TODO: HMAC
	#TODO: move this
	try {
		$sql_get_login->execute(Array(":email"=>$_POST["email"], ":username"=>$_POST["email"]));
		$result = $sql_get_login->fetch(PDO::FETCH_ASSOC);
		if (empty($result))
			display_error("Login failed. Check your username and password");
		else if (password_verify($_POST['password'], $result['password']))
		{
			unset($result['password']);
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
}
header("Location: /");
?>