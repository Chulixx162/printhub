<?php
    function obtenerPedidos($conn) {
        $pedidos = [];

        $sql = "SELECT id, fecha, total, id_cliente, estado, detalles FROM ventas WHERE tipo_venta = 'online' ORDER BY id DESC";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $pedidos[] = $fila;
            }
        }

        return $pedidos;
    }
    function obtenerVentaOnlineConCliente($conn) {
        $query = "
            SELECT v.*, c.nombre AS nombre_cliente
            FROM ventas v
            LEFT JOIN clientes c ON v.id_cliente = c.id
            WHERE v.tipo_venta = 'online'
            ORDER BY v.id DESC;

        ";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    function obtenerVentaFisicaConCliente($conn) {
        $query = "
            SELECT v.*, c.nombre AS nombre
            FROM ventas v
            LEFT JOIN clientes c ON v.id_cliente = c.id
            WHERE v.tipo_venta = 'fisica'
            ORDER BY v.id DESC;

        ";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
   
    function cambiarestado($conn, $data) {
        $sql = "UPDATE ventas SET estado='{$data['estado']}'  WHERE id={$data['id']}";
        mysqli_query($conn, $sql);
        if (!empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Redirección de respaldo si no hay REFERER
            header("Location: ../vista/admin/pedidos.php");
            exit();
        }

    }
    
    function borrar($conn, $id) {
    mysqli_query($conn, "DELETE FROM ventas WHERE ventas . id=$id");
    header("Location: ../vista/admin/pedidos.php");
    }
?>