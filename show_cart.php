<?php 
    session_start();
    include_once('includes/funciones/connect.php');
    include_once('includes/templates/header.php');

    if (array_key_exists('productos', $_SESSION)) {
        $ids = implode(', ', array_keys($_SESSION['productos']));
        $sql = " SELECT id_producto, nombre_producto, descuento FROM productos WHERE id_producto IN (?); ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $ids, PDO::PARAM_INT);
        $stmt->execute();
        $productos = $stmt->fetchAll();
?>

<div class="contenedor">
    <h2>Resumen del Pedido</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $_SESSION['carrito'] = [];
                $total = 0;
                foreach ($productos as $producto) {
                    $quantity =  $_SESSION['productos'][$producto['id_producto']];
                    $subtotal = $quantity * $producto['descuento'];
                    $total += $subtotal;

                    $_SESSION['carrito'][$producto['nombre_producto']]['cantidad'] = $quantity;
                    $_SESSION['carrito'][$producto['nombre_producto']]['precio'] = $producto['descuento'];
            ?>
                <tr>
                    <td><?php echo $producto['nombre_producto']; ?></td>
                    <td>
                        $<?php
                            echo number_format($producto['descuento'], 0, '.', '.'); 
                        ?> COP
                    </td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo number_format($subtotal, 0, '.', '.'); ?></td>
                    <td>
                        <button class="btn btn-outline-danger deleteProduct" id="<?php echo $producto['id_producto']; ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button> 
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: center">
                    <h4>
                        Total a Pagar: $<?php echo number_format($total, 0, '.', '.'); ?> COP
                    </h4>
                </th>
            </tr>
        </tfoot>
    </table>

    <form action="lend" class="orden" method="POST">
        <div class="form-group">
            <label for="name">Nombre: </label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="lastName">Apellido: </label>
            <input type="text" id="lastName" name="lastName">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico: </label>
            <input type="text" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="direction">Dirección: </label>
            <input type="text" id="direction" name="direction">
        </div>

        <input type="hidden" name="totalPagar" value="<?php echo $total; ?>">

        <button type="submit" class="btn btn-success">Realizar Pedido</button>
    </form>

<?php 
    } else {
        echo "<h2 style='text-align: center'>";
            echo "No ha añadido ningún producto";
        echo "</h2>";
    }
?>
    
    <div class="result">
        <a href="index" class="return">Regresar a la Página Principal</a>
    </div>
</div>

<?php include_once('includes/templates/footer.php'); ?>