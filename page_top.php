<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
?><!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="/bootstrap.min.css">
	<link rel="stylesheet" href="/style.css">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<meta name="application-name" content="Camagru">
	<title>Camagru</title>
</head>
<body>
	<?php echo "DEBUG:", var_dump($_SESSION);?>
	<nav class="navbar navbar-dark bg-dark sticky-top">
		<a class="navbar-brand" href="/">
			<img src="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" width="40" height="40" alt="">
			Camagru
		</a>
		<?php if (!isset($_SESSION['user'])) { ?>
			<div class="row">
				<form class="form-row" action="/login.php" method="post">
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
					<a href="/upload.php">Upload</a>
				</div>
				<div class="col-auto">
					<a href="/profile.php">
						<p style="color:white">Hi, <b><?= $_SESSION['user']['username'];?></b></p>
					</a>
				</div>
				<a href="/logout.php">
					<button class="btn btn-secondary">Logout</button>
				</a>
			</div>
		<?php } ?>
	</nav>
	<?php if (isset($_SESSION['last_error'])) { ?>
		<div class="alert alert-danger">
			<?php echo $_SESSION['last_error']; ?>
		</div>
	<?php unset($_SESSION['last_error'], $_SESSION['last_status']);} else if (isset($_SESSION['last_status'])) { ?>
		<div class="alert alert-success">
			<?php echo $_SESSION['last_status']; ?>
		</div>
	<?php unset($_SESSION['last_status']); } ?>
	<!-- TODO: Dismissable / auto-dismiss alerts with animation -->
		