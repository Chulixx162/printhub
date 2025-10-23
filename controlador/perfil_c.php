<?php
require_once '../modelo/perfil_m.php';
require_once '../conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $data['id'] = $_SESSION['id_cliente'];

    // Validar contraseña si se quiere cambiar
    if (!empty($data['cambiarClave'])) {
        if ($data['cambiarClave'] !== $data['confirmarClave']) {
            echo "
                <body>
                    <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Las contraseñas no coinciden',
                            confirmButtonText: 'Reintentar'
                        }).then(() => {
                            window.history.back();
                        });
                    </script>
                </body>
            ";
            exit();
        }
        $data['claveHash'] = password_hash($data['cambiarClave'], PASSWORD_DEFAULT);
    }

    // Llamar al modelo
    $actualizado = actualizarCliente($conn, $data);

    if ($actualizado) {
        echo "
            <body>
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Perfil actualizado!',
                        text: 'Tus datos se han guardado correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href='../vista/general/perfil.php';
                    });
                </script>
            </body>
        ";
        exit();
    } else {
        echo "
            <body>
                <script src='../libs/SweetAlert2/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo actualizar el perfil',
                        confirmButtonText: 'Reintentar'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
        ";
        exit();
    }
}
