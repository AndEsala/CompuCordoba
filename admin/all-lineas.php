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
		<h1>Administrar Líneas</h1>
		<?php if (isset($id)) { ?>
			<div class="collapse" id="collapseExample" style="display: block;">
		<?php } else{ ?>
			<p>
			  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
			    Agregar Línea
			  </a>
			</p>

			<div class="collapse" id="collapseExample">
		<?php } ?>

		  <div class="card card-body">
			<h4>
				<?php 
					if (isset($id)) {
						echo "Editar Línea";
					} else{
						echo "Añadir línea";
					}
				?>
			</h4>

			<form style="width: 100%" class="save-registry" method="POST" action="modelos/modelo-line" page="all-lineas" autocomplete="off">
		    <?php if (isset($id)) { ?>
		    	<?php 
		    		$sql = " SELECT * FROM lineas WHERE id_linea = {$id} ";
		    		$result = $conn->query($sql);

		    		$lineUp = $result->fetch_assoc();
		    	?>
				<div class="mb-3" style="width: 100%">
					<label for="newLine" class="form-label">Nuevo nombre de línea</label>
					<input type="text" class="form-control" id="newLine" name="newLine" value="<?php echo $lineUp['nombre_linea']; ?>" required>
				</div>

				<input type="hidden" name="registro" value="update">
				<input type="hidden" name="id_line" value="<?php echo $lineUp['id_linea']; ?>">
				<button type="submit" class="btn btn-outline-success">Actualizar Registro</button>
		    <?php } else { ?>
				<div class="mb-3" style="width: 100%">
					<label for="newLine" class="form-label">Crear Nueva Línea</label>
					<input type="text" class="form-control" id="newLine" name="newLine" required>
				</div>

				<input type="hidden" name="registro" value="new">
				<button type="submit" class="btn btn-outline-success">Agregar Nueva Línea</button>
		    <?php } ?>
			</form>
		  </div>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
	    	<tr>
	      		<th scope="col">Nombre de la Línea</th>
	      		<th scope="col">Acciones</th>
	    	</tr>
	  	</thead>

	  	<!-- <pre>
	  		<?php var_dump($lineas); ?>
	  	</pre> -->

	  	<tbody>
	  		<?php foreach ($lineas as $linea) { ?> 
	  		<tr>
				<td><?php echo $linea['nombre_linea']; ?></td>
				<td>
					<a href="all-lineas?data-id=<?php echo $linea['id_linea']; ?>" class="btn btn-outline-warning">
						<i class="far fa-edit"></i>
					</a>

					<a href="#" data-id="<?php echo $linea['id_linea']; ?>" data-type="line" class="btn btn-outline-danger delete_rg">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
	  		<?php } ?>
	  	</tbody>
	</table>
</section>
<?php include_once "templates/footer.php" ?>