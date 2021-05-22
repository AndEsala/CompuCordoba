$(document).ready(function() {
	$("form.save-registry").on("submit", function(e){
		e.preventDefault();

		var datos = $(this).serializeArray();

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data){
				var result = data;
				const Toast = Swal.mixin({
				  toast: true,
				  position: 'top-end',
				  showConfirmButton: false,
				  timer: 2000,
				  timerProgressBar: true,
				  onOpen: (toast) => {
				    toast.addEventListener('mouseenter', Swal.stopTimer)
				    toast.addEventListener('mouseleave', Swal.resumeTimer)
				  }
				})

				if (result.Respuesta == "Correcto") {
					Toast.fire({
					  icon: 'success',
					  title: 'Registro Guardado Correctamente'
					});

					document.querySelector(".save-registry").reset();

					setTimeout(() => {
						window.location.href = $("form").attr('page');
					}, 2000);
				} else{
					Toast.fire({
					  icon: 'error',
					  title: 'Hubo un Error!'
					})
				}
			}
		})
	});


	/* Formulario de Login */
	$("form.save-registry-login").on("submit", function(e){
		e.preventDefault();

		var datos = $(this).serializeArray();

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data){
				var result = data;
				const Toast = Swal.mixin({
				  toast: true,
				  position: 'top-end',
				  showConfirmButton: false,
				  timer: 2000,
				  timerProgressBar: true,
				  onOpen: (toast) => {
				    toast.addEventListener('mouseenter', Swal.stopTimer)
				    toast.addEventListener('mouseleave', Swal.resumeTimer)
				  }
				})

				if (result.Respuesta == "Correcto") {
					Toast.fire({
					  icon: 'success',
					  title: 'Inicio de Sesión Correcto'
					});

					document.querySelector(".save-registry-login").reset();

					setTimeout(() => {
						window.location.href = $("form").attr('page');
					}, 2000);
				} else{
					Toast.fire({
					  icon: 'error',
					  title: 'Hubo un Error!'
					})
				}
			}
		})
	});

	/* Formulario donde Existe un File */
	$('form.save-registry-file').on('submit', function(e){
		e.preventDefault();

		var datos = new FormData(this);

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			contentType: false,
			processData: false,
			async: true,
			cache: false,
			success: function(data){
				console.log(data);
				var result = data;

				const Toast = Swal.mixin({
				  toast: true,
				  position: 'top-end',
				  showConfirmButton: false,
				  timer: 2000,
				  timerProgressBar: true,
				  onOpen: (toast) => {
				    toast.addEventListener('mouseenter', Swal.stopTimer)
				    toast.addEventListener('mouseleave', Swal.resumeTimer)
				  }
				})

				if (result.Respuesta == 'Correcto') {
					Toast.fire({
					  icon: 'success',
					  title: 'Registro Guardado Correctamente'
					});

					document.querySelector(".save-registry-file").reset();
					
					setTimeout(() => {
						window.location.href = $("form").attr('page');
					}, 2000);
				}else{
					Swal.fire({
					  icon: 'error',
					  title: 'Hubo un Error',
					  text: 'Hubo un error!'
					})
				}
			}
		})
	});

	$('.delete_rg').on('click', function(e){
		e.preventDefault();

		var id = $(this).attr('data-id'),
			type = $(this).attr('data-type');

		Swal.fire({
			title: 'Seguro que quieres Eliminar?',
			text: "El registro no se puede recuperar",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, deseo Eliminar!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		  		type: 'post',
		  		data: {
		  			'id': id,
		  			'registro': 'delete'
		  		},
		  		url: `modelos/modelo-${type}`,
		  		success: function(data){
		  			var resultado = data;

		  			console.log(resultado);
		  			if (resultado == '{"Respuesta":"Correcto"}') {
		  				Swal.fire(
					      'Eliminado!',
					      'El Registro ha sido Eliminado Correctamente',
					      'success'
					    );

		  				setTimeout(() => {
							window.location.href = $("form").attr('page');
						}, 2000);
		  			} else{
		  				Swal.fire(
					      'Hubo un Error!',
					      'No se pudo Eliminar el Registro',
					      'error'
					    )
		  			}
		  		}
		  	})
		  }
		})
	})
})