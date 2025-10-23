<?php

function registrar($conn, $data) {
    date_default_timezone_set('America/Bogota');
    $fecha_registro = date('Y-m-d H:i:s');
    $sql= "INSERT INTO viajeros VALUES (NULL, '{$data['nombre']}', '{$data['tipo_documento']}', '{$data['numero_documento']}','$fecha_registro','{$data['fecha_nacimiento']}','{$data['contacto1']}', '{$data['contacto2']}', '{$data['direccion']}')";
    mysqli_query($conn, $sql);
    $_SESSION['nombre'] = $data['nombre'];
    

    header("Location: ../vista/admin/circulo_viajero.php");
}

function obtenerViajeros($conn) {
    $result = mysqli_query($conn, "SELECT * FROM viajeros");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM viajeros WHERE id=$id");
    header("Location: ../vista/admin/circulo_viajero.php");
}

function actualizar($conn, $data) {
    $sql = "UPDATE viajeros SET nombre='{$data['nombre']}', tipo_de_documento='{$data['tipo_documento']}', numero_de_documento='{$data['numero_documento']}', contacto_1='{$data['contacto1']}', contacto_2='{$data['contacto2']}', direccion='{$data['direccion']}'  WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
    header("Location: ../vista/admin/circulo_viajero.php");
}

?>

