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
	<div style="width: 100%;">
	<?php if (isset($id)) { ?>
		<h1>Administradores</h1>
		<div class="collapse" id="collapseExample" style="display: block;">
	<?php } else { ?>
		<h1>Administradores</h1>

		<p>
			<a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
			Agregar Administrador
			</a>
		</p>

		<div class="collapse" id="collapseExample">
	<?php } ?>
			
			<div class="card card-body">
				<h4>Nuevo Administrador</h4>

				<form role="form" class="save-registry" method="POST" action="modelos/modelo-admin" page="all-admins" autocomplete="off">
				<?php if (isset($id)) { 
					$sql = " SELECT * FROM admins WHERE id_admin = $id ";
					$result = $conn->query($sql);
					$rAdmin = $result->fetch_assoc();
				?>
					<div class="mb-3">
						<label for="userAdmin" class="form-label">Usuario: </label>
						<input type="text" class="form-control" name="userAdmin" id="userAdmin" value="<?php echo $rAdmin['user']; ?>">
					</div>

					<div class="mb-3">
						<label for="nameAdmin" class="form-label">Nombre: </label>
						<input type="text" class="form-control" name="nameAdmin" id="nameAdmin" value="<?php echo $rAdmin['name']; ?>">
					</div>

					<div class="mb-3">
						<label for="passAdmin" class="form-label">Contraseña: </label>
						<input type="password" class="form-control" name="passAdmin" id="passAdmin">
					</div>

					<div class="mb-3">
						<label for="levelAdmin class="form-label"">Nivel de Administrador: </label>
						<select class="form-control" name="levelAdmin" id="levelAdmin">
							<option value="0">Standar Admin</option>
							<option value="1">Super Admin</option>
						</select>
					</div>

					<input type="hidden" name="registro" value="update">
					<input type="hidden" name="idAdmin" value="<?php echo $id; ?>">
					<button type="submit" class="btn btn-outline-success">Actualizar Datos</button>
				<?php } else { ?>
					<div class="mb-3">
						<label for="userAdmin" class="form-label">Usuario: </label>
						<input type="text" class="form-control" name="userAdmin" id="userAdmin">
					</div>

					<div class="mb-3">
						<label for="nameAdmin" class="form-label">Nombre: </label>
						<input type="text" class="form-control" name="nameAdmin" id="nameAdmin">
					</div>

					<div class="mb-3">
						<label for="passAdmin" class="form-label">Contraseña: </label>
						<input type="password" class="form-control" name="passAdmin" id="passAdmin">
					</div>

					<div class="mb-3">
						<label for="levelAdmin class="form-label"">Nivel de Administrador: </label>
						<select class="form-control" name="levelAdmin" id="levelAdmin">
							<option value="0">Standar Admin</option>
							<option value="1">Super Admin</option>
						</select>
					</div>

					<input type="hidden" name="registro" value="new">
					<button type="submit" class="btn btn-outline-success">Agregar Administrador</button>
				<?php } ?>
				</form>
			</div>									
		</div>
	</div>

	<table class="table table-striped">
		<thead>
	    	<tr>
	      		<th scope="col">Usuario</th>
	      		<th scope="col">Nombre</th>
	      		<th scope="col">Nivel</th>
	      		<th scope="col">Acciones</th>
	    	</tr>
	  	</thead>

	  	<!-- <pre>
	  		<?php var_dump($lineas); ?>
	  	</pre> -->

	  	<?php 
	  		$sql = "SELECT * FROM admins ";
	  		$resultado = $conn->query($sql);

	  		$admins = $resultado->fetch_all(MYSQLI_ASSOC);
	  	?>

	  	<tbody>
	  		<?php foreach ($admins as $admin) { ?>
	  			<tr>
					<td><?php echo $admin['user']; ?></td>
					<td><?php echo $admin['name']; ?></td>
					<td>
						<?php 
							if ($admin['level'] == 1) {
								echo "Super Admin";
							} else{
								echo "Standar Admin";
							} 
						?>
					</td>
					<td>
						<a href="all-admins?data-id=<?php echo $admin['id_admin']; ?>" class="btn btn-outline-warning">
							<i class="far fa-edit"></i>
						</a>

						<a href="#" data-id="<?php echo $admin['id_admin']; ?>" class="btn btn-outline-danger delete_rg" data-type="admin">
							<i class="fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
	  		<?php } ?>
	  	</tbody>
	</table>
</section>

<?php include_once "templates/footer.php" ?>