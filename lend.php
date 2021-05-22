<?php 
  session_start();

  /* Name Spaces */
  use PayPal\Api\Payer;
  use PayPal\Api\Item;
  use PayPal\Api\ItemList;
  use PayPal\Api\Details;
  use PayPal\Api\Amount;
  use PayPal\Api\Transaction;
  use PayPal\Api\RedirectUrls;
  use PayPal\Api\Payment;
  use PayPal\Exception;
  require 'includes/config.php';

  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['direction'])) {
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $productos = $_SESSION['carrito'];
    $productos_json = json_encode($productos);
    $direction = $_POST['direction'];
    $total = $_POST['totalPagar'];
    $date = date("Y-m-d G:i:s");

    // Precio del Dolar Dinámico
    function convertCurrency($amount,$from_currency,$to_currency){
      $apikey = '7e44d1be0155f538cfbb';

      $from_Currency = urlencode($from_currency);
      $to_Currency = urlencode($to_currency);
      $query =  "{$from_Currency}_{$to_Currency}";

      // URL para solicitar los datos
      $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
      $obj = json_decode($json, true);

      $val = floatval($obj["$query"]);


      $total = $val * $amount;
      return number_format($total, 2, '.', '');
    }

    $totalDolar = floatval(convertCurrency($total, "COP", "USD"));

    try {
      require_once 'includes/funciones/connect.php';

      $stmt = $conn->prepare("INSERT INTO ordenes (name, lastName, email, direction, fecha, pedido, total) VALUES(?, ?, ?, ?, ?, ?, ?);");
      $stmt->bind_param("ssssssi", $name, $lastName, $email, $direction, $date, $productos_json, $total);
      $stmt->execute();

      $idRegistro = intval($stmt->insert_id);

      $stmt->close();
      $conn->close();

      } catch (Paypal\Exception $e) {
        echo "Error!" . $e->getMessage();
      }
  }

    /* Payer */
    $shopping = new Payer();
    $shopping->setPaymentMethod("paypal");

    /* Items */
    $i = 0;
    $totalToPay = (float) 0;
    $pedido = array();
    foreach ($productos as $key => $value) {
      ${"precioDolar$i"} = convertCurrency($value['precio'], "COP", "USD");
      ${"totalProductos$i"} = ${"precioDolar$i"} * $value['cantidad'];
      $totalToPay += ${"totalProductos$i"};

      ${"item$i"} = new Item();

      $pedido[] = ${"item$i"};

      ${"item$i"}->setName("$key")
                 ->setCurrency("USD")
                 ->setQuantity($value['cantidad'])
                 ->setPrice(${"precioDolar$i"});

      $i++;
    }

    /* Lista de Items */
    $itemList = new ItemList();
    $itemList->setItems($pedido);

    /* Details */
    $details = new Details();
    $details->setShipping(0)
            ->setSubTotal($totalToPay);

    /* Amount */
    $amount = new Amount();
    $amount->setCurrency("USD")
           ->setTotal($totalToPay)
           ->setDetails($details);

    /* Transaction */
    $transaction = new Transaction();
    $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Compra Computadadores de Córdoba")
                ->setInvoiceNumber($idRegistro);

    /* Redirect URLs */
    $redirect = new RedirectUrls();
    $redirect->setReturnURL(Url_Site . "/pedido?id_pago=$idRegistro")
             ->setCancelUrl(Url_Site . "/pedido?id_pago=$idRegistro");

    /* Payment */
    $payment = new Payment();
    $payment->setIntent("sale")
            ->setPayer($shopping)
            ->setRedirectUrls($redirect)
            ->setTransactions(array($transaction));

    /* Try and Catch */
    try {
      $payment->create($apiContext);
    } catch (Paypal\Exception\PayPalConnectionException $pce) {
      echo "<pre>";
        print_r(json_decode($pce->getData()));
      echo "</pre>";
    }

    $aprobado = $payment->getApprovalLink();
    header("Location: $aprobado");
?>