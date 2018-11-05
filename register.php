<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
	<br>
	<div class="container">
		<div class="row justify-content-center">
			<form action="/Controller/register_user.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" name="username" pattern="^[a-zA-Z0-9._]{8,}$" title="Username must be at least 8 characters long and contain only lower or uppercase letters, ., _ or digits" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" placeholder="Email" name="email" required>
				</div>
				<!-- TODO: update regex -->
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required pattern="^.{8,}$" title="Password must be at least 8 characters long">
				</div>
				<!--TODO: javascript-level confirm password similarity-->
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="register">Register</button>
				</div>
			</form>
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>