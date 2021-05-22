<?php 
  session_start();
  include "includes/templates/header.php";  

  use PayPal\Rest\ApiContext;
  use PayPal\Api\PaymentExecution;
  use PayPal\Api\Payment;
?>


<div class="contenedor">
  <h3 class='title-pedido'>Resumen del Pedido</h3>
  <?php
    if (isset($_GET['paymentId'])) {
      $paymentID = $_GET['paymentId'];
      $id_pago = $_GET['id_pago'];
      $_SESSION['id'] = $id_pago;

      require_once 'includes/config.php';

      $pago = Payment::get($paymentID, $apiContext);
      $execution = new PaymentExecution();
      $execution->setPayerId($_GET['PayerID']);

      $result = $pago->execute($execution, $apiContext);

      $answer = $result->transactions[0]->related_resources[0]->sale->state;
    }
  ?>

  <!-- <pre><?php var_dump($result); ?></pre> -->

  <?php 
    if (isset($answer)) {
      if ($answer === "completed") {
        echo "<div class='result correct'>"; 
          echo "El Pago fue Realizado Correctamente <br>";
          echo "El ID de la Transacción es $paymentID";
          echo "<a href='recibo' class='btn btn-outline-light' target='_blank'>Descargar Recibo de Compra</a>";
        echo "</div>";

        try {
          require_once 'includes/funciones/connect.php';

          $stmt = $conn->prepare("UPDATE ordenes SET payment = ? WHERE id_orden = ?");
          $pagado = 1;

          $stmt->bind_param("ii", $pagado, $id_pago);
          $stmt->execute();

          $stmt->close();
          $conn->close();
        } catch (Exception $e) {
          echo $e->getMessage();
        }
      } 
    } else {
      echo "<div class='result error'>";
        echo "El Pago no fue Realizado";
      echo "</div>";

      try {
        require_once 'includes/funciones/connect.php';

        $stmt = $conn->prepare(" DELETE FROM ordenes WHERE payment = 0 ");
        $stmt->execute();

        $stmt->close();
        $conn->close();
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      session_destroy();
    }
  ?>

  <div class="result">
    <a href="index" class="return">Regresar a la Página Principal</a>
  </div>
</div>

<?php include 'includes/templates/footer.php'; ?>