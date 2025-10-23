<?php
function obtenerProductosconCategoria($conn) {
    $query = "
        SELECT p.*, c.nombre AS nombre_categoria
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function agregar($data, $conn) {
    $id = intval($data['id_producto']);
    $cantidad = intval($data['cantidad']);

    // Buscar producto en BD
    $query = "
        SELECT p.*, c.nombre AS nombre_categoria
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id
        WHERE p.id = '$id'
    ";
    $res = mysqli_query($conn, $query);
    $producto = mysqli_fetch_assoc($res);

    if (!$producto) {
        header("Location: ../vista/admin/venta_tienda.php");
        exit();
    }


    // Armar el item
    $item = [
        'id'          => $producto['id'],
        'nombre'      => $producto['nombre'],
        'precio'      => $producto['precio'],
        'categoria'   => $producto['nombre_categoria'] ?? 'Sin categoría',
        'cantidad'    => $cantidad,
        'id_categoria'=> $producto['id_categoria']
    ];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $existe = false;
    foreach ($_SESSION['carrito'] as &$prod) {
        if ($prod['id'] == $id) {
            $prod['cantidad'] += $cantidad;
            $existe = true;
            break;
        }
    }

    if (!$existe) {
        $_SESSION['carrito'][] = $item;
    }

    header("Location: ../vista/admin/venta_tienda.php");
    exit();
}

function actualizar($data) {
    $index = $data['index'];
    $cantidad = $data['cantidad'];

    if (isset($_SESSION['carrito'][$index])) {
        $_SESSION['carrito'][$index]['cantidad'] = $cantidad;
    }

    header("Location: ../vista/admin/venta_tienda.php");
    exit();
}

function eliminarDelCarrito($index) {
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }

    header("Location: ../vista/admin/venta_tienda.php");
    exit();
}

function finalizar($conn){
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');

    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        header("Location: ../vista/admin/venta_tienda.php");
        exit();
    }

    $comprador = $_SESSION['comprador'] ?? [
        'nombre'    => 'Sin nombre',
        'telefono'  => 'Sin teléfono',
        'direccion' => 'Sin dirección'
    ];

    $total = 0;
    $detalles = [];
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal = $item['precio'] * $item['cantidad'];
        $total += $subtotal;
        $detalles[] = "{$item['nombre']} (x{$item['cantidad']}) - $" . number_format($subtotal, 0, ',', '.');
    }
    $detalles_str = implode(", ", $detalles);

    // Guardar venta
    $sql = "INSERT INTO ventas (fecha, total, nombre_cliente, telefono, direccion, estado, detalles, tipo_venta) 
            VALUES (?, ?, ?, ?, ?, 'atendido', ?, 'fisica')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssss", $fecha, $total, $comprador['nombre'], $comprador['telefono'], $comprador['direccion'], $detalles_str);
    $stmt->execute();
    $stmt->close();
    unset($_SESSION['carrito']); // limpiar carrito
    echo "
        <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
        <script src='../vista/alertas/funcionesalert.js'></script>
        <body>
                <script>
                    informar('Venta realizada.','ACEPTAR', '../vista/admin/pedidos_tienda.php', 'success');
                </script>
        </body>";
        exit();
}
?>
