<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
if (isset($_POST['login'])) {
	#TODO: form validation
	#TODO: HMAC
	try {
		$sql_get_login->execute(Array(":email"=>$_POST["email"], "pass"=>password_hash($_POST["password"]), ":username"=>$_POST["email"]));
		$result = $sql_get_login->fetch(PDO::FETCH_ASSOC);
		if (!empty($result))
			$_SESSION['user'] = $result;
	} catch (PDOException $p) {
		echo $p->getMessage(), PHP_EOL;
		die();
	}
}
?><!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/style.css">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="Camagru">
	<meta name="application-name" content="Camagru">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<title>Camagru</title>
</head>
<body>
	<?php echo "DEBUG:", var_dump($_SESSION['user']);?>
	<nav class="navbar navbar-dark bg-dark sticky-top">
		<a class="navbar-brand" href="/">
			<img src="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" width="40" height="40" alt="">
			Camagru
		</a>
		<?php if (!isset($_SESSION['user'])) { ?>
			<div class="row">
				<form class="form-row" action="#" method="post">
					<div class="col-auto">
						<input type="text" class="form-control" placeholder="Email or Username" name="email" required pattern="(^[a-zA-Z0-9._]{8,}$)|(^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$)">
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
				<!-- TODO: link to profile editing -->
					<a href="/profile.php">
						<p style="color:white">Hi, <b><?= $_SESSION['user']['username'];?></b></p>
					</a>
				</div>
			</div>
		<?php } ?>
	</nav>