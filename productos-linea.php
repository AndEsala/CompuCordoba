<?php 
	$id_linea = $_GET['id_linea'];
	require_once 'includes/funciones/connect.php';
	include_once 'includes/funciones/functions.php';
	include_once 'includes/templates/header.php';

/* Zona de Productos por Líneas */
	$sql = " SELECT id_producto, nombre_producto, img_producto, precio, descuento ";
	$sql .= " FROM productos ";
	$sql .= " WHERE tipo_producto = $id_linea; ";
	$producto_linea = $conn->query($sql)->fetchAll();
?>

<h2 class="name-line">
	<?php 
		$sql = " SELECT nombre_linea FROM lineas WHERE id_linea = $id_linea ";
		$linea = $conn->query($sql)->fetch();
		echo $linea['nombre_linea']; 
	?>
</h2>

<?php include "includes/templates/productos.php"; ?>

<div class="result">
	<a href="index" class="return">Regresar a la Página Principal</a>
</div>

<?php include "includes/templates/footer.php"; ?>