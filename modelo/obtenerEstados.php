<?php
function hayPedidos($conn)
{
    $sql = "SELECT 1 FROM ventas WHERE estado = ? AND tipo_venta = 'online' LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $estado = "solicitado";
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $stmt->store_result();

        $hay = ($stmt->num_rows > 0);
        $stmt->close();
        return $hay;
    }

    return false;
}


function hayAtenciones($conn)
{
    $sql = "SELECT 1 FROM atencion_clientes WHERE estado = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $estado = "PE";
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $stmt->store_result();

        $hay = ($stmt->num_rows > 0);
        $stmt->close();
        return $hay;
    }

    return false;
}
function haycarrito()
{
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        return true;
    }
    return false;
}

function hayPedidosFisicos($conn){
    $sql = "SELECT 1 FROM ventas WHERE estado = ? AND tipo_venta = 'fisica' LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $estado = "solicitado";
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $stmt->store_result();

        $hay = ($stmt->num_rows > 0);
        $stmt->close();
        return $hay;
    }

    return false;
}
function hayAbonosPendientes($conn){
    $sql = "SELECT 1 FROM abonos WHERE estado = 'pendiente' LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();

        $hay = ($stmt->num_rows > 0);
        $stmt->close();
        return $hay;
    }

    return false;
}
?>