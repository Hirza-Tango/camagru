<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$username = input_clean($_POST['username']);
$email_on_comment = isset($_POST['email_on_comment']);
if (!(isset($username)))
	display_error("Missing field");
else if (!preg_match('/^[a-zA-Z0-9._]{8,}/', $username))
	display_error("Bad username");
try {
	$sql_update_user->execute(Array(":username"=>$username, ":email_on_comment"=>$email_on_comment, ":user"=>$_SESSION['user']['uuid']));
} catch (PDOException $e) {
	if ($e->getCode() == 23000)
		display_error("Username in use");
	else
		display_error("Failed to update profile");
}
display_status("Profile Successfully updated");
$_SESSION['user']['username'] = $username;
header("Location: /");
?>