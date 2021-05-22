<!-- <?php
	session_start();

	$name = $_POST['name'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$direction = $_POST['direction'];
	$productos = $_SESSION['carrito'];
	$total = $_POST['totalPagar'];

	$datos = array(
		"Nombre" => "$name $lastName",
		"Email" => $email,
		"Dirección" => $direction,
		"Productos" => $productos,
		"Total a Pagar" => $total
	);

	foreach ($productos as $key => $value) {
		echo "<p>$key</p>";
		echo "<p>";
			echo $value['precio'];
		echo "</p>";
	}
?> -->

<!-- <pre>
	<?php var_dump($datos); ?>
</pre> -->


<?php
	require_once('includes/funciones/connect.php');
	require_once('vendor/autoload.php');
	require_once('reporte/index.php');

	/*echo "<pre>";
		var_dump(json_decode($infOrden['pedido'], true));
	echo "</pre>";*/

	/*foreach ($pedido as $key => $value) {
		echo $value['precio'] . "<br>";
	}
	die();*/

	// Estilos CSS
	$css = file_get_contents('reporte/style.css');

	$mpdf = new \Mpdf\Mpdf([]);

	$pedido = json_decode($infOrden['pedido'], true);
	$plantilla = getTemplate($infOrden, $pedido);

	$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
	$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
	$mpdf->Output();
?>