<?php
class CompraModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerCompraPorId($id_venta) {
        $sql = "SELECT * FROM ventas WHERE id = $id_venta";
        $res = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($res);
    }

    public function calcularSaldoPendiente($id_venta) {
        $sqlVenta = "SELECT total FROM ventas WHERE id = $id_venta";
        $resVenta = mysqli_query($this->conn, $sqlVenta);
        $venta = mysqli_fetch_assoc($resVenta);

        $sqlAbonos = "SELECT IFNULL(SUM(valor_abono),0) as total_abonos FROM abonos WHERE id_venta = $id_venta";
        $resAbonos = mysqli_query($this->conn, $sqlAbonos);
        $rowAbonos = mysqli_fetch_assoc($resAbonos);

        $abonado = $rowAbonos['total_abonos'];
        $pendiente = $venta['total'] - $abonado;

        return [
            'total' => $venta['total'],
            'abonado' => $abonado,
            'pendiente' => $pendiente
        ];
    }
}
function obtenerVentasporId($conn, $id_venta) {
    $sql = "SELECT * FROM ventas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
// Obtener lista de abonos de una venta
function obtenerAbonosPorVenta($conn, $id_venta) {
    $sql = "SELECT * FROM abonos WHERE id_venta = ? AND estado = 'aceptado'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Obtener el total de abonos de una venta
function obtenerTotalAbonosPorVenta($conn, $id_venta) {
    $sql = "SELECT SUM(monto) AS total_abonos FROM abonos WHERE id_venta = ? AND estado = 'aceptado'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['total_abonos'] ?? 0;
}
// obtener abonos rechazados
function obtenerAbonosRechazados($conn, $id_venta) {
    $sql = "SELECT * FROM abonos WHERE id_venta = ? AND estado = 'rechazado'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}
function obtenerAbonosPendientes($conn, $id_venta) {
    $sql = "SELECT * FROM abonos WHERE id_venta = ? AND estado = 'pendiente'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>