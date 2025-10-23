<?php
function login($conn, $data) {
    session_start();
    $correo=$data['email'];
    $clave=$data['clave'];
    
    $stmt=$conn->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado=$stmt->get_result();

    if($resultado->num_rows===1){
        $row=$resultado->fetch_assoc();
        
        if(password_verify($clave, $row['clave'])){
            $_SESSION['id_cliente']=$row['id'];
            $_SESSION['nombre']=$row['nombre'];
            $_SESSION['correo']=$row['correo'];
            
            echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                        <script>
                            informar('Bienvenido " . addslashes($_SESSION["nombre"]) . "','ACEPTAR', '../vista/general/PaginaPrincipal.php', 'success');
                        </script>
            </body>";

            // header("Location: ../vista/general/PaginaPrincipal.php");
            exit();
        }else{
         echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                        <script>
                            informar('CLAVE INCORRECTA','REINTENTAR', '../vista/login.php', 'error');
                        </script>
            </body>";
        }
    }else{
        echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                        <script>
                            informar('CLIENTE NO ENCONTRADO','REINTENTAR', '../vista/login.php', 'warning');
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
    date_default_timezone_set('America/Bogota');
    $fecha_registro = date('Y-m-d H:i:s');
    $clave_cifrada = password_hash($data['clave'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes 
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssiiss", 
        $data['nombre'], 
        $data['tipo_documento'], 
        $data['numero_documento'], 
        $fecha_registro, 
        $data['fecha_nacimiento'], 
        $data['email'], 
        $data['contacto1'], 
        $data['contacto2'], 
        $clave_cifrada, 
        $data['direccion']
    );

    try {
    if ($stmt->execute()) {
        // Registro exitoso, guardamos en sesión
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['tipo_documento'] = $data['tipo_documento'];
        $_SESSION['numero_documento'] = $data['numero_documento'];
        $_SESSION['fecha_nacimiento'] = $data['fecha_nacimiento'];
        $_SESSION['correo'] = $data['email'];
        $_SESSION['contacto_1'] = $data['contacto1'];
        $_SESSION['contacto_2'] = $data['contacto2'];
        $_SESSION['direccion'] = $data['direccion'];
        
        echo "
        <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
        <script src='../vista/alertas/funcionesalert.js'></script>
        <body>
                <script>
                    informar('CLIENTE REGISTRADO EXITÓSAMENTE.','Ok.', '../vista/login.php', 'success');
                </script>
        </body>";
        
        exit();
    }
    } catch (mysqli_sql_exception $e) {
        // Verificamos si es error por duplicado
        if ($e->getCode() === 1062) {
            // die("Error: Ya existe un registro con este número de documento o correo electrónico.");
            
            echo "
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script src='../vista/alertas/funcionesalert.js'></script>
                <body>
                        <script>
                            informar('El Correo o el Número de Documento ya está registrado. Por favor, verifica los datos ingresados.','Ok.', '../vista/crear_cuenta.php', 'error');
                        </script>
                </body>";
        } else {
            die("Error al registrar cliente: " . $e->getMessage());
        }
        }


    $stmt->close();
}


function obtenerClientes($conn) {
    $result = mysqli_query($conn, "SELECT * FROM clientes");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function eliminar($conn, $id) {
   
    mysqli_query($conn, "DELETE FROM clientes WHERE id=$id");
    header("Location: ../vista/admin/clientes.php");
}

function actualizar($conn, $data) {
    $sql = "UPDATE clientes SET 
        nombre = ?, 
        tipo_documento = ?, 
        numero_documento = ?, 
        fecha_nacimiento = ?, 
        correo = ?, 
        contacto_1 = ?, 
        contacto_2 = ?, 
        direccion = ?";

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

    // Verificamos si se quiere cambiar la clave
    if (!empty($data['cambiarClave'])) {
        $sql .= ", clave = ?";
        $claveHash = password_hash($data['cambiarClave'], PASSWORD_DEFAULT);
        $params[] = $claveHash;
        $types .= "s";
    }

    $sql .= " WHERE id = ?";
    $params[] = $data['id'];
    $types .= "i";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    header("Location: ../vista/admin/clientes.php");
}


?>

