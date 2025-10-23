<?php
include '../conexion.php';
include '../modelo/abonosAdmin_m.php';
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion=='registrar') {
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
        $_POST['comprobante'] = guardar_imagen($_FILES['comprobante']);
    } else {
        $_POST['comprobante'] = null;
    }
    registrar($conn, $_POST);
}elseif ($accion == 'actualizar') {
    $abono = obtenerabonoPorID($conn, $_POST['id']);

    // Verifica si se subió una nueva comprobante
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
        $_POST['comprobante'] = guardar_imagen($_FILES['comprobante'],  $abono);
    } else {
        $_POST['comprobante'] = $abono['comprobante']; // Mantiene la imagen actual
    }

    actualizar($conn, $_POST);
}
elseif ($accion == 'eliminar') {
    $abono = obtenerabonoPorID($conn, $_GET['id']);
    eliminar_imagen( $abono);
    eliminar($conn, $_GET['id']);
}
function guardar_imagen($imagen, $abono=null) {
    eliminar_imagen($abono);
    
    $ruta = '../img/abonos/';
    $nombre_imagen = uniqid() . '-' . basename($imagen['name']);
    $ruta_completa = $ruta . $nombre_imagen;

    if (move_uploaded_file($imagen['tmp_name'], $ruta_completa)) {
        return $nombre_imagen;
    } else {
        return null; // O manejar el error de otra manera
    }
    
}

function eliminar_imagen($abono=null) {
    if ($abono) {
        if ($abono && $abono['comprobante']) {
            $ruta_existente = '../img/abonos/' . $abono['comprobante'];
            if (file_exists($ruta_existente)) {
                unlink($ruta_existente); // Elimina la imagen existente
            }
        }
    }    
}
?>