 <?php
	require_once 'connect.php';

 	$archivo = basename($_SERVER['PHP_SELF']);
 	$page = str_replace(".php", "", $archivo);

 	/* Líneas de la Base de Datos */
	try {
		$sql = " SELECT * FROM lineas";
		$lineas = $conn->query($sql)->fetchAll();
	} catch (Exception $e) {
		var_dump($e -> getMessage());
	}
	
	/* Productos de la Base de Datos */
	try {
		$sql = " SELECT * FROM productos ";
		$sql .= " ORDER BY id_producto desc ";

		if ($page === "index") { 
			$sql .= " LIMIT 9 ";	
		} else {}
		$productos = $conn->query($sql)->fetchAll();
	} catch (Exception $e) {
		var_dump($e->getMessage());
	}
 ?>