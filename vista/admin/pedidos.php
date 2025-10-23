<?php
include('header.php');
?>
<style>
  .table-responsive {
    overflow-x: auto;
    max-width: 100%;
  }

  .main-content {
    padding: 1rem;
  }

  th,
  td {
    overflow-wrap: break-word;
    min-width: 120px;
    text-align: left;
    vertical-align: middle;
  }


  @media (max-width: 576px) {
    .main-content h2 {
      font-size: 1.4rem;
    }

    .table-responsive {
      font-size: 0.9rem;
    }

    .btn {
      font-size: 0.85rem;
    }
  }

  .descripcion-scroll {
    max-height: 80px;
    /* Alto máximo antes de hacer scroll vertical */
    max-width: 250px;
    /* Ancho máximo antes de hacer scroll horizontal */
    overflow: auto;
    white-space: pre-wrap;
    /* Mantiene saltos de línea */
  }
</style>

<body>
  <?php
  include '../../conexion.php';
  include '../../modelo/pedidos_m.php';
  include '../../modelo/ventas_m.php';
  $pedidos = obtenerVentaOnlineConCliente($conn);
  ?>

  <div class="d-flex flex-column flex-lg-row">

    <?php include('sidebar.php'); ?>

    <!-- Contenido principal -->
    <div class="flex-grow-1">
      <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <span class="navbar-brand">Gestión de Pedidos</span>
          <!-- <a href="#" class="btn btn-outline-light"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a> -->
          <div class="dataTables_filter">
            <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">

          </div>
        </div>
      </nav>

      <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="mb-0 mt-4">PEDIDOS ONLINE</h2>

        </div>

        <!-- Tabla -->
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th><i class="fas fa-id-badge"></i> ID</th>
                <th><i class="fas fa-user"></i> Cliente</th>
                <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                <th><i class="fas fa-dollar-sign"></i> Total</th>
                <th><i class="fas fa-store"></i> Detalles</th>
                <th><i class="fas fa-circle-notch"></i> Estado</th>
                <th><i class="fas fa-cogs"></i> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pedidos as $pedido): ?>

                <tr>
                  <td><?= $pedido['id'] ?></td>
                  <td><?= $pedido['nombre_cliente'] ?> (<?=$pedido['id_cliente'] ?>)</td>
                  <td><?= $pedido['fecha'] ?></td>
                  <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
                  <td><textarea lass="overflow-auto" style="
                        max-height: 100px;
                        max-width: 100%;
                        text-align: left;
                        overflow-wrap: break-word;
                        background-color: #f0f8ff; /* azul claro suave */
                        padding: 8px 12px;
                        border-radius: 10px;
                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        font-size: 14px;
                        color: #333;
                        "
                        readonly><?= htmlspecialchars($pedido['detalles']) ?>
                      </textarea></td>

                  <?php
                  $colores = [
                    'atendido' => '#28a745',
                    'rechazado' => '#dc3545',
                    'solicitado' => '#007bff'
                  ];

                  $estado = strtolower($pedido['estado']);
                  $color = isset($colores[$estado]) ? $colores[$estado] : '#6c757d';  // gris por defecto
                  ?>
                  <td style="background-color:<?= $color ?>;color:#fff;padding:5px;border-radius:4px;text-align:center;">
                    <?= htmlspecialchars($pedido['estado']) ?>
                  </td>

                  <td>
                    <button class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal"
                      data-bs-target="#modalEditar<?= $pedido['id'] ?>">
                      <i class="fas fa-edit"></i>
                    </button>
                    <?php
                    $id_venta = 0;
                    $id_venta = $pedido['id'];

                    // Obtener todos los abonos de la venta
                    $abonos = obtenerAbonosPorVenta($conn, $id_venta);

                    // Obtener el total de abonos
                    $totalAbonos = obtenerTotalAbonosPorVenta($conn, $id_venta);
                    $abonos_rechazados = obtenerAbonosRechazados($conn, $id_venta);
                    $abonos_pendientes = obtenerAbonosPendientes($conn, $id_venta);

                    $saldoPendiente = $pedido['total'] - $totalAbonos;
                    ?>
                    <?php if ($saldoPendiente > 0 && $pedido['estado'] == 'atendido'): ?>
                      <button class="btn btn-sm btn-outline-success mt-1" data-bs-toggle="modal"
                        data-bs-target="#abonarpedidoModal<?php echo $pedido['id']; ?>">
                        <i class="fas fa-hand-holding-usd"></i> Abonar
                      </button>
                    <?php endif; ?>
                    <button class="btn btn-sm btn-outline-danger mt-1"
                      onclick="eliminar(event, <?= $pedido['id'] ?>)"><i class="fas fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>
                <!--Modal Abonar pedido -->
                <div class="modal fade" id="abonarpedidoModal<?php echo $pedido['id']; ?>" tabindex="-1" aria-labelledby="abonarpedidoLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="POST" action="../../controlador/abonosAdmin_c.php?accion=registrar" enctype="multipart/form-data">
                        <div class="modal-header bg-success text-white">
                          <h5 class="modal-title" id="abonarpedidoLabel">Realizar Abono a pedido #<?php echo $pedido['id']; ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_venta" value="<?= $pedido['id'] ?>">
                          <div class="mb-3">
                            <label>Monto a abonar (Saldo pendiente: $<?php echo number_format($saldoPendiente, 0, ',', '.'); ?>)</label>
                            <input type="number" class="form-control" name="monto" max="<?php echo $saldoPendiente; ?>" min="1" required>
                          </div>
                          <div class="mb-3">
                            <label>Seleccione el medio de pago</label>
                            <select class="form-select" name="metodo_pago" required>
                              <option value="" disabled selected>-- Seleccione --</option>
                              <option value="Transferencia">Transferencia</option>
                              <option value="Efectivo">Efectivo</option>
                              <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="">Tipo de Transferencia</label>
                            <input type="text" name="tipo_transferencia" class="form-control" placeholder="Ejemplo: Nequi, Daviplata, Bancolombia...">
                          </div>
                          <div class="mb-3">
                            <label for="">Adjuntar comprobante de pago (Opcional)</label>
                            <input type="file" class="form-control" name="comprobante" accept="image/*,pdf">
                          </div>
                          <div class="mb-3">
                            <label>Observaciones (opcional)</label>
                            <textarea class="form-control" name="observaciones" rows="2"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-success">Abonar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--Modal editar Pedido  -->
                <div class="modal fade" id="modalEditar<?= $pedido['id'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar Solicitud de Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../../controlador/pedidos_c.php?accion=cambiar" method="POST">
                          <input type="hidden" name="id" value="<?= $pedido['id'] ?>" />

                          <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado">
                              <option value="atendido" <?= $pedido['estado'] == 'atendido' ? 'selected' : '' ?>>ATENDIDO</option>
                              <option value="rechazado" <?= $pedido['estado'] == 'rechazado' ? 'selected' : '' ?>>RECHAZADO</option>
                              <option value="solicitado" <?= $pedido['estado'] == 'solicitado' ? 'selected' : '' ?>>SOLICITADO</option>

                            </select>
                          </div>

                          <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>




  <?php include('footer.php'); ?>
  <script>
    async function eliminar(event, id) {
      event.preventDefault();
      const confirmarSalida = await confirmar(
        '¿Estás seguro de que deseas eliminar esta SOLICITUD?',
        'SÍ', 'No', 'warning'
      );

      if (confirmarSalida) {
        window.location.href = `../../controlador/pedidos_c.php?accion=eliminar&id=${id}`;
      }
    }
    // Filtro de búsqueda
    document.getElementById("buscar").addEventListener("keyup", function() {
      const filtro = this.value.toLowerCase();
      const filas = document.querySelectorAll(".table-responsive tbody tr");

      filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        fila.style.display = textoFila.includes(filtro) ? "" : "none";
      });
    });
  </script>

  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>