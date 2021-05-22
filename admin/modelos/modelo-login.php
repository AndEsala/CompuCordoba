<?php 
	/* Sección del Login */
	if (isset($_POST['login-admin'])) {
		$user = $_POST['userAdmin'];
		$pass = $_POST['userPass'];
		
		try {
			include_once '../../includes/funciones/connect.php';

			$stmt = $conn->prepare("SELECT * FROM admins WHERE user = ?");
			$stmt->bind_param("s", $user);
			$stmt->execute();

			$stmt->bind_result($id_admin, $user_admin, $name_admin, $level, $pass_admin);

			if ($stmt->affected_rows) {
				$existe = $stmt->fetch();

				if ($existe) {
					if (password_verify($pass, $pass_admin)) {
						session_start();

						$_SESSION['user'] = $user_admin;
						$_SESSION['name'] = $name_admin;
						$_SESSION['level'] = $level;
						$respuesta = array(
							'Respuesta' => 'Correcto',
							'User' => $name_admin
						);
					} else{
						$respuesta = array(
							'Respuesta' => 'Error'
						);
					}
				} else{
					$respuesta = array(
						'Respuesta' => 'Error'
					);
				}
			}

			$stmt->close();
			$conn->close();
		} catch (Exception $e) {
			echo "Error:" . $e->getMessage();
		}

		die(json_encode($respuesta));
	}
?>