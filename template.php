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
						<input type="text" class="form-control" placeholder="Email" name="email">
					</div>
					<div class="col-auto">
						<input type="password" class="form-control" placeholder="Password" name="password">
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
	<!-- code goes here -->
	<footer class="navbar footer fixed-bottom">
		<div class="container">
			Copyright © 2018 | All Rights Reserved.
		</div>
	</footer>
</body>

</html>