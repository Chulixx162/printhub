<!-- Modal Detalle Compra -->
<div class="modal fade" id="detalleCompraModal<?php echo $compra['id']; ?>" tabindex="-1" aria-labelledby="detalleCompraLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Encabezado -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="detalleCompraLabel">
          Detalle de la Compra #<?php echo $compra['id']; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo del modal -->
      <div class="modal-body">
        <p><strong>Cliente:</strong> <?php echo $cliente['nombre'] ?? 'No definido'; ?></p>
        <p><strong>Descripción:</strong> <?php echo $venta['detalles']; ?></p>

        <p><strong>Total venta:</strong>
          $<?php echo number_format($venta['total'], 0, ',', '.'); ?>
        </p>

        <p><strong>Total abonado:</strong>
          $<?php echo number_format($totalAbonos, 0, ',', '.'); ?>
        </p>

        <p><strong>Saldo pendiente:</strong>
          $<?php echo number_format($saldoPendiente, 0, ',', '.'); ?>
        </p>
        <p><strong>Fecha de compra:</strong> <?php echo $venta['fecha']; ?></p>
        <hr>


        <h6>💰 Abonos realizados:</h6>
        <ul>
          <?php if (!empty($abonos)): ?>
            <?php foreach ($abonos as $abono): ?>
              <li>

                $<?php echo number_format($abono['monto'], 0, ',', '.'); ?>
                - <?php echo $abono['fecha']; ?> (Aceptado)
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>No hay abonos registrados.</li>
          <?php endif; ?>
        </ul>

        <hr>
        <h6>Abonos pendientes:</h6>
        <ul>
          <?php if (!empty($abonos_pendientes)): ?>
            <?php foreach ($abonos_pendientes as $abonoP): ?>
              <li>

                $<?php echo number_format($abonoP['monto'], 0, ',', '.'); ?>
                - <?php echo $abonoP['fecha']; ?> (Pendiente)
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>No hay abonos pendientes.</li>
          <?php endif; ?>
        </ul>

        <hr>
        <h6>Abonos rechazados:</h6>
        <ul>
          <?php if (!empty($abonos_rechazados)): ?>
            <?php foreach ($abonos_rechazados as $abonoR): ?>
              <li>
                $<?php echo number_format($abonoR['monto'], 0, ',', '.'); ?>
                - <?php echo $abonoR['fecha']; ?> (Rechazado)
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>No hay abonos rechazados.</li>
          <?php endif; ?>
        </ul>

      </div>

      <!-- Pie -->
      <div class="modal-footer">
        <?php if ($compra['estado'] === 'rechazado'): ?>
          <span class="badge bg-danger">Compra rechazada</span>
        <?php else : ?>
          <?php if ($saldoPendiente > 0): ?>
            <span class="badge bg-warning">Pendiente</span>
          <?php else: ?>
            <span class="badge bg-success">Pagado</span>
          <?php endif; ?>
        <?php endif; ?>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>