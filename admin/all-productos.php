<?php
	if (isset($_GET['data-id'])) {
	 	$id = filter_var($_GET['data-id'], FILTER_VALIDATE_INT);
		if (!$id) {
		    die("Cambio no Válido");
		}
	 } 
?>
<?php
	include_once 'modelos/sesiones.php'; 
	include_once 'templates/functions/funciones.php';
	include_once "templates/header.php";
	include_once "templates/aside.php";
?>
<section class="main">
	<!-- Zona de Creación de Líneas -->
	<div style="width: 100%;">
		<h1>Administrar Productos</h1>
		<?php if (isset($id)) { ?>
			<div class="collapse" id="collapseExample" style="display: block;">
		<?php } else{ ?>
			<p>
			  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
			    Agregar Producto
			  </a>
			</p>

			<div class="collapse" id="collapseExample">
		<?php } ?>
		  	<div class="card card-body">
				<h4>
					<?php 
						if (isset($id)) {
							echo "Eidtar Producto";
						} else {
							echo "Añadir nuevo producto";
						}
					?>
				</h4>
				
				<?php if (isset($id)) { ?>
					<form role="form" class="save-registry-file" method="POST" action="modelos/modelo-producto" enctype="multipart/form-data" page="all-productos" autocomplete="off" name="save-registry-file">
						<?php 
							$sql = " SELECT * FROM productos WHERE id_producto = $id ";
							$result = $conn->query($sql);
							$data_producto = $result->fetch_assoc();
						?>
						<div class="mb-3">
							<label for="exampleFormControlInput1">Nombre del Producto:</label>
							<input type="text" class="form-control" name="nameP" id="exampleFormControlInput1" placeholder="Nombre del Producto" value="<?php echo $data_producto['nombre_producto']; ?>">
						</div>

						<div class="mb-3">
							<label for="precioOP">Precio Original:</label>
							<input type="tel" class="form-control" name="precioOP" id="precioOP" placeholder="100000" value="<?php echo $data_producto['precio']; ?>">
						</div>

						<div class="mb-3">
							<label for="precioDP">Precio en Descuento:</label>
							<input type="tel" class="form-control" name="precioDP" id="precioDP" placeholder="80000" value="<?php echo $data_producto['descuento']; ?>">
						</div>	  	

						<div class="mb-3">
							<label for="exampleFormControlTextarea1">Descripción del Producto:</label>
							<textarea class="form-control" name="desP" id="exampleFormControlTextarea1" rows="3" style="height: 250px;">
								<?php echo $data_producto['des_producto']; ?>
							</textarea>
						</div>

						<div class="mb-3">
							<div>
								<h3>Img Actual:</h3>
								<img src="../css/img/<?php echo $data_producto['img_producto']; ?>" style="height: 150px;">
							</div>

							<label for="exampleFormControlFile1">Seleccionar Imagen:</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileP" value="<?php echo $data_producto['img_producto']; ?>">
						</div>

						<input type="hidden" name="registro" value="update">		
						<input type="hidden" name="idP" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-outline-success">Actualizar Producto</button>
					</form>
				<?php } else{ ?>
					<form role="form" class="save-registry-file" method="POST" action="modelos/modelo-producto" enctype="multipart/form-data" page="all-productos" autocomplete="off">
						<div class="mb-3">
							<label for="exampleFormControlInput1">Nombre del Producto:</label>
							<input type="text" class="form-control" name="nameP" id="exampleFormControlInput1" placeholder="Nombre del Producto">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlSelect1">Línea:</label>
							<select class="form-control" id="exampleFormControlSelect1" name="lineaP">
								<?php foreach ($lineas as $line) { ?>
									<option value="<?php echo $line['id_linea']; ?>">
										<?php echo $line['nombre_linea']; ?>
									</option>
								<?php } ?>
							</select>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1">Precio Original:</label>
							<input type="text" class="form-control" name="precioOP" id="exampleFormControlInput1" placeholder="100000">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1">Precio en Descuento:</label>
							<input type="text" class="form-control" name="precioDP" id="exampleFormControlInput1" placeholder="80000">
						</div>	  	

						<div class="mb-3">
							<label for="exampleFormControlTextarea1">Descripción del Producto:</label>
							<textarea class="form-control" name="desP" id="exampleFormControlTextarea1" rows="3" style="height: 250px;"></textarea>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlFile1">Seleccionar Imagen:</label>
							<input type="file" class="form-control-file" name="fileP" id="exampleFormControlFile1">
						</div>

						<input type="hidden" name="registro" value="new">
						<button type="submit" class="btn btn-outline-success">Añadir Producto</button>
					</form>
				<?php } ?>
		  	</div>
		</div>
	</div>

	<?php include_once "../includes/templates/productos.php"; ?>
</section>
<?php include_once "templates/footer.php" ?>