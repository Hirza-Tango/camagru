<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
	<div class="container">
		<h2 class="text-center">Update details</h2>
		<div class="row justify-content-center">
			<!-- TODO: allow modify email -->
			<form action="/Controller/update_profile.php" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" value=<?php echo $_SESSION['user']['username'];?> name="username" pattern="^[a-zA-Z0-9._]{8,}$" title="Username must be at least 8 characters long and contain only lower or uppercase letters, ., _ or digits" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" value=<?php echo $_SESSION['user']['email'];?> name="email" required>
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" name="email_on_comment" <?php if($_SESSION['user']['email_on_comment'] == "1") echo "checked"; ?>>
					<label>Send me an email when someone<br>comments on my picture</label>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="update_profile">Update Profile</button>
				</div>
			</form>
		</div>
		<h2 class="text-center">Update password</h2>
		<div class="row justify-content-center">
			<form action="/Controller/update_password.php" method="post">
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Old Password" name="old_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="New Password" name="new_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirm new Password" name="confirm_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<!--TODO: javascript-level confirm password similarity-->
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="update_password">Update Password</button>
				</div>
			</form>
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>