<?php 
	if (isset($_POST['registro'])) {
		if ($_POST['registro'] == "new") {
			$nameP = $_POST['nameP'];
			$lineaP = $_POST['lineaP'];
			$precioOP = $_POST['precioOP'];
			$precioDP = $_POST['precioDP'];
			$desP = $_POST['desP'];

			$directory = "../../css/img/";

			if (is_dir($directory) == false) {
				mkdir($directory, 0755, true);
			}

			if (move_uploaded_file($_FILES['fileP']['tmp_name'], $directory . $_FILES['fileP']['name'])){
				$img_url = $_FILES['fileP']['name'];
				$img_result = "Se Subió Correctamente";
			} else{
				$respuesta = array(
					'Respuesta' => error_get_last()
				);
			}

			try {
				include_once '../../includes/funciones/connect.php';
				
				$stmt = $conn->prepare(" INSERT INTO productos (nombre_producto, des_producto, tipo_producto, img_producto, precio, descuento) VALUES (?, ?, ?, ?, ?, ?) ");
				$stmt->bind_param("ssssss", $nameP, $desP, $lineaP, $img_url, $precioOP, $precioDP);
				$stmt->execute();

				if ($stmt->insert_id > 0) {
					$respuesta = array(
						"Respuesta" => "Correcto"
					);
				} else{
					$respuesta = array(
						"Respuesta" => 'Error'
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			die(json_encode($respuesta));
		}

		if ($_POST['registro'] == "update") {
			$nameP = $_POST['nameP'];
			$precioOP = $_POST['precioOP'];
			$precioDP = $_POST['precioDP'];
			$desP = $_POST['desP'];
			$idProducto = (int) $_POST['idP'];

			$directory = "../../css/img/";

			if (is_dir($directory) == false) {
				mkdir($directory, 0755, true);
			}

			if (move_uploaded_file($_FILES['fileP']['tmp_name'], $directory . $_FILES['fileP']['name'])){
				$img_url = $_FILES['fileP']['name'];
			} else{
				$respuesta = array(
					'Respuesta' => error_get_last()
				);
			}

			try {
				require_once '../../includes/funciones/connect.php';
				
				if ($_FILES['fileP']['size'] > 0) {
					$stmt = $conn->prepare(" UPDATE productos SET nombre_producto = ?, des_producto = ?, img_producto = ?, precio = ?, descuento = ? WHERE id_producto = ? ");
					$stmt->bind_param("sssssi", $nameP, $desP, $img_url, $precioOP, $precioDP, $idProducto);
				} else{
					$stmt = $conn->prepare(" UPDATE productos SET nombre_producto = ?, des_producto = ?, precio = ?, descuento = ? WHERE id_producto = ?" );
					$stmt->bind_param("ssssi", $nameP, $desP, $precioOP, $precioDP, $idProducto);
				}

				$stmt->execute();

				if ($stmt->affected_rows) {
					$respuesta = array(
						"Respuesta" => "Correcto"
					);
				} else{
					$respuesta = array(
						"Respuesta" => 'Error'
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			die(json_encode($respuesta));
		}

		if ($_POST['registro'] == "delete") {
			$idLine = $_POST['id'];
			
			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("DELETE FROM productos where id_producto = ?");
				$stmt->bind_param("i", $idLine);
				$stmt->execute();

				if ($stmt->affected_rows) {
					$respuesta = array(
						'Respuesta' => 'Correcto'
					);
				}else{
					$respuesta = array(
						'Respuesta' => 'Error'
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			echo json_encode($respuesta);
		}
	}
?>