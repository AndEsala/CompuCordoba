<?php 
	if (isset($_POST['registro'])) {
		$typeRegistro = $_POST['registro'];		

		if ($typeRegistro == "new") {
			$nameLine = $_POST['newLine'];

			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("INSERT INTO lineas (nombre_linea, editado) VALUES (?, NOW())");
				$stmt->bind_param("s", $nameLine);
				$stmt->execute();

				$respuesta = array(
					'Respuesta' => 'Correcto'
				);

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			echo json_encode($respuesta);
		}

		if ($typeRegistro == "update") {
			$nameLine = $_POST['newLine'];
			$idLine = $_POST['id_line'];

			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("UPDATE lineas SET nombre_linea = ?, editado = NOW() WHERE id_linea = ?");
				$stmt->bind_param("si", $nameLine, $idLine);
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

			die(json_encode($respuesta));
		}

		if ($typeRegistro == "delete") {
			$idLine = $_POST['id'];
			
			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("DELETE FROM lineas where id_linea = ?");
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