<?php
require_once('Model/sql_prepare.php');
print_r($_POST);
if (isset($_POST['login'])) {
	try {
		$sql_get_login->execute(Array(":email"=>$_POST["email"], "pass"=>$_POST["password"]));
		echo $sql_get_login->fetchAll(PDO::FETCH_ASSOC), PHP_EOL;
	} catch (PDOException $p) {
		echo $p->getMessage(), PHP_EOL;
	}
}
else if (isset($_POST['register']))
{

}
?><!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>
	.card-body img {
	    height: 100%;
    	width: 100%;
    	display: table-cell;
		vertical-align: middle;
	}
	.card-body {
		padding: 0%;
	}
	.card {
		max-width: 70vh;
	}
	</style>
	<link rel="shortcut icon" href="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" />
	<title>Camagru</title>
</head>

<body>
	<nav class="navbar navbar-dark bg-dark sticky-top">
		<a class="navbar-brand" href="#">
			<img src="https://vectr.com/hirza_tango/o1dtN6CW2P.svg" width="40" height="40" alt="">
			Camagru
		</a>
		<div class="form-row">
			<form action="index.php" method="post">
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
			
				<div class="col-auto">
					<button class="btn btn-secondary" type="submit" name="register">Register</button>
				</div>
			</form>
		</div>
	</nav>
	<div class="container">
		<div class="row justify-content-center">
			<div class="container-fluid col-lg">
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/100/300?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/300/100?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/200/300?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/300/200?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/300/300?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/100/200?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/200/200?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/100/100?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/300/300?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/200/300?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/300/200?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 mt-3 mx-auto">
					<div class="card-header">
						<img src="http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg" height="30" width="30">
						Username
					</div>
					<div class="card-body">
						<img src="https://picsum.photos/100/500?random">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-center">
								<img src="https://image.freepik.com/free-icon/heart-shape-outline_318-41940.jpg" height="30" width="30">
								96
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								7
							</div>
							<div class="col text-center">
								<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
								Share
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="navbar footer fixed-bottom">
		<div class="container">
			Copyright © 2018 | All Rights Reserved.
		</div>
	</footer>
</body>

</html>