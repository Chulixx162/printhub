<?php
include '../modelo/carrito_m.php';
include '../conexion.php';
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'agregar') {
    agregar($_POST);
}
elseif ($accion == 'actualizar') {
    actualizar($_POST);
}
elseif ($accion == 'eliminar') {
   session_start();
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
        eliminarDelCarrito($index); // debe estar definido en el modelo
    }
    header("Location: ../vista/general/carrito.php");
    exit();
}
elseif ($accion == 'finalizar') {
    finalizar();
}
?>
