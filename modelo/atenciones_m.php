<?php
function registrar($conn, $data) {
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');
    $estado= 'PE';
    $sql= "INSERT INTO atencion_clientes VALUES (NULL, '{$data['nombre']}', '{$data['mensaje']}','$fecha','$estado', '{$data['correo']}','{$data['telefono']}'  )";
    mysqli_query($conn, $sql);
    $_SESSION['nombre'] = $data['nombre'];
        echo "
        <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
        <script src='../vista/alertas/funcionesalert.js'></script>
        <body>
                <script>
                    informar('Se envió correctamente tu mensaje, pronto nos pondremos en contacto contigo.','Ok, Muchas Gracias.', '../vista/general/contactanos.php', 'success');
                </script>
        </body>";
}

function obtenerAtenciones($conn) {
    $result = mysqli_query($conn, "SELECT * FROM atencion_clientes ORDER BY id DESC");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM atencion_clientes WHERE id=$id");
    header("Location: ../vista/admin/atencion_cliente.php");
}

function actualizar($conn, $data) {
    $sql = "UPDATE atencion_clientes SET estado='{$data['estado']}'  WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
    header("Location: ../vista/admin/atencion_cliente.php");
}

?>


