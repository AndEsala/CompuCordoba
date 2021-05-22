<?php 
  function getTemplate($info, $pedidos){
    $totalPagar = $info['total'] + 10000;

    $template = '
      <body>
        <header class="clearfix">
          <div id="logo">
            <img src="css/img/logo.png" style="width: 500px">
          </div>
          <h1>Resumen de Compra</h1>
          <!-- <div id="company" class="clearfix">
            <div>Company Name</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
          </div> -->
          <div id="project">
    ';

   $template .= '
        <div><span>Nombre: </span>' . $info['name'] . " " . $info['lastName'] . '</div>
        <div><span>Dirección: </span>' . $info['direction'] . '</div>
        <div><span>Email: </span>' . $info['email'] . '</div>
        <div><span>Fecha de Compta: </span>' . $info['fecha'] . '</div>
    ';

    $template .= '
          </div>
        </header>
        <main>
          <table>
            <thead>
              <tr>
                <th class="service">PRODUCTO</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>TOTAL</th>
              </tr>
            </thead>
            <tbody>
    ';

    foreach ($pedidos as $key => $value) {
      $totalProducto = $value["precio"] * $value["cantidad"];
      $template .= '
        <tr>
          <td class="service"> ' . $key . '</td>
          <td class="unit">$' . number_format($value['precio'], 0, '.', '.') . ' COP</td>
          <td class="qty">' . $value['cantidad'] . '</td>
          <td class="total">$' . number_format($totalProducto, 0, '.', '.') . ' COP</td>
        </tr>
      ';
    }

    $template .= '
              <tr>
                <td colspan="3">SUBTOTAL</td>
                <td class="total">$' . number_format($info['total'], 0, '.', '.') . ' COP</td>
              </tr>
              <tr>
                <td colspan="3">ENVÍO</td>
                <td class="total">$10.000 COP</td>
              </tr>
              <tr>
                <td colspan="3" class="grand total">TOTAL</td>
                <td class="grand total">$' . number_format($totalPagar, 0, '.', '.') . ' COP</td>
              </tr>
            </tbody>
          </table>
          <!-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
          </div>
        </main> -->
        <footer>
          Computadores de Córdoba 2021 &copy
        </footer>
      </body>
    '; 

    return $template;
  }
?>