<?php
session_start();
include '../modelo/ventaentienda_m.php';
include '../conexion.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'agregar') {
    agregar($_POST, $conn);
}
elseif ($accion == 'actualizar') {
    actualizar($_POST);
}
elseif ($accion == 'eliminar') {
    if (isset($_POST['index'])) {
        eliminarDelCarrito($_POST['index']);
    }
}
elseif ($accion == 'finalizar') {
    // Guardar datos del comprador en la sesión
    $_SESSION['comprador'] = [
        'nombre'    => $_POST['comprador'] ?? 'Sin nombre',
        'telefono'  => $_POST['telefono'] ?? 'Sin teléfono',
        'direccion' => $_POST['direccion'] ?? 'Sin dirección'
    ];

    finalizar($conn);

    exit();
}


?>
