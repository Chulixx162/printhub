<?php

function registrar($conn, $data) {
    date_default_timezone_set('America/Bogota');
    $fecha_abono = date('Y-m-d');
    $estado = 'pendiente';
    $sql= "INSERT INTO abonos VALUES (NULL, '{$data['id_venta']}', '$fecha_abono', '{$data['monto']}', '{$data['metodo_pago']}','{$data['tipo_transferencia']}', '{$data['observaciones']}', '{$data['comprobante']}', '$estado')";
    mysqli_query($conn, $sql);
    echo "
        <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
        <script src='../vista/alertas/funcionesalert.js'></script>
        <body>
                <script>
                    informar('SOLICITUD DE ABONO ENVIADA EXITOSAMENTE.','ACEPTAR', '../vista/general/perfil.php', 'success');
                </script>
        </body>";
        
        exit();
}


function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM abonos WHERE id=$id");
    header("Location: ../vista/admin/productos.php");
}

function actualizar($conn, $data) {


    $sql = "UPDATE abonos
            SET 
                estado = '{$data['estado']}',
                observaciones = '{$data['observaciones']}'

            WHERE id = {$data['id_abono']}";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../vista/admin/abonos.php");
}

function obtenerAbonosPorVenta($conn, $id_venta) {
    $sql = "SELECT * FROM abonos WHERE id_venta = ? AND estado = 'aceptado'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}
function obtenerabonoPorID($conn, $id) {
    $sql = "SELECT * FROM abonos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

?>

