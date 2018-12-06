<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
if (isset($_POST['reset'])) {
	$email = input_clean($_POST['email']);
	if (!isset($email))
		display_error("Bad email");
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		display_error("Bad email");
	$token = bin2hex(random_bytes(5));
	try {
		$sql_invalidate_user->execute(Array(":token"=>$token, ":email"=>$email));
	} catch (PDOException $e) {
		display_error("Could not reset password");
	}
	if ($sql_invalidate_user->rowCount() < 1)
		display_error("Email not registered. Please register.");
	$message = 'This email is to reset your password. Please click <a href="http://'.$_SERVER['HTTP_HOST'].'/Controller/reset_password.php?token='.$token.'">here</a>';
	$message = wordwrap($message, 70, "\n");
	mail($email, "Camagru password reset", $message, "Content-Type: text/html; charset=UTF-8");
	display_status("Reset email sent. Please check your inbox");
	header("Location: /");
}
?>
<br>
<div class="container">
	<h4> Enter the email of the account to be reset </h4>
	<br>
	<div class="row justify-content-center">
		<form action="/forgot_password.php" method="post">
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" name="email" required>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="reset">Reset</button>
			</div>
		</form>
	</div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>
