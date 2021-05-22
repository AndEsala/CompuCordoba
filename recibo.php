<?php
	require_once('includes/funciones/connect.php');
	require_once('vendor/autoload.php');
	require_once('reporte/index.php');

	session_start();
	$id = $_SESSION['id'];

	$sql = "SELECT * FROM ordenes WHERE id_orden = ($id)";
	$query = $conn->query($sql);
	$infOrden = $query->fetch_assoc();

	// Estilos CSS
	$css = file_get_contents('reporte/style.css');

	$mpdf = new \Mpdf\Mpdf([]);

	$pedido = json_decode($infOrden['pedido'], true);
	$plantilla = getTemplate($infOrden, $pedido);

	$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
	$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
	$mpdf->Output("RDP_BUY#$id.pdf", "D");

	session_destroy();
?>