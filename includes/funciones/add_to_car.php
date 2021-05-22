<?php 
    if (isset($_POST['producto_id'])) {
        $productoId = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];

        session_start();

        if (!array_key_exists('productos', $_SESSION)) {
            $_SESSION['productos'] = [];
        }

        if (!array_key_exists($productoId, $_SESSION['productos'])) {
            $_SESSION['productos'][$productoId] = $cantidad;
        } else {
            $_SESSION['productos'][$productoId] = $cantidad;
        }
    }

    /* if (isset($_POST['idDelete'])) {
        $idDelete = $_POST['idDelete'];

        array_splice($_SESSION['productos'], $idDelete, 1);
    } */
?>

<!-- <pre><?php var_dump($_SESSION); ?></pre> -->