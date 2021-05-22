// @ts-nocheck
document.addEventListener("DOMContentLoaded", function() {
	'use strict';

	/* Fecha al Inicio de la Página */
	let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
	'Octubre', 'Noviembre', 'Diciembre'];
	let dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
	let dateDay = new Date().getDate();
	let dateYear = new Date().getFullYear();

	let date = new Date();

	document.querySelector('.date').append(`${dias[date.getDay()]} ${dateDay} de ${meses[date.getMonth()]} 
	de ${dateYear}`);

	/* DropDown de las Líneas de Productos */
	$('.movil-nav').on('click', function(){
		$('.line-aside').fadeToggle();
	});

	/* Total a Pagar */
	let bodyId = $("body").attr("id");

	if (bodyId == "detalles") {
		let precio = document.querySelector('#precio').value;
		let	divTotal = document.querySelector('div.totalPagar');
		let	cantidad = document.querySelector('#inputGroupSelect02');
		let	calcular = document.querySelector('#calcular'); 

		divTotal.textContent = `Total a Pagar: $${Number(precio).toLocaleString()} COP`;
		cantidad.addEventListener("change", totalPagar);

		function totalPagar(e) {
			let totalValor = Number(precio) * (cantidad.value),
				totalPagar = `Total a Pagar: $${totalValor.toLocaleString()} COP`;

			divTotal.textContent = totalPagar;

			e.preventDefault();
		}

		$('#pedido').on("submit", function (e) {
			let datos = new FormData(this); 

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
			
			fetch($(this).attr('action'), {
				method: 'POST',
				body: datos
			}).then(res => {
				Toast.fire({
					icon: 'success',
					title: 'Producto añadido al Carrito Satisfactoriamente'
				});
			})

			e.preventDefault();
		});
	}


	/* Add product to Shopping Car */
	$("button.deleteProduct").on("click", function (e) {
		let datos = new FormData();
		datos.append("idDelete", $(this).attr("id"));

		let Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			onOpen: (toast) => {
				// @ts-ignore
				toast.addEventListener('mouseenter', Swal.stopTimer)
				// @ts-ignore
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		fetch("includes/funciones/add_to_car", {
			method: 'POST',
			body: datos
		}).then(res => {
			Toast.fire({
			  	icon: 'success',
			  	title: 'Producto eliminado correctamente'
			});

			setTimeout(() => {
				window.location.href = "show_cart";
			}, 2000);
		}).catch(res => {
			Swal.fire({
			  	icon: 'error',
			  	title: 'Hubo un Error',
			  	text: 'Hubo un error!'
			});
		});

		e.preventDefault();
	});
});