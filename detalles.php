<?php
	include 'includes/templates/header.php';

	$id = filter_var($_GET['data-id'], FILTER_VALIDATE_INT);
	if (!$id) {
		die('Cambio no Válido');
	}

	require_once 'includes/funciones/connect.php';
	$sql = " SELECT id_producto, nombre_producto, des_producto, img_producto, precio, descuento, id_linea, nombre_linea ";
	$sql .= " FROM productos ";
	$sql .= " INNER JOIN lineas ";
	$sql .= " ON productos.tipo_producto = lineas.id_linea ";
	$sql .= " WHERE id_producto = $id ";

	$producto = $conn->query($sql)->fetch();

	/*var_dump($producto);*/
?>

<div class="contenedor">
	<nav aria-label="breadcrumb">
	  	<ol class="breadcrumb">
	    	<li class="breadcrumb-item"><a href="index">Inicio</a></li>

	    	<li class="breadcrumb-item">
	    		<a href="productos-linea?id_linea=<?php echo $producto['id_linea']; ?>">
	    			<?php
	    				echo $producto['nombre_linea'];
	    			?>
	    		</a>
	    	</li>

	    	<li class="breadcrumb-item active" aria-current="page">
				<?php echo $producto['nombre_producto'] ?>
			</li>
	 	</ol>
	</nav>

	<div class="pedido">
		<div class="card-detalles">
			<img src="css/img/<?php echo $producto['img_producto']; ?>">
		</div>

		<div class="form-pedido">
	    	<h5 class="card-title" style="text-align: center">
				<?php echo $producto['nombre_producto']; ?>
			</h5>

	    	<div class="precios">
    			<p class="p-normal">Precio Normal: $
					<span>
						<?php echo number_format(intval($producto['precio']), 0, '.', '.'); ?></span>
				</p>

				<p class="p-descuento">
					Oferta: $
					<span>
						<?php echo number_format(intval($producto['descuento']), 0, '.', '.'); ?>
					</span>
				</p>
    		</div>

	    	<div class="card-text">
	    		<h6>Descripción:</h6>
				<pre><?php echo trim($producto['des_producto']); ?></pre>
			</div>

	    	<form action="includes/funciones/add_to_car" method="POST" id="pedido" autocomplete="off">
				<div class="input-group mb-3">
					<select class="custom-select" id="inputGroupSelect02" name="cantidad">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</div>
				
				<div class="alert alert-info totalPagar"></div>
				<input type="hidden" id="precio" value="<?php echo $producto['descuento']; ?>">
				<input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">

	    		<div class="buttons">
	    			<button type="submit" class="btn btn-warning" id="addCar">
	    				<i class="fas fa-shopping-cart"></i>
	    				Añadir al Carrito
	    			</button>
	    		</div>
	    	</form>
		</div>
	</div>
</div>

<?php include 'includes/templates/footer.php'; ?>