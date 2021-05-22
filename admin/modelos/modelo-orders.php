<?php 
	if ($_POST['registro'] == "view") {
		$id = $_POST['id'];

		include_once '../../includes/funciones/connect.php';
		try {
			$stmt = $conn->prepare(" SELECT * FROM ordenes WHERE id_orden = ? ");
			$stmt->bind_param("i", $id);
			$stmt->execute();

			$stmt->bind_result($idOrden, $name, $lastName, $email, $ubication, $date, $orden, $total, $pay);

			$exist = $stmt->fetch();

			$respuesta = array(
				"Nombre" => $name,
				"Apellido" => $lastName,
				"Email" => $email,
				"Direccion" => $ubication,
				"Fecha" => $date,
				"Pedido" => $orden,
				"Total" => $total
			);

			$stmt->close();
			$conn->close();
		} catch (Exception $e) {
			$respuesta = array(
				"Error" => "Hubo un error"
			);
		}

		echo json_encode($respuesta);
	}
?>