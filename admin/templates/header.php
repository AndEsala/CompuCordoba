<!DOCTYPE html>
<html lang="es-co">
<head>
	<meta charset="UTF-8">
	<title>CC | Admin</title>
	<link rel="icon" type="image/png" href="../css/img/logow.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php 
	 	$archivo = basename($_SERVER['PHP_SELF']);
	 	$page = str_replace(".php", "", $archivo);
	?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
	<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
	
	<link rel="stylesheet" href="../css/normalize.css">

	<?php if ($page == "all-productos"): ?>
		<link rel="stylesheet" href="../css/index.css">
	<?php endif; ?>
	<link rel="stylesheet" href="css/admin.css">
</head>
<body>
	<header class="h-admin">
		<div class="logo-admin">
			<div class="container">
				<img src="../css/img/logow.png" alt="Logo de CC" class="logow">
				<h3>CompuCórdoba</h3>
			</div>
		</div>

		<div class="main-header">
			<div class="container">
				<nav class="movil-nav-admin movil-nav">
					<span></span>
					<span></span>
					<span></span>
				</nav>

				<div class="ancles">
					<a href="admin" class="btn btn-outline-dark">Página Principal</a>
				</div>

				<div class="notifi"></div>
			</div>
		</div>
	</header>
