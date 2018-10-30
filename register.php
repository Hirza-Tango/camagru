<?php
require_once('Model/sql_prepare.php');
print_r($_POST);
echo "<br>";
if (isset($_POST['login'])) {
	try {
		$sql_get_login->execute(Array(":email"=>$_POST["email"], "pass"=>$_POST["password"]));
		echo $sql_get_login->fetchAll(PDO::FETCH_ASSOC), PHP_EOL;
	} catch (PDOException $p) {
		echo $p->getMessage(), PHP_EOL;
	}
}
?><!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="shortcut icon" href="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" />
	<title>Camagru</title>
</head>

<body>
	<nav class="navbar navbar-dark bg-dark sticky-top">
		<a class="navbar-brand" href="#">
			<img src="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" width="40" height="40" alt="">
			Camagru
		</a>
		<?php if (!isset($_SESSION['user'])) { ?>
			<div class="row">
				<form class="form-row" action="#" method="post">
					<div class="col-auto">
						<input type="email" class="form-control" placeholder="Email" name="email" required>
					</div>
					<div class="col-auto">
						<input type="password" class="form-control" placeholder="Password" name="password" required pattern=".{8,}" title="Password must be at least 8 characters long">
						<a href="#">Forgotten password?</a>
					</div>
					<div class="col-auto">
						<button class="btn btn-primary" type="submit" name="login">Login</button>
					</div>
				</form>
				<div class="col-auto">
						<a href="/register.php">
							<button class="btn btn-secondary">Register</button>
						</a>
				</div>
			</div>
		<?php } else { ?>
			<div class="row">
				<div class="col-auto">
					Hi, <?= $_SESSION['name'] ?>
				</div>
			</div>
		<?php } ?>
	</nav>
	<br>
	<div class="container">
		<div class="row justify-content-center">
			<form action="Controller/register_user.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" name="username" pattern="^[a-zA-Z0-9._]{8,}$" title="Username must be at least 8 characters long and contain only lower or uppercase letters, ., _ or digits" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" placeholder="Email" name="email" required>
				</div>
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
	<footer class="navbar footer fixed-bottom">
		<div class="container">
			Copyright © 2018 | All Rights Reserved.
		</div>
	</footer>
</body>
</html>