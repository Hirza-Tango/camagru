<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
$username = input_clean($_POST['username']);
$email = input_clean($_POST['email']);
$email_on_comment = intval(isset($_POST['email_on_comment']));
error_log(var_export($email_on_comment) . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/log.log");
if (!(isset($username, $email)))
	display_error("Missing field");
else if (!preg_match('/^[a-zA-Z0-9._]{8,}/', $username))
	display_error("Bad username");
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	display_error("Bad email");
try {
	$sql_update_user->execute(Array(":username"=>$username, ":email"=>$email, ":email_on_comment"=>$email_on_comment, ":user"=>$_SESSION['user']['uuid']));
} catch (PDOException $e) {
	if ($e->getCode() == 23000)
		display_error("Username or email in use");
	else
		display_error("Failed to update profile");
}
display_status("Profile Successfully updated");
$_SESSION['user']['username'] = $username;
$_SESSION['user']['email'] = $email;
$_SESSION['user']['email_on_comment'] = $email_on_comment;
header("Location: /");
?>