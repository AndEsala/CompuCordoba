<?php
	include_once 'modelos/sesiones.php'; 
	include_once 'templates/functions/funciones.php';
	include_once "templates/header.php";
	include_once "templates/aside.php";
?>

<section class="main">
	<h1>Pedidos</h1>

	<?php 
  		$sql = " SELECT * FROM ordenes ";
  		$sql .= " ORDER BY id_orden desc ";
  		$resultado = $conn->query($sql);
  		$pedidos = $resultado->fetch_all(MYSQLI_ASSOC);
  	?>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Información del Pedido</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<ul class="list-group"></ul>
				</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div> -->
			</div>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
	    	<tr>
	      		<th scope="col">Nombre</th>
	      		<!-- <th scope="col">Correo</th> -->
	      		<th scope="col">Dirección</th>
	      		<!-- <th scope="col">Producto</th>
	      		<th scope="col">Cantidad</th> -->
	      		<th scope="col">Total</th>
	      		<th scope="col">Acciones</th>
	    	</tr>
	  	</thead>

	  	<tbody>
	  		<?php foreach ($pedidos as $pedido) { ?>
	  		<tr>
	  		<?php if ($pedido['payment'] == 1) { ?>
	  			<td class="table-success"> 
	  		<?php } else { ?>
	  			<td class="table-danger">
	  		<?php } echo $pedido['name'] . " " . $pedido['lastName']; ?></td>
				<!-- <td><?php echo $pedido['correo']; ?></td> -->
				<td><?php echo $pedido['direction']; ?></td>
				<!-- <td><?php echo $pedido['producto']; ?></td>
				<td><?php echo $pedido['cantidad']; ?></td> -->
				<td>$<?php echo number_format($pedido['total'], 0, '.', '.'); ?> COP</td>
				<td>
					<!-- href="all-lineas?data-id=<?php echo $pedido['id_pedido']; ?>" -->
					<a class="btn btn-outline-info viewAllinfo" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo $pedido['id_orden']; ?>" data-type="modelo-orders">
						<i class="fas fa-clipboard-list"></i>
					</a>

					<!-- <a href="#" data-id="<?php echo $pedido['id_pedido']; ?>" data-type="line" class="btn btn-outline-danger delete_rg">
						<i class="fas fa-trash-alt"></i>
					</a> -->
				</td>
			</tr>
	  		<?php } ?>
	  	</tbody>
	</table>
</section>

<?php include_once "templates/footer.php" ?>