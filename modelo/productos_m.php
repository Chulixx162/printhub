<?php

function registrar($conn, $data) {
    
    $sql= "INSERT INTO productos VALUES (NULL, '{$data['id_categoria']}', '{$data['nombre']}', '{$data['imagen']}','{$data['descripcion']}','{$data['precio']}')";
    mysqli_query($conn, $sql);
    $_SESSION['nombre'] = $data['nombre'];
    

    header("Location: ../vista/admin/productos.php");
}
function obtenerProductoPorID($conn, $id) {
    $result = mysqli_query($conn, "SELECT * FROM productos wHERE id = $id");
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; // O manejar el error de otra manera
    }
}
function obtenerProductos($conn) {
    $result = mysqli_query($conn, "SELECT * FROM productos");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function obtenerCategorias($conn) {
    $result = mysqli_query($conn, "SELECT * FROM categorias");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM productos WHERE id=$id");
    header("Location: ../vista/admin/productos.php");
}

function actualizar($conn, $data) {

    // is_array($data['id_categoria']) ? $data['id_categoria'][0] :
    $id_categoria =  $data['id_categoria'];

    $sql = "UPDATE productos 
            SET 
                id_categoria = '$id_categoria', 
                nombre = '{$data['nombre']}', 
                imagen = '{$data['imagen']}', 
                descripcion = '{$data['descripcion']}', 
                precio = '{$data['precio']}'
            WHERE id = {$data['id']}";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../vista/admin/productos.php");
}

function obtenerProductosConCategorias($conn) {
    $query = "
        SELECT p.*, c.nombre AS nombre_categoria
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id
    ";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function obtenerProductosFiltrados($conn, $categoria = '', $precio = '') {
    $sql = "SELECT p.*, c.nombre AS nombre_categoria 
            FROM productos p 
            JOIN categorias c ON p.id_categoria = c.id 
            WHERE 1";

    if ($categoria != '') {
        $sql .= " AND p.id_categoria = " . intval($categoria);
    }

    if ($precio != '') {
        $sql .= " AND p.precio <= " . floatval($precio);
    }

    $resultado = mysqli_query($conn, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}



?>

