<!DOCTYPE html>
<html lang="es-co">

<head>
	<meta charset="UTF-8">
	<title>Computadores de Córdoba</title>
	<link rel="icon" type="image/png" href="css/img/logow.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<?php
	$archivo = basename($_SERVER['PHP_SELF']);
	$page = str_replace(".php", "", $archivo);
?>

<body id="<?php echo $page; ?>">
	<div class="header">
		<div class="message-wel">
			<p>
				<i class="fas fa-user"></i>
				Bienvenido (Invitado)
			</p>
		</div>

		<div class="welcome">
			<p class="ubication">
				Montería - Colombia
				<img src="css/img/bandera.svg" alt="Bandera de Colombia" class="bandera">
			</p>

			<div class="line">
				<i class="fas fa-grip-lines-vertical"></i>
			</div>

			<div class="line">
				<p class="date"></p>
			</div>

			<div class="line">
				<i class="fas fa-grip-lines-vertical"></i>
			</div>

			<div class="button-sc">
				<a class="btn btn-outline-light btn-sm" href="show_cart">
					<i class="fas fa-shopping-cart"></i>
				</a>
			</div>
		</div>
	</div>
	<!-- Fin de Div de Bienvenida -->


	<?php
	if ($page === 'index' || $page === 'pedido' || $page === 'productos-linea') { ?>
		<!-- Inicio de Espacio de Logo y las Marcas -->
		<div class="logo-marcas">
			<div class="logo">
				<img src="css/img/logo.png" alt="Logo de Computadores de Córdoba" class="img-logo">
			</div>

			<div class="marcas">
				<div class="marca">
					<img src="css/img/amd.png" alt="Logo de AMD" class="img-marca">
				</div>

				<div class="marca">
					<img src="css/img/compaq.png" alt="Logo de Compaq" class="img-marca">
				</div>

				<div class="marca">
					<img src="css/img/hp.png" alt="Logo de HP" class="img-marca">
				</div>

				<div class="marca">
					<img src="css/img/aorus.png" alt="Logo de AORUS" class="img-marca">
				</div>
			</div>
		</div>


		<div class="header-works">
			<div class="works">
				<div>Computadores</div>

				<div>Portátiles</div>

				<div>Soporte Técnico</div>

				<div>Redes</div>
			</div>

			<div class="message-marcas">Marcas de Referencia</div>
		</div>
		<!-- Fin de Espacio de Logo y las Marcas -->
	<?php } ?>