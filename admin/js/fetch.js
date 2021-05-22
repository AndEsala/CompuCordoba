document.addEventListener("DOMContentLoaded", () => {
	'use strict'

	let Toast = Swal.mixin({
	  	toast: true,
	  	position: 'top-end',
	  	showConfirmButton: false,
	  	timer: 2000,
	  	timerProgressBar: true,
	  	onOpen: (toast) => {
	    	toast.addEventListener('mouseenter', Swal.stopTimer)
	    	toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});


	$('form.save-registry').on("submit", function(e) {
		e.preventDefault();
		let datos = new FormData(this);

		fetch($(this).attr('action'), {
			method: $(this).attr('method'),
			body: datos
		})
		.then(response => response.json())
		.then(response => {
			Toast.fire({
			  icon: 'success',
			  title: 'Registro Guardado Correctamente'
			});

			document.querySelector(".save-registry").reset();

			setTimeout(() => {
				window.location.href = $(this).attr('page');
			}, 2000);
		}).catch((response) => {
			Toast.fire({
			  	icon: 'error',
			  	title: 'Hubo un Error!'
			});
		});
	});


	/* Formulario con file */
	$('form.save-registry-file').on('submit', function(e) {
		let datos = new FormData(this);

		fetch($(this).attr('action'), {
			method: 'POST',
			body: datos
		}).then(response => {
			Toast.fire({
			  	icon: 'success',
			  	title: 'Registro Guardado Correctamente'
			});

			document.querySelector(".save-registry-file").reset();
					
			setTimeout(() => {
				window.location.href = $("form").attr('page');
			}, 2000);
		}).catch(response => {
			Swal.fire({
			  	icon: 'error',
			  	title: 'Hubo un Error',
			  	text: 'Hubo un error!'
			});
		});

		e.preventDefault();
	});


	$('.delete_rg').on("click", function(e) {
		let id = $(this).attr('data-id'),
			type = $(this).attr('data-type');

		let datos = new FormData();
		datos.append('id', id);
		datos.append('registro', 'delete');

		Swal.fire({
			title: 'Seguro que quieres Eliminar?',
			text: "El registro no se puede recuperar",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, deseo Eliminar!'
		}).then(result => {
		  	if (result.value) {
			  	fetch(`modelos/modelo-${type}`, {
			  		method: 'POST',
			  		body: datos
			  	}).then(respuesta => {
			  		Swal.fire(
				     	'Eliminado!',
				      	'El Registro ha sido Eliminado Correctamente',
				      	'success'
				    )

	  				setTimeout(() => {
						window.location.href = $("form").attr('page');
					}, 2000);
			  		}).catch(response => {
			  			Swal.fire(
					    	'Hubo un Error!',
					    	'No se pudo Eliminar el Registro',
					    	'error'
						);
		  			});
				}
			});

		e.preventDefault();
	});


	/* Login */
	$("form.save-registry-login").on("submit", function(e){
		e.preventDefault();

		var datos = $(this).serializeArray();


		fetch($(this).attr('action'), {
			method: 'POST',
			body: datos
		}).then(res => {
			Toast.fire({
			  	icon: 'success',
			  	title: 'Inicio de Sesión Correcto'
			});

			document.querySelector(".save-registry-login").reset();

			setTimeout(() => {
				window.location.href = $("form").attr('page');
			}, 2000);
		}).then(res => {
			Toast.fire({
			  	icon: 'error',
				title: 'Hubo un Error!'
			});
		});
	});	


	/* Traer toda la información de los pedidos */
	$("a.viewAllinfo").on("click", function(e) {
		let fullInfo = document.querySelector("div.modal-body ul.list-group");
		let datos = new FormData();
		let dataId = $(this).attr("data-id");
		datos.append("id", dataId);
		datos.append("registro", "view");

		fetch("modelos/modelo-orders", {
			method: 'POST',
			body: datos
		})
		.then(response => response.json())
		.then(data => {
			let productos = JSON.parse(data.Pedido);
			let producto = Object.keys(productos);
			let propertys = Object.values(productos);

			/*console.log(producto);
			console.log(propertys);

			for (var i = 0; i < propertys.length; i++) {
				console.log(producto[i] + propertys[i].cantidad);
			}*/

			var infoText = `
				<li class="list-group-item">
					<div>
						<dt>Nombre: </dt>
						<dd>${data.Nombre} ${data.Apellido}</dd>
					</div>
				</li>
				

				<li class="list-group-item">
					<div>
						<dt>Email: </dt>
						<dd>${data.Email}</dd>
					</div>
				</li>

				<li class="list-group-item">
					<div>
						<dt>Dirección: </dt>
						<dd>${data.Direccion}</dd>
					</div>
				</li>

				<li class="list-group-item">
					<div>
						<dt>Fecha de Compra: </dt>
						<dd>${data.Fecha}</dd>
					</div>
				</li>

				<li class="list-group-item">
					<div>
						<dt>Productos: </dt>
						<dd>
							<ul>
			`;

			for (var i = 0; i < propertys.length; i++) {
				/*console.log(producto[i] + propertys[i].cantidad);*/

				infoText += `
					<li>${propertys[i].cantidad} ${producto[i]}</li>
				`;
			}

			infoText += `
							</ul>
						</dd>
					</div>
				</li>

				<li class="list-group-item">
					<div>
						<dt>Total Pagado: </dt>
						<dd>$${data.Total.toLocaleString()} COP</dd>
					</div>
				</li>
			`;

			$("div.modal-body ul.list-group").html(infoText);	
		});

		e.preventDefault();
	});
});