<!-- Inicio de Zona de Productos en Descuentos -->
<div class="container">
	<div class="productos-descuento">
		<!-- Aside Lateral Izquierdo -->
		<?php if ($page === "all-productos") {
		} else { ?>
			<aside class="pro-lineas">
				<div class="div-lineas">
					<div class="img-p">
						<img src="css/img/productos.png">
					</div>

					<nav class="movil-nav">
						<i class="fas fa-bars"></i>
					</nav>
				</div>

				<div class="line-aside">
					<ul class="lineas">
						<?php
						foreach ($lineas as $linea) { ?>
							<li class="linea">
								<a href="productos-linea?id_linea=<?php echo $linea['id_linea']; ?>"><?php echo $linea['nombre_linea']; ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</aside>
		<?php } ?>
		<!-- Fin del Aside Lateral  -->

		<div class="pro-descuento">
			<?php if ($page === "productos-linea") : ?>
				<?php foreach ($producto_linea as $product_line) { ?>
					<div class="card mb-3">
						<img src="css/img/<?php echo $product_line['img_producto']; ?>" class="card-img-top" alt="...">

						<div class="title">
							<h5 class="card-title"><?php echo $product_line['nombre_producto']; ?></h5>
						</div>

						<div class="card-body">
							<p class="p-normal">Precio Normal: <span><?php echo number_format(intval($product_line['precio']), 0, '.', '.'); ?></span></p>

							<p class="p-descuento">Oferta: <span><?php echo number_format(intval($product_line['descuento']), 0, '.', '.'); ?></span></p>
						</div>

						<div class="card-footer">
							<a href="detalles?data-id=<?php echo $product_line['id_producto']; ?>" id="viewMore" class="btn btn-outline-danger">Ver Más</a>
						</div>
					</div>
				<?php } ?>
			<?php else : ?>
				<?php foreach ($productos as $producto) { ?>
					<div class="card mb-3">
						<?php if ($page === "all-productos") { ?>
							<img src="../css/img/<?php echo $producto['img_producto']; ?>" class="card-img-top" alt="...">
						<?php } else { ?>
							<img src="css/img/<?php echo $producto['img_producto']; ?>" class="card-img-top" alt="...">
						<?php } ?>

						<div class="title">
							<h5 class="card-title"><?php echo $producto['nombre_producto']; ?></h5>
						</div>

						<div class="card-body">
							<p class="p-normal">Precio Normal: <span><?php echo number_format(intval($producto['precio']), 0, '.', '.'); ?></span></p>
							<p class="p-descuento">Oferta: <span><?php echo number_format(intval($producto['descuento']), 0, '.', '.'); ?></span></p>
						</div>

						<div class="card-footer">
							<?php if ($page === "all-productos") { ?>
								<a href="all-productos?data-id=<?php echo $producto['id_producto']; ?>" id="edit" class="btn btn-outline-warning">
									<i class="far fa-edit"></i>
									Editar
								</a>

								<a href="#" data-id="<?php echo $producto['id_producto']; ?>" id="viewMore" class="btn btn-outline-danger delete_rg" data-type="producto">
									<i class="fas fa-trash-alt"></i>
									Eliminar
								</a>
							<?php } else { ?>
								<a href="detalles?data-id=<?php echo $producto['id_producto']; ?>" id="viewMore" class="btn btn-outline-danger">Ver Más</a>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</div>