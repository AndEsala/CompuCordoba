<aside class="aside-admin">
	<div class="data-user">
		<a class="button" id="main-button">
			<i class="far fa-user-circle"></i>

			<p>
				<?php echo $_SESSION['name']; ?>
			</p>
		</a>

		<div class="dropdown">
			<a href="login?sign-out=true" class="button" id="main-button">
				<i class="far fa-user-circle"></i>

				<p>
					Cerrar Sesión
				</p>
			</a>			
		</div>
	</div>


	<div class="options">
		<div class="group">
			<a href="all-lineas" class="button">
				<i class="fas fa-link"></i>

				<p>
					Líneas
				</p>
			</a>
		</div>

		<div class="group">
			<a href="all-productos" class="button">
				<i class="fas fa-laptop"></i>

				<p>
					Productos
				</p>
			</a>
		</div>

		<div class="group">
			<a href="all-orders" class="button">
				<i class="fas fa-shopping-cart"></i>

				<p>
					Pedidos
				</p>
			</a>
		</div>

		<?php if ($_SESSION['level'] === 1): ?>
			<div class="group">
				<a href="all-admins" class="button" id="main-button">
					<i class="fas fa-user-cog"></i>

					<p>
						Administradores
					</p>
				</a>
			</div>
		<?php endif ?>
	</div>
</aside>