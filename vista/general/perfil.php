<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../../conexion.php';
include '../../modelo/ventas_m.php';

// Datos del cliente
$id = $_SESSION['id_cliente'];
$stmt = $conn->prepare("SELECT nombre, tipo_documento, numero_documento, fecha_nacimiento, correo, contacto_1, contacto_2, direccion FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();

// Compras del cliente
$stmt2 = $conn->prepare("SELECT * FROM ventas WHERE id_cliente = ? ORDER BY id DESC");
$stmt2->bind_param("i", $id);
$stmt2->execute();
$compras = $stmt2->get_result();

// Estadísticas simples
$total_compras = $compras->num_rows;
$total_gastado = 0;
while ($row = $compras->fetch_assoc()) {
    $total_gastado += $row['total'];
}
$compras->data_seek(0); // Reset result pointer para usar en tabla
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - JYS</title>
    <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
    <style>
        body {
            background: #f5f7fa;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .btn-floating {
            position: fixed;
            bottom: 20px;
            left: 20px;
            border-radius: 50px;
            padding: 12px 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .profile-header {
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            border-radius: 15px;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-header h2 {
            font-weight: 700;
        }

        .stats-card {
            background: #fff;
            color: #333;
        }

        .stats-card .icon {
            font-size: 2rem;
            padding: 15px;
            border-radius: 50%;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .icon-total {
            background-color: #007BFF;
        }

        .icon-gastado {
            background-color: #28A745;
        }

        .icon-compras {
            background-color: #FFC107;
        }

        .table thead {
            background-color: #007BFF;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
    </style>
</head>

<body>
    <!-- Botón flotante -->
    <button onclick="window.location.href='PaginaPrincipal.php';" class="btn btn-primary btn-floating">
        <i class="fas fa-arrow-left me-2"></i> Volver
    </button>

    <div class="container py-5">
        <!-- Perfil header -->
        <div class="profile-header text-center">
            <h2><i class="fas fa-user-circle me-2"></i><?php echo $cliente['nombre']; ?></h2>
            <p><?php echo $cliente['correo']; ?></p>
            <!-- Botón para abrir modal -->
            <button type="button" class="btn btn-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                <i class="fas fa-edit me-1"></i> Editar Perfil
            </button>
            <!-- Modal para editar perfil -->
            <div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="../../controlador/perfil_c.php?accion=actualizar">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editarPerfilLabel">Editar Perfil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-black">
                                <input type="hidden" name="id" value="<?= $_SESSION['id_cliente'] ?>">

                                <div class="mb-3">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="<?= $cliente['nombre'] ?>" required>
                                    <hr>
                                </div>
                                <div class="mb-3">
                                    <label>Número de Documento</label>
                                    <input type="text" class="form-control" readonly name="numero_documento" value="<?= $cliente['numero_documento'] ?>" required>
                                    <small>No se puede modificar</small>
                                    <hr>
                                </div>
                                <div class="mb-3">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" readonly name="fecha_nacimiento" value="<?= $cliente['fecha_nacimiento'] ?>" required>
                                    <small>No se puede modificar</small>
                                    <hr>
                                </div>
                                <div class="mb-3">
                                    <label>Correo</label>
                                    <input type="email" class="form-control" name="correo" value="<?= $cliente['correo'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Tipo de Documento</label>
                                    <select class="form-select" name="tipo_documento" required>
                                        <option value="CC" <?= ($cliente['tipo_documento'] ?? '') == 'CC' ? 'selected' : '' ?>>Cédula de Ciudadanía</option>
                                        <option value="PASAPORTE" <?= ($cliente['tipo_documento'] ?? '') == 'PASAPORTE' ? 'selected' : '' ?>>Pasaporte</option>
                                        <option value="CE" <?= ($cliente['tipo_documento'] ?? '') == 'CE' ? 'selected' : '' ?>>Cédula de Extranjería</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Teléfono 1</label>
                                    <input type="text" class="form-control" name="contacto1" value="<?= $cliente['contacto_1'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Teléfono 2</label>
                                    <input type="text" class="form-control" name="contacto2" value="<?= $cliente['contacto_2'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" name="direccion" value="<?= $cliente['direccion'] ?>" required>
                                </div>

                                <details style="color: black;">
                                    <summary>Cambiar contraseña (opcional)</summary>
                                    <div class="mb-3">
                                        <label for="cambiarClave_<?= $_SESSION['id_cliente'] ?>" class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control" name="cambiarClave"
                                            placeholder="Llena este campo si deseas cambiar la contraseña"
                                            id="cambiarClave_<?= $_SESSION['id_cliente'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmarClave_<?= $_SESSION['id_cliente'] ?>" class="form-label">Confirmar contraseña</label>
                                        <input type="password" class="form-control"
                                            placeholder="Confirmar la nueva contraseña"
                                            name="confirmarClave" id="confirmarClave_<?= $_SESSION['id_cliente'] ?>">
                                    </div>

                                    <!-- Requisitos de la contraseña -->
                                    <ul class="small">
                                        <li id="length_<?= $_SESSION['id_cliente'] ?>" class="text-danger">❌ Mínimo 8 caracteres</li>
                                        <li id="lowercase_<?= $_SESSION['id_cliente'] ?>" class="text-danger">❌ Al menos una letra minúscula</li>
                                        <li id="uppercase_<?= $_SESSION['id_cliente'] ?>" class="text-danger">❌ Al menos una letra mayúscula</li>
                                        <li id="number_<?= $_SESSION['id_cliente'] ?>" class="text-danger">❌ Al menos un número</li>
                                        <li id="special_<?= $_SESSION['id_cliente'] ?>" class="text-danger">❌ Al menos un carácter especial (!@#$%^&*)</li>
                                    </ul>
                                </details>

                                <script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const form = document.querySelector("form[action*='perfil_c.php']");
                                        const passwordInput = document.getElementById("cambiarClave_<?= $_SESSION['id_cliente'] ?>");
                                        const confirmarInput = document.getElementById("confirmarClave_<?= $_SESSION['id_cliente'] ?>");

                                        // ✅ Validación en tiempo real (lista de requisitos)
                                        passwordInput.addEventListener("input", function() {
                                            const val = passwordInput.value;

                                            const length = val.length >= 8;
                                            const lowercase = /[a-z]/.test(val);
                                            const uppercase = /[A-Z]/.test(val);
                                            const number = /[0-9]/.test(val);
                                            const special = /[!@#$%^&*]/.test(val);

                                            document.getElementById("length_<?= $_SESSION['id_cliente'] ?>").textContent =
                                                length ? "✅ Mínimo 8 caracteres" : "❌ Mínimo 8 caracteres";
                                            document.getElementById("length_<?= $_SESSION['id_cliente'] ?>").className =
                                                length ? "text-success" : "text-danger";

                                            document.getElementById("lowercase_<?= $_SESSION['id_cliente'] ?>").textContent =
                                                lowercase ? "✅ Al menos una letra minúscula" : "❌ Al menos una letra minúscula";
                                            document.getElementById("lowercase_<?= $_SESSION['id_cliente'] ?>").className =
                                                lowercase ? "text-success" : "text-danger";

                                            document.getElementById("uppercase_<?= $_SESSION['id_cliente'] ?>").textContent =
                                                uppercase ? "✅ Al menos una letra mayúscula" : "❌ Al menos una letra mayúscula";
                                            document.getElementById("uppercase_<?= $_SESSION['id_cliente'] ?>").className =
                                                uppercase ? "text-success" : "text-danger";

                                            document.getElementById("number_<?= $_SESSION['id_cliente'] ?>").textContent =
                                                number ? "✅ Al menos un número" : "❌ Al menos un número";
                                            document.getElementById("number_<?= $_SESSION['id_cliente'] ?>").className =
                                                number ? "text-success" : "text-danger";

                                            document.getElementById("special_<?= $_SESSION['id_cliente'] ?>").textContent =
                                                special ? "✅ Al menos un carácter especial (!@#$%^&*)" : "❌ Al menos un carácter especial (!@#$%^&*)";
                                            document.getElementById("special_<?= $_SESSION['id_cliente'] ?>").className =
                                                special ? "text-success" : "text-danger";
                                        });

                                        // 🚨 Validación final antes de enviar
                                        form.addEventListener("submit", function(e) {
                                            if (passwordInput.value.length > 0) {
                                                const val = passwordInput.value;

                                                const length = val.length >= 8;
                                                const lowercase = /[a-z]/.test(val);
                                                const uppercase = /[A-Z]/.test(val);
                                                const number = /[0-9]/.test(val);
                                                const special = /[!@#$%^&*]/.test(val);

                                                if (!(length && lowercase && uppercase && number && special)) {
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Contraseña inválida',
                                                        text: 'Tu contraseña no cumple con los requisitos de seguridad.'
                                                    });
                                                    return;
                                                }

                                                if (passwordInput.value !== confirmarInput.value) {
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Las contraseñas no coinciden',
                                                        text: 'Debes escribir la misma contraseña en ambos campos.'
                                                    });
                                                }
                                            }
                                        });
                                    });
                                </script>




                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- Tabla de compras -->
        <div class="card p-4">
            <h4 class="mb-3"><i class="fas fa-list me-2 text-primary"></i>Historial de Solicitudes</h4>
            <?php if ($compras->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table align-middle text-center mb-0">
                        <thead>
                            <tr>
                                <th>Número de Solicitud</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Abonos</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($compra = $compras->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $compra['id']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($compra['fecha'])); ?></td>
                                    <td>$<?php echo number_format($compra['total'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge <?php echo $compra['estado'] === 'rechazado' ? 'bg-danger' : ($compra['estado'] === 'atendido' ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo $compra['estado']; ?>
                                        </span>
                                    </td>
                                    <?php
                                    $venta = obtenerVentasporId($conn, $compra['id']);
                                    $id_venta = $venta['id'];

                                    // Obtener todos los abonos de la venta
                                    $abonos = obtenerAbonosPorVenta($conn, $id_venta);
                                    // Obtener el total de abonos
                                    $totalAbonos = obtenerTotalAbonosPorVenta($conn, $id_venta);
                                    $abonos_rechazados = obtenerAbonosRechazados($conn, $id_venta);
                                    $abonos_pendientes = obtenerAbonosPendientes($conn, $id_venta);

                                    $saldoPendiente = $venta['total'] - $totalAbonos;
                                    ?>
                                    <td>
                                        <?php if ($venta['estado'] === 'atendido' && $saldoPendiente > 0): ?>

                                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#abonarCompraModal<?php echo $compra['id']; ?>">
                                                <i class="fas fa-dollar"></i> Abonar
                                            </a>
                                           

                                        <?php elseif ($saldoPendiente == 0): ?>
                                            <span class="badge bg-success">Pagado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detalleCompraModal<?php echo $compra['id']; ?>">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </td>
                </div>
                <?php include 'abonar_compra.php'; ?>
                <?php include 'detalle_compra.php'; ?>


                </tr>
            <?php endwhile; ?>

            </tbody>
            </table>

        </div>
    <?php else: ?>
        <p class="text-center text-muted mt-3">Aún no has realizado compras.</p>
    <?php endif; ?>
    </div>
    </div>

    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>