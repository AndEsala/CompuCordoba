<?php 
	session_start();
	
	if (isset($_GET['sign-out'])) {
		$signOut = $_GET['sign-out'];

		if ($signOut) {
			session_destroy();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CC | Admin</title>

	<link rel="icon" type="image/png" href="../css/img/logow.png"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
	<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
	
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="css/admin.css">
</head>
<body>
	<?php
		include_once 'templates/functions/funciones.php';
	?>
	<div class="login">
		<div class="form-login">
			<img src="../css/img/logo.png" alt="">

			<form role="form" class="save-registry-login" method="POST" action="modelos/modelo-login" page="admin" autocomplete="off">
				<div class="form-group">
					<label for="userAdmin">Usuario:</label>
					<input type="text" class="form-control" id="userLogin" name="userAdmin">
				</div>

				<div class="form-group">
					<label for="userPass">Contraseña:</label>
					<input type="password" class="form-control" id="passLogin" name="userPass">
				</div>

				<input type="hidden" name="login-admin" value="new">
				<button type="submit" class="btn btn-dark" style="width: 100%;">Iniciar Sesión</button>
			</form>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

	<script src="https://kit.fontawesome.com/69bd8d60f9.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/ajax.js"></script>	
</body>
</html>