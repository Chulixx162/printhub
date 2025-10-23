<?php
function login($conn, $data) {
    session_start();
    $correo = $data['correo'];
    $clave = $data['clave'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();

        if (password_verify($clave, $row['clave'])) {
            $_SESSION['id_usuario'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['rol'] = $row['rol'];

            $nombre = addslashes($_SESSION["nombre"]);
            $rol = addslashes($_SESSION["rol"]);
            $mensaje = "Bienvenido $nombre ($rol)";

            echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                    <script>
                        informar('$mensaje', 'ACEPTAR', '../vista/admin/vista_general.php', 'success');
                    </script>
                </body>";
            exit();
        } else {
            echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                    <script>
                        informar('CLAVE INCORRECTA, Por favor, verifica tu contraseña.', 'REINTENTAR', '../vista/admin/login_admin.php', 'warning');
                    </script>
                </body>";
            exit();
        }
    } else {
        echo "
            <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
            <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                    <script>
                        informar('USUARIO NO ENCONTRADO', 'REINTENTAR', '../vista/admin/login_admin.php', 'error');
                    </script>
                </body>";
        exit();
    }
}

function salir(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../vista/login.php");
    exit();
}

function registrar($conn, $data) {
    $clave_cifrada = password_hash($data['clave'], PASSWORD_DEFAULT);
    $sql= "INSERT INTO usuarios VALUES (NULL, '{$data['nombre']}', '{$data['UserEmail']}', '{$data['rolUsuario']}', '{$data['contacto1']}', '{$data['contacto2']}', '$clave_cifrada')";
    mysqli_query($conn, $sql);
    $_SESSION['nombre'] = $data['nombre'];
    $_SESSION['rol'] = $data['rolUsuario'];

    header("Location: ../vista/admin/usuarios.php");
}

function obtenerUsuarios($conn) {
    $result = mysqli_query($conn, "SELECT * FROM usuarios");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM usuarios WHERE id=$id");
    header("Location: ../vista/admin/usuarios.php");
}

function actualizar($conn, $data) {
    // Primero, construimos el SQL base
    $sql = "UPDATE usuarios SET nombre=?, correo=?, rol=?, contacto_1=?, contacto_2=?";
    $params = [
        $data['nombre'],
        $data['UserEmail'],
        $data['rolUsuario'],
        $data['contacto1'],
        $data['contacto2']
    ];
    $types = "sssss"; // s = string

    // Verificamos si se quiere cambiar la clave
    if (!empty($data['cambiarClave'])) {
        $sql .= ", clave=?";
        $claveHash = password_hash($data['cambiarClave'], PASSWORD_DEFAULT);
        $params[] = $claveHash;
        $types .= "s";
    }

    // Añadimos la condición WHERE
    $sql .= " WHERE id=?";
    $params[] = $data['id'];
    $types .= "i"; // i = integer

    // Preparamos la sentencia
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en prepare: " . $conn->error);
    }

    // Construimos los parámetros dinámicamente
    $stmt->bind_param($types, ...$params);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        header("Location: ../vista/admin/usuarios.php");
        exit();
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

function contarClientes($conn) {
    $sql = "SELECT COUNT(*) as total FROM clientes";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    } else {
        return 0;
    }
}


?>

