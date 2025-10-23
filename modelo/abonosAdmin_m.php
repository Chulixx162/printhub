<?php

function registrar($conn, $data)
{
    date_default_timezone_set('America/Bogota');
    $fecha_abono = date('Y-m-d');
    $estado = 'pendiente';

    $comprobante = !empty($data['comprobante']) ? "'{$data['comprobante']}'" : "NULL";

    $sql = "INSERT INTO abonos 
           (id, id_venta, fecha, monto, metodo_pago, tipo_transferencia, observaciones, comprobante_pago, estado)
           VALUES (NULL, '{$data['id_venta']}', '$fecha_abono', '{$data['monto']}', '{$data['metodo_pago']}',
           '{$data['tipo_transferencia']}', '{$data['observaciones']}', $comprobante, '$estado')";

    mysqli_query($conn, $sql);

    echo "
        <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
        <script src='../vista/alertas/funcionesalert.js'></script>
        <body>
            <script>
                informar('SOLICITUD DE ABONO ENVIADA EXITOSAMENTE.','ACEPTAR', '../vista/admin/abonos.php', 'success');
            </script>
        </body>";
    exit();
}



function eliminar($conn, $id)
{

    mysqli_query($conn, "DELETE FROM abonos WHERE id=$id");
    header("Location: ../vista/admin/abonos.php");
}

function actualizar($conn, $data)
{
    $sql = "UPDATE abonos SET 
                estado = '{$data['estado']}',
                observaciones = '{$data['observaciones']}'";

    // Solo agregamos comprobante si existe uno nuevo
    if (!empty($data['comprobante'])) {
        $sql .= ", comprobante_pago = '{$data['comprobante']}'";
    }

    $sql .= " WHERE id = {$data['id']}";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../vista/admin/abonos.php");
}


function obtenerAbonosPorVenta($conn, $id_venta)
{
    $sql = "SELECT * FROM abonos WHERE id_venta = ? AND estado = 'aceptado'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
function obtenerabonoPorID($conn, $id)
{
    $sql = "SELECT * FROM abonos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function obtenerAbonos($conn)
{
    $sql = "SELECT a.*, 
       v.id AS venta_id, 
       v.id_cliente, 
       v.total AS total_venta, 
       v.tipo_venta AS tipo_venta,     -- Aquí ves si es online o fisica
       c.nombre AS nombre_cliente
        FROM abonos a
        JOIN ventas v ON a.id_venta = v.id
        LEFT JOIN clientes c ON c.id = v.id_cliente
        ORDER BY a.id DESC;
        ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
