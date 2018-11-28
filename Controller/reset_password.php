<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<?php
if (!empty($_POST))
{
	$new_password = input_clean($_POST['new_password']);
	$confirm_password = input_clean($_POST['confirm_password']);
	$token = input_clean($_POST['token']);

	if (!(isset($token, $new_password, $confirm_password)))
		display_error("Missing field");
	else if (strlen($token) != 10)
		display_error("Bad token");
	else if (!preg_match('/^(?=.*\d)[a-zA-Z\d]{8,}/', $new_password))
		display_error("Bad password");
	else if (!preg_match('/^(?=.*\d)[a-zA-Z\d]{8,}/', $confirm_password))
		display_error("Bad password");
	else if ($new_password !== $confirm_password)
		display_error("Passwords don't match");
	try {
		$sql_reset_password->execute(Array(":newpass"=>password_hash($new_password, PASSWORD_BCRYPT), ":token"=>$token));
	} catch (PDOException $e) {
		display_error("Could not reset password");
	}
	display_status("Password successfully reset. Please login with your newly-set password");
	header("Location: /");
} else if (empty($_GET['token'])) header("Location: /");
?>
	<div class="container">
		<h2 class="text-center">Reset password</h2>
		<div class="row justify-content-center">
			<form action="/Controller/reset_password.php" method="post">
				<input type="text" name="token" value=<?php echo '"',input_clean($_GET['token']),'"';?> style="display:none">
				<div class="form-group">
					<input type="password" class="form-control" placeholder="New Password" name="new_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirm new Password" name="confirm_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="update_password">Update Password</button>
				</div>
			</form>
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>