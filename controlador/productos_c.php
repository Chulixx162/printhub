<?php
include '../conexion.php';
include '../modelo/productos_m.php';
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion=='salir') {
    salir();
}
elseif ($accion=='registrar') {
    $_POST['imagen'] = guardar_imagen($_FILES['imagen']);
    registrar($conn, $_POST);

} elseif ($accion == 'actualizar') {
    $producto = obtenerProductoPorID($conn, $_POST['id']);

    // Verifica si se subió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $_POST['imagen'] = guardar_imagen($_FILES['imagen'],  $producto);
    } else {
        $_POST['imagen'] = $producto['imagen']; // Mantiene la imagen actual
    }

    actualizar($conn, $_POST);
}
elseif ($accion == 'eliminar') {
    $producto = obtenerProductoPorID($conn, $_GET['id']);
    eliminar_imagen( $producto);
    eliminar($conn, $_GET['id']);
}
function guardar_imagen($imagen, $producto=null) {
    eliminar_imagen($producto);
    
    $ruta = '../img/productos/';
    $nombre_imagen = uniqid() . '-' . basename($imagen['name']);
    $ruta_completa = $ruta . $nombre_imagen;

    if (move_uploaded_file($imagen['tmp_name'], $ruta_completa)) {
        return $nombre_imagen;
    } else {
        return null; // O manejar el error de otra manera
    }
    
}

function eliminar_imagen($producto=null) {
    if ($producto) {
        if ($producto && $producto['imagen']) {
            $ruta_existente = '../img/productos/' . $producto['imagen'];
            if (file_exists($ruta_existente)) {
                unlink($ruta_existente); // Elimina la imagen existente
            }
        }
    }    
}
?>