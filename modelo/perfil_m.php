<?php
// models/Cliente.php
function actualizarCliente($conn, $data) {
    $sql = "UPDATE clientes SET 
        nombre = ?, 
        tipo_documento = ?,
        numero_documento = ?,
        fecha_nacimiento = ?, 
        correo = ?, 
        contacto_1 = ?, 
        contacto_2 = ?, 
        direccion = ?" . (!empty($data['claveHash']) ? ", clave = ?" : "") . " 
        WHERE id = ?";

    $params = [
        $data['nombre'],
        $data['tipo_documento'],
        $data['numero_documento'],
        $data['fecha_nacimiento'],
        $data['correo'],
        $data['contacto1'],
        $data['contacto2'],
        $data['direccion']
    ];

    $types = "ssssssss";

    if (!empty($data['claveHash'])) {
        $params[] = $data['claveHash'];
        $types .= "s";
    }

    $params[] = $data['id'];
    $types .= "i";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $res;
}

?>
