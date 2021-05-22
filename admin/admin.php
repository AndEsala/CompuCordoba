<?php
	include_once 'modelos/sesiones.php';
	include_once 'templates/functions/funciones.php';
	include_once 'templates/header.php';
 	include_once 'templates/aside.php'; 
 ?>

<?php 
 	$service = " SELECT COUNT(id_orden) AS ordenes FROM ordenes ";
 	$result = $conn->query($service);
 	$pedidos = $result->fetch_assoc();

 	$sql = " SELECT total FROM ordenes WHERE payment = 1 ";
	$result = $conn->query($sql);
	$ganancias = $result->fetch_all(MYSQLI_ASSOC);

	$totalGanancias = array();
	foreach ($ganancias as $total) {
		$totalNumber = str_replace('.', '', $total);
		$totalGanancias[] = $totalNumber;
	}


	$totalG = array();
	foreach ($totalGanancias as $key) {
		foreach ($key as $value2) {
			$totalG[] = $value2;
		}
	}

	$gananciaNeta = array_sum($totalG);
?>

	<section class="main">
		<div class="bg-info card-admin">
			<div class="c-body">
				<div class="info-left">
					<h1><?php echo $pedidos['ordenes']; ?></h1>
			    	<p>Total de Compras</p>
				</div>

				<i class="fas fa-shopping-cart icon-right"></i>
			</div>

		    <div class="card-footer">
		    	<a href="all-orders" class="a-card">
		    		Ver más
		    		<i class="fas fa-arrow-circle-right"></i>
		    	</a>
		    </div>
		</div>

		<div class="bg-success card-admin">
			<div class="c-body">
				<div class="info-left">
					<h1><?php echo number_format($gananciaNeta, 0, '.', '.'); ?> COP</h1>
			    	<p>Total de Ganancias</p>
				</div>

				<i class="fas fa-file-invoice-dollar icon-right"></i>
			</div>

		    <div class="card-footer">
		    	<a href="all-orders" class="a-card">
		    		Ver más
		    		<i class="fas fa-arrow-circle-right"></i>
		    	</a>
		    </div>
		</div>
	</section>
<?php include_once "templates/footer.php"; ?>