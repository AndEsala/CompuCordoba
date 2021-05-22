<?php 
	if (isset($_POST['registro'])) {
		if ($_POST['registro'] == "new") {
			$user = $_POST['userAdmin'];
			$name = $_POST['nameAdmin'];
			$pass = $_POST['passAdmin'];
			$level = (int) $_POST['levelAdmin'];

			$options = array(
				'cost' => 12
			);
			$hash = password_hash($pass, PASSWORD_BCRYPT, $options);

			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("INSERT INTO `admins` (user, name, level, password) VALUES(?, ?, ?, ?)");
				$stmt->bind_param("ssis", $user, $name, $level, $hash);
				$stmt->execute();

				if ($stmt->insert_id > 0) {
					$respuesta = array(
						"Respuesta" => "Correcto"
					);
				} else{
					$respuesta = array(
						"Respuesta" => "Error" 
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			die(json_encode($respuesta));
		}

		/* Actualizar Registros */
		if ($_POST['registro'] == "update") {
			$user = $_POST['userAdmin'];
			$name = $_POST['nameAdmin'];
			$pass = $_POST['passAdmin'];
			$idAdmin = $_POST['idAdmin'];		
			$level = (int) $_POST['levelAdmin'];

			try {
				include_once '../../includes/funciones/connect.php';

				if (empty($_POST['passAdmin'])) {
					$stmt = $conn->prepare("UPDATE `admins` SET user = ?, name = ?, level = ? WHERE id_admin = ?");
					$stmt->bind_param("ssii", $user, $name, $level, $idAdmin);
				} else{
					$options = array(
						'cost' => 12
					);
					$hash = password_hash($pass, PASSWORD_BCRYPT, $options);
					$stmt = $conn->prepare("UPDATE `admins` SET user = ?, name = ?, level = ?, password = ? WHERE id_admin = ?");
					$stmt->bind_param("ssisi", $user, $name, $level, $hash, $idAdmin);
				}
				$stmt->execute();

				if ($stmt->affected_rows) {
					$respuesta = array(
						"Respuesta" => "Correcto"
					);
				} else{
					$respuesta = array(
						"Respuesta" => "Error" 
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			die(json_encode($respuesta));
		}

		/* Eliminar un Registro */
		if ($_POST['registro'] == "delete") {
			$idAdmin = $_POST['id'];		

			try {
				include_once '../../includes/funciones/connect.php';

				$stmt = $conn->prepare("DELETE FROM `admins` WHERE id_admin = ?");
				$stmt->bind_param("i", $idAdmin);
				$stmt->execute();

				if ($stmt->affected_rows) {
					$respuesta = array(
						"Respuesta" => "Correcto"
					);
				} else{
					$respuesta = array(
						"Respuesta" => "Error" 
					);
				}

				$stmt->close();
				$conn->close();
			} catch (Exception $e) {
				echo "Error:" . $e->getMessage();
			}

			die(json_encode($respuesta));
		}
	}
?>